<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Book extends Model
{

    protected $fillable=[

        'full_name',
        'phone' ,
        'email' ,
        'check_in_date' ,
        'check_out_date' ,
        'room_type' ,
        'guests_number' ,
        'content',
    ];


}
