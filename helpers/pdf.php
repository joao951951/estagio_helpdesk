<?php

use App\Models\Client;

function client($id)
{
    return Client::find($id);
}
