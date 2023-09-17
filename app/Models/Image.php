<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }


    public function gallary(): BelongsTo
    {
        return $this->belongsTo(Gallary::class);
    }
    public function explore(): BelongsTo
    {
        return $this->belongsTo(Explore::class);
    }
}
