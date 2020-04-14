<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function createdAt(){
    	return $this->created_at->toFormattedDateString();
    }

    public function showAllPosts(){
    	return view('post')->withPosts(Post::all());
    }
}
