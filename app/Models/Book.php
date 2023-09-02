<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Book extends Model
{
    use HasFactory;

    protected $fillable=[
        'room_id',
        'full_name',
        'phone' ,
        'email' ,
        'check_in_date' ,
        'check_out_date' ,
        'room_type' ,
        'guests_number' ,
        'content',
    ];

    public function room(): BelongsTo
{
    return $this->belongsTo(Room::class, 'room_id', 'id');
}

}
