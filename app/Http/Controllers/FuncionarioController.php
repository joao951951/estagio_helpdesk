<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FuncionarioController extends Controller
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee->all();

        return view('funcionarios.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionarios.create');
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
        // dd($data);
        if(Auth::user()->admin != 1){
            return redirect()->route('chamados.index')->with([
                'error' => "Você não tem permissão para criar novos técnicos"
            ]);
        }else{
            if(Employee::where('cpf', $data['cpf'])->get()->get(0) == null && User::where('name', $data['userName'])->get()->get(0) == null && User::where('email', $data['userEmail'])->get()->get(0) == null){
                $user = User::create([
                    'name' => $data['userName'],
                    'email' => $data['userEmail'],
                    'admin' => $data['admin'],
                    'password' => bcrypt($data['userPassword']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $employee = $this->employee->create([
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'cpf' => $data['cpf'],
                    'phone' => $data['phone'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                return redirect()->route('funcionarios.index')->with([
                    'success' => "{$employee->name} foi criado com sucesso"
                ]);
            }else{
                return redirect()->route('funcionarios.index')->with([
                    'error' => "Registro Duplicado"
                ]);
            }
        }
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
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('funcionarios.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->except(['_token', '_method']);
                
        if(Auth::user()->admin != 1){
            return redirect()->route('chamados.index')->with([
                'error' => "Você não tem permissão para atualizar o registro de técnicos"
            ]);
        }else{
            if($data['active'] == 1){
                $user = User::find($employee['user_id']);
                $employee->update($data);
                $user->update([
                    'password' => bcrypt($data['password'])
                ]);

                return redirect()->route('funcionarios.index')->with([
                    'success' => "As informações {$employee->name} foram atualizadas com sucesso"
                ]);
            }else{
                $user = User::find($employee['user_id']);
                $employee->update($data);
                $user->update([
                    'password' => bcrypt($data['password'])
                ]);

                return redirect()->route('funcionarios.index')->with([
                    'success' => "As informações {$employee->name} foram atualizadas com sucesso"
                ]);
                
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ( count($employee->tickets) > 0 ) {
            return redirect()->route('funcionarios.index')->with([
                'error' => "$employee->name não pode ser excluído pois tem chamado relacionado com esse técnico"
            ]);
        }

        $employee->delete();
        $employee->user()->delete();

        return redirect()->route('funcionarios.index')->with([
            'success' => "{$employee->name} foi excluído com sucesso"
        ]);
    }

    public function changePassword(Request $request)
    {
        $data = $request->except('_token');
        $user = User::find($data['userId']);

        return view('funcionarios.change-password', compact('user'));
    }

    public function savePassword(Request $request)
    {
        $data = $request->except('_token');
        $user = User::find($data['userId']);

        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('funcionarios.index')->with([
            'success' => "As informações do usuário {$user->name} foram atualizados com sucesso"
        ]);
    }
}
