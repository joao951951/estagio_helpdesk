<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    public function getClient(Request $request)
    {
        $client = Client::find($request->idCliente);

        return response()->json([
            'client' => $client
        ], Response::HTTP_OK);
    }
}
