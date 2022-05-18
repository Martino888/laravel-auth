<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    static public function genSlug($data) {
        $elementSlug = Str::of($data)->slug('-');
        $slug = $elementSlug;
        $i = 1;
        while(self::where('slug', $slug)->first()) {
            $slug = "$elementSlug-$i";
            $i++;
        }
        return $slug;
    }
}
