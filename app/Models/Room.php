<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
use Illuminate\Database\Eloquent\Relations\{HasMany , HasOne};
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'name',
        'type',
        'guests_number',
        'price',
        'content'
=======
        'name_ar',
        'name_en',
        'type',
        'guests_number',
        'price',
        'content_en',
        'content_ar',

>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
<<<<<<< HEAD
=======


    public function booking(): HasOne
    {
        return $this->hasOne(Book::class, 'room_id', 'id');
    }
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
}
