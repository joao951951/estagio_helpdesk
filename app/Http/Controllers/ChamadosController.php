<?php

namespace App\Http\Controllers;

use App\Jobs\MailTicketToClient;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Priority;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Ticket_employee;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChamadosController extends Controller
{
    private $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $todayDate = Carbon::now()->format('Y-m-d');
        $date = '';
        if (request()->has('initialDate')) {
            $initialDate = request()->initialDate;
        } else {
            $initialDate = $todayDate;
        }

        if (request()->has('finalDate')) {
            $finalDate = request()->finalDate;
        } else {
            $finalDate = $todayDate;
        }

        if (request()->has('orderColumn')) {
            $orderColumn = request()->orderColumn;
        } else {
            $orderColumn = 'status';
        }

        if (request()->has('order')) {
            $order = request()->order;
        } else {
            $order = 'ASC';
        }

        if(Auth::user()->admin == 0){

            // dd($employee);

            $tickets_open = $this->ticket
            ->where('status', '<=', 3)
            ->where('status', '>' , 1)
            ->orWhere(function($query)
            {
                $employee = Employee::where('user_id', '=', Auth::user()->id)->get();
                $employee = $employee->get(0);
                $query->where('employee_id', '=', $employee->id)->where('status', '<>', 4);
            })
            ->orderBy(filter_var($orderColumn, FILTER_SANITIZE_STRIPPED), filter_var($order, FILTER_SANITIZE_STRIPPED))
            ->paginate(10);


    
        }else{
            $tickets_open = $this->ticket
                ->where('status', '<=', 3)
                ->orderBy(filter_var($orderColumn, FILTER_SANITIZE_STRIPPED), filter_var($order, FILTER_SANITIZE_STRIPPED))
                ->paginate(10);
        }

        return view('chamados.index', compact(['finalDate', 'initialDate', 'order', 'orderColumn','tickets_open']));
    }

    public function history()
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        $date = '';
        if (request()->has('initialDate')) {
            $initialDate = request()->initialDate;
        } else {
            $initialDate = $todayDate;
        }

        if (request()->has('finalDate')) {
            $finalDate = request()->finalDate;
        } else {
            $finalDate = $todayDate;
        }

        if (request()->has('orderColumn')) {
            $orderColumn = request()->orderColumn;
        } else {
            $orderColumn = 'status';
        }

        if (request()->has('order')) {
            $order = request()->order;
        } else {
            $order = 'ASC';
        }

        $finalDateCompare = (new Carbon($finalDate))->addDay(1)->format('Y-m-d');
        $tickets = $this->ticket
            ->whereBetween('created_at', [$initialDate, $finalDateCompare])
            ->orderBy(filter_var($orderColumn, FILTER_SANITIZE_STRIPPED), filter_var($order, FILTER_SANITIZE_STRIPPED))
        ->paginate(10);

        return view('chamados.history', compact(['finalDate', 'initialDate', 'order', 'orderColumn', 'tickets']));
    }

    public function historyTicket(Ticket $ticket)
    {
        $query = Employee::where('user_id', '=', Auth::user()->id)->get();
        $query = $query->get(0);

        if($query != null){
            $type_user = 0;
        }else{
            $type_user = 1;
        }
        $changes = " ";
        if(isset($ticket->employee_id)){
            $employee = Employee::where('id', '=', $ticket->employee_id)->get();
            $employee = $employee->get(0);
        }else{
            return redirect()->route('chamados.index')->with([
                'error' => "{$ticket->title} Antes de obter o histórico é necessário atribuir o chamado a algum técnico ou algum técnico assumir"
            ]);
        }

        $client = Client::where('id', '=', $ticket->client_id)->get();
        $client = $client->get(0);

        $history_ticket = Ticket_employee::where('ticket_id', $ticket->id)->get();
        foreach ($history_ticket as $key => $ticket_updated){
            if($ticket_updated->employee_id != $ticket_updated->employee_id_old){

                $employee_old = Employee::where('id', '=', $ticket->employee_id_old)->get();
                $employee_old = $employee_old->first();

                $employee = Employee::where('id', '=', $ticket->employee_id)->get();
                $employee = $employee->first();
            } 
        }


        // dd($query);

        return view('chamados.history_ticket', compact('ticket', 'employee', 'client', 'history_ticket', 'changes','type_user', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $employees = Employee::all();
        $priorities = Priority::all();

        return view('chamados.create', compact(['clients', 'employees', 'priorities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){ 

        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;


        $data = $request->except('_token');

        $data['status'] = '1';

        $ticket = $this->ticket->create($data);

        $ticket_history = Ticket::latest()->first();

        Ticket_employee::create([
            'employee_id' => $ticket_history->employee_id,
            'ticket_id' => $ticket_history->id,
            'title_new' => $ticket_history->title,
            'claimed_defect_new' => $ticket_history->claimed_defect,
            'found_defect_new' => $ticket_history->found_defect,
            'service_performed_new' => $ticket_history->service_performed,
            'swap_parts_new' => $ticket_history->swap_parts,
            'priority_id_new' => $ticket_history->priority_id,
            'status_new' => $ticket_history->status,
            'descri' => "Chamado Criado por $user_name com email $user_email",
            ]);

        return redirect()->route('chamados.index')->with([
            'success' => "{$ticket->title} foi criado com sucesso"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $employees = Employee::all();
        $priorities = Priority::all();
        $status = Status::all();

        return view('chamados.edit', compact(['ticket', 'employees', 'priorities', 'status']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;

        $ticket_old = Ticket::find($ticket->id);

        $data = $request->except(['_token', '_method']);

        $ticket->update($data);

        if($ticket_old->status != $ticket->status){
            $status_var = [
                "1" => "Aberto",
                "2" => "Em Andamento",
                "3" => "Visita Técnica",
                "4" => "Fechado",
            ];
            if ($data['status'] == 4) {
                Ticket_employee::create([
                    'ticket_id' => $ticket->id,
                    'employee_id_old' => $ticket_old->employee_id,
                    'title_old' => $ticket_old->title,
                    'claimed_defect_old' => $ticket_old->claimed_defect,
                    'found_defect_old' => $ticket_old->found_defect,
                    'service_performed_old' => $ticket_old->service_performed,
                    'swap_parts_old' => $ticket_old->swap_parts,
                    'priority_id_old' => $ticket_old->priority_id,
                    'status_old' => $ticket_old->status,
                    'employee_id' => $data['employee_id'],
                    'title_new' => $data['title'],
                    'claimed_defect_new' => $data['claimed_defect'],
                    'found_defect_new' => $data['found_defect'],
                    'service_performed_new' => $data['service_performed'],
                    'swap_parts_new' => $data['swap_parts'],
                    'priority_id_new' => $data['priority_id'],
                    'status_new' => $data['status'],
                    'descri' => "Chamado Fechado pelo usuário $user_name com email de $user_email ",
                    ]);

            }elseif($data['status'] == 1 && $ticket_old->status == 4){
                Ticket_employee::create([
                    'ticket_id' => $ticket->id,
                    'employee_id_old' => $ticket_old->employee_id,
                    'title_old' => $ticket_old->title,
                    'claimed_defect_old' => $ticket_old->claimed_defect,
                    'found_defect_old' => $ticket_old->found_defect,
                    'service_performed_old' => $ticket_old->service_performed,
                    'swap_parts_old' => $ticket_old->swap_parts,
                    'priority_id_old' => $ticket_old->priority_id,
                    'status_old' => $ticket_old->status,
                    'employee_id' => $data['employee_id'],
                    'title_new' => $data['title'],
                    'claimed_defect_new' => $data['claimed_defect'],
                    'found_defect_new' => $data['found_defect'],
                    'service_performed_new' => $data['service_performed'],
                    'swap_parts_new' => $data['swap_parts'],
                    'priority_id_new' => $data['priority_id'],
                    'status_new' => $data['status'],
                    'descri' => "Reaberto pelo usuário $user_name com email de $user_email ",
                ]);
            }else{
                $status_old = $status_var[$ticket_old->status];
                $status_new = $status_var[$data['status']];

                Ticket_employee::create([
                    'ticket_id' => $ticket->id,
                    'employee_id_old' => $ticket_old->employee_id,
                    'title_old' => $ticket_old->title,
                    'claimed_defect_old' => $ticket_old->claimed_defect,
                    'found_defect_old' => $ticket_old->found_defect,
                    'service_performed_old' => $ticket_old->service_performed,
                    'swap_parts_old' => $ticket_old->swap_parts,
                    'priority_id_old' => $ticket_old->priority_id,
                    'status_old' => $ticket_old->status,
                    'employee_id' => $data['employee_id'],
                    'title_new' => $data['title'],
                    'claimed_defect_new' => $data['claimed_defect'],
                    'found_defect_new' => $data['found_defect'],
                    'service_performed_new' => $data['service_performed'],
                    'swap_parts_new' => $data['swap_parts'],
                    'priority_id_new' => $data['priority_id'],
                    'status_new' => $data['status'],
                    'descri' => "Mudança de estado estava $status_old e foi para $status_new realizada pelo usuário $user_name com email de $user_email",
                ]);
            }
        }
        return redirect()->route('chamados.index')->with([
            'success' => "As informações de {$ticket->title} foram atualizadas com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if(Auth::user()->admin != 1){
            return redirect()->route('chamados.index')->with([
                'error' => "Você não tem permissão para cancelar chamados"
            ]);
        }else{
            $history_ticket = Ticket_employee::where('ticket_id', '=' , $ticket->id);
            dd($history_ticket);
            $ticket->delete();
    
            return redirect()->route('funcionarios.index')->with([
                'success' => "Chamado cancelado com sucesso"
            ]);
        }
    }

    public function assumirChamado(Ticket $ticket){
        dd($ticket);
        return redirect()->route('chamados.index')->with([
            'success' => "Chamado cancelado com sucesso"
        ]);
    }
}
