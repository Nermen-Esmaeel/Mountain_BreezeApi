<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{

        use HasFactory;

        protected $fillable = [
            'image',
            'room_id',
        ];


    public function rooms(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

}
