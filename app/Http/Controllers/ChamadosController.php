<?php

namespace App\Http\Controllers;

use App\Jobs\MailTicketToClient;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Priority;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function index()
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

        $tickets_open = $this->ticket
            ->where('status', '<=', '3')
            ->orderBy(filter_var($orderColumn, FILTER_SANITIZE_STRIPPED), filter_var($order, FILTER_SANITIZE_STRIPPED))
        ->paginate(10);

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
    public function store(Request $request)
    {
        $data = $request->except('_token');

        // if ($request->has('employee_id')) {
        //     $data['status'] = 'em-andamento';
        // } else {
        //     $data['status'] = 'aberto';
        // }
        $data['status'] = '1';

        $ticket = $this->ticket->create($data);

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
        $data = $request->except(['_token', '_method']);

        $ticket->update($data);

        // if ($ticket->status == 'fechado') {
        //     Order::create([
        //         'client_id' => $ticket->client_id,
        //         'ticket_id' => $ticket->id
        //     ]);

            // MailTicketToClient::dispatch($ticket);
        // }

        return redirect()->route('chamados.index')->with([
            'success' => "As informações {$ticket->id} foram atualizadas com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
