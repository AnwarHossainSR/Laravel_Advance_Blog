<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model 
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'user_id',
        'postImage',
        'status',
        'is_approve',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
