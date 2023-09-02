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
<<<<<<< HEAD
=======
    public function food(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function galary(): BelongsTo
    {
        return $this->belongsTo(Galary::class);
    }
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
}
