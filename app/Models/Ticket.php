<?php

namespace App\Models;

use App\Events\TicketChanged;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'priority', 'status', 'client_id', 'employee_id', 'claimed_defect', 'found_defect', 'service_performed', 'swap_parts'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TicketChanged::class,
        'updated' => TicketChanged::class
    ];
}
