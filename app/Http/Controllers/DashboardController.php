<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        $tickets = Ticket::where('created_at', 'LIKE', "%$todayDate%")->get();
        $numberOpenedTicket = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', 'aberto')->count();
        $numberInProgressTicket = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', 'em-andamento')->count();
        $numberClosedTicked = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', 'fechado')->count();

        return view('dashboard', compact(['numberOpenedTicket', 'numberInProgressTicket', 'numberClosedTicked']));
    }
}
