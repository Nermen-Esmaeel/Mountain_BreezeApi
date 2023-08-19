<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    public function article(): BelongsTo
{
    return $this->belongsTo(Article::class, 'article_id', 'id');
}
}
