<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use App\Models\Dislike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'body',
        'title',
        'image',
        'slug'
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function dislikedBy(User $user)
    {
        return $this->dislikes->contains('user_id', $user->id);
    }

    public function commentedBy(User $user)
    {
        return $this->comments->contains('user_id', $user->id);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected $guarded = ['$id'];
   
}
