<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeuser extends Model
{
    use HasFactory;
    protected $table = 'typeuser';
    protected $fillable = ['desc_type'];
}
