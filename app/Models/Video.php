<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory , SoftDeletes ;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type',
        'link',
        'name',
    ];



    public function article(): BelongsTo
{
    return $this->belongsTo(Article::class, 'article_id', 'id');
}
}
