<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)

class Book extends Model
{
    use HasFactory;

    protected $fillable=[
<<<<<<< HEAD
       
        'full_name_en',
        'full_name_ar',
=======

        'room_id',
        'full_name',
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
        'phone' ,
        'email' ,
        'check_in_date' ,
        'check_out_date' ,
<<<<<<< HEAD
        'room_type_en' ,
        'room_type_ar' ,
        'guests_number' ,
        'content_en',
        'content_ar',
    ];
=======
        'room_type' ,
        'guests_number' ,
        'content',
    ];

    public function room(): BelongsTo
{
    return $this->belongsTo(Room::class, 'room_id', 'id');
}
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
}
