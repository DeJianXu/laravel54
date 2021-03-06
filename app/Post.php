<?php

namespace App;

use \App\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;


class Post extends Model {

    use Searchable;

    protected $table = "posts";

    /*
     * 搜索的type
     */
    public function searchableAs() {
        return 'posts_index';
    }

    public function toSearchableArray() {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    //评论模型
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    //用户关联
    public function zan($user_id) {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    //文章的赞
    public function zans() {
        return $this->hasMany(\App\Zan::class);
    }
}
