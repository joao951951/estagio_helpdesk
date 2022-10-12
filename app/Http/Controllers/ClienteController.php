<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        if(Auth::user()->admin != 1){
            return redirect()->route('clientes.index')->with([
                'error' => "Você não tem permissão para cadastrar novos clientes"
            ]);
        }else{
            $data = $request->except('_token');
            $client = $this->client->create($data);

            return redirect()->route('clientes.index')->with([
                'success' => "{$client->name} foi criado com sucesso"
            ]);
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
        if(Auth::user()->admin != 1){
            return redirect()->route('clientes.index')->with([
                'error' => "Você não tem permissão para cadastrar novos clientes"
            ]);
        }else{
            $data = $request->except(['_token', '_method']);
            $client->update($data);

            return redirect()->route('clientes.index')->with([
                'success' => "As informações {$client->name} foram atualizadas com sucesso"
            ]);
        }
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
