<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function countLikes()
    {
        $likesCnt = Likes::where('post_id',$this->id)->count();

        return $likesCnt;
        
    }

    public function countComments()
    {
        $CmCnt = Comment::where('post_id',$this->id)->count();

        return $CmCnt;
        
    }

    public function likes(){
        return $this->hasMany('App\Post');
    }

}
