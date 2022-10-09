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
        $numberOpenedTicket = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', '1')->count();
        $numberInProgressTicket = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', '2')->count();
        $numberWaitingEmp = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', '3')->count();
        $numberClosedTicked = Ticket::where('created_at', 'LIKE', "%$todayDate%")->where('status', '4')->count();

        return view('dashboard', compact(['numberOpenedTicket', 'numberInProgressTicket','numberWaitingEmp', 'numberClosedTicked']));
    }
}
