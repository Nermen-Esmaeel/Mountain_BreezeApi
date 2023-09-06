<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name_ar',
        'name_en',
        'type',
        'guests_number',
        'price',
        'content_en',
        'content_ar',
        'floor',
        'room_services',
        'bed',
        'TV'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
