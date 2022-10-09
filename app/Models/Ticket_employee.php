<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_employee extends Model
{
    use HasFactory;

    protected $fillable = ['descri','ticket_id', 'employee_id', 'employee_id_old','title_old', 
    'claimed_defect_old', 'found_defect_old', 'service_performed_old', 'swap_parts_old',
    'priority_id_old', 'status_old', 'title_new', 'claimed_defect_new', 'found_defect_new',
    'service_performed_new', 'swap_parts_new', 'priority_id_new', 'status_new'];

}