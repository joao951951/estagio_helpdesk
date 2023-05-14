<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $admins = $this->user->where('admin', '1')->get();
        return view('usuarios.index', compact('admins'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if(User::where('name', $data['name'])->get()->get(0) != null){
            return redirect()->route('administradores.index')->with([
                'error' => "O nome de usuário {$data['name']} ja está em uso"
            ]);
        }else{
            $user = $this->user->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'admin' => $data['admin']
            ]);

            return redirect()->route('administradores.index')->with([
                'success' => "{$user->name} foi criado com sucesso"
            ]);
        }
    }

    public function edit(User $admin)
    {
        return view('usuarios.edit', compact('admin'));
    }

    public function update(User $admin, Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if(User::where('name', $data['name'])->get()->get(0) != null){
            return redirect()->route('administradores.index')->with([
                'error' => "O nome de usuário {$data['name']} ja está em uso"
            ]);
        }else{
            $admin->update($data);

            return redirect()->route('administradores.index')->with([
                'success' => "As informações do usuário {$admin->name} foram atualizados com sucesso"
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->except('_token');
        $admin = $this->user->find($data['userId']);

        return view('usuarios.change-password', compact('admin'));
    }

    public function savePassword(Request $request)
    {
        $data = $request->except('_token');
        $user = $this->user->find($data['userId']);
        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('administradores.index')->with([
            'success' => "As informações do usuário {$user->name} foram atualizados com sucesso"
        ]);
    }
}
