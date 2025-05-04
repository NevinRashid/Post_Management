<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
                'title',
                'slug',
                'body',
                'tags',
                'meta_description',
                'is_published',
                'publish_date'
                ];
}
