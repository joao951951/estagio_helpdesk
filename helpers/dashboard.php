<?php

use App\Models\Ticket;

function quantityTicket($month)
{
    return Ticket::where('created_at', 'LIKE', "%-$month-%")->count();
}
