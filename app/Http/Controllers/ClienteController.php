<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->client->all();

        return view('clientes.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|min:5|max:50',
            'email'=>'email',
            'cnpj'=>'required|min:4|max:20',
            'phone'=>'max:30',
        ];

        $feedback = [
            'required'=>'O campo :attribute deve ser preenchido', 
            'name.min'=>'O campo nome deve ter no mínimo 5 caracteres',
            'name.max'=>'O campo nome deve ter no máximo 50 caracteres',
            'email'=>'Insira um email válido',
            'password.min'=>'O campo senha deve ter no mínimo 4 caracteres',
            'password.max'=>'O campo senha deve ter no máximo 20 caracteres',
        ];

        $request->validate($rules, $feedback);


        $data = $request->except('_token');

        // dd($data);

        $client = $this->client->create($data);

        return redirect()->route('clientes.index')->with($feedback);

        // return redirect()->route('clientes.index')->with([
        //     'success' => "{$client->name} foi criado com sucesso"
        // ]);
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
     * @param  Client  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clientes.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->except(['_token', '_method']);
        $client->update($data);

        return redirect()->route('clientes.index')->with([
            'success' => "As informações {$client->name} foram atualizadas com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ( count($client->tickets) > 0 ) {
            return redirect()->route('clientes.index')->with([
                'error' => "$client->name não pode ser excluído pois tem chamado relacionado com esse cliente"
            ]);
        }

        $client->delete();

        return redirect()->route('clientes.index')->with([
            'success' => "{$client->name} foi excluído com sucesso"
        ]);
    }
}
