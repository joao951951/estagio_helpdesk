<?php

use App\Models\Client;
use App\Models\Employee;

function clientName($id)
{
    return Client::find($id)->name;
}

function clientEmail($id)
{
    return Client::find($id)->email;
}

function employeeName($id)
{
    return Employee::find($id)->name;
}
