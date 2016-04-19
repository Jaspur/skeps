<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title', 'slug', 'quote', 'content', 'main_picture', 'author', 'published_at',
    ];

    /**
     * An article belongs to an User
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'author', 'id');
    }
}
