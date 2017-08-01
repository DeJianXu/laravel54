<?php

namespace App;

use App\Model;

class Post extends Model {

    public function user() {
        return $this->belongsTo(\App\User::class,'user_id','id');
    }
    
    //评论模型
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}
