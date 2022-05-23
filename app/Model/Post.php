<?php

namespace App\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function tag()
    {
        return $this->belongsToMany('App\Model\Tag');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function createSlug($title, $model)
    {
        $slug = Str::slug($title, '-');
        if ($model === 'category') {
            $oldPost = Category::where('slug', $slug)->first();
        }
        else if ($model === 'tag') {
            $oldPost = Tag::where('slug', $slug)->first();
        }
        else {
            // default: post
            $oldPost = Post::where('slug', $slug)->first();
        }

        $counter = 0;
        while ($oldPost) {
            $newSlug = $slug . '-' . $counter;
            // $oldPost = Post::where('slug', $newSlug)->first();
            if ($model === 'category') {
                $oldPost = Category::where('slug', $newSlug)->first();
            }
            else if ($model === 'tag') {
                $oldPost = Tag::where('slug', $newSlug)->first();
            }
            else {
                // default: post
                $oldPost = Post::where('slug', $newSlug)->first();
            }

            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
