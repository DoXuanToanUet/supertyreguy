<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapItemHistory extends Model
{
    // use HasFactory;

    protected $table = 'scrap_item_histories';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'last_wheel_item_id',
        'last_tyre_item_id',
    ];
}
