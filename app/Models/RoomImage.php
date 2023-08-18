<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    use HasFactory;
/**
 * Get the user that owns the RoomImage
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function rooms(): BelongsTo
{
    return $this->belongsTo(Room::class);
}

}
