<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'type',
        'guests_number',
        'price',
        'content_en',
        'content_ar',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }



    public function booking(): HasOne
    {
        return $this->hasOne(Book::class, 'room_id', 'id');
    }

}
