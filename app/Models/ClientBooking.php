<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBooking extends Model
{
    //use HasFactory;
    protected $connection= 'mysql3';
    protected $table = 'logintbl';
    public $timestamps = false;
}
