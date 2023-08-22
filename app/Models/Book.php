<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=[
       
        'full_name_en',
        'full_name_ar',
        'phone' ,
        'email' ,
        'check_in_date' ,
        'check_out_date' ,
        'room_type_en' ,
        'room_type_ar' ,
        'guests_number' ,
        'content_en',
        'content_ar',
    ];
}
