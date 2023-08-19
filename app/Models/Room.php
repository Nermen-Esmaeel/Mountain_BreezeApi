<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

      protected $fillable=[
        'name' ,
        'type' ,
        'guests_number',
        'price',
        'content'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }
}
