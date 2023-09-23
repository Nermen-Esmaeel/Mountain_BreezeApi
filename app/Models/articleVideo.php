<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articleVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'link'
    ];

    public function videoable()
    {
        return $this->morphTo();
    }
}
