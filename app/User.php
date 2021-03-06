<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use  App\Fan;

class User extends Authenticatable {
    protected $fillable = [
        'name', 'email', 'password'
    ];

    //用户文章
    public function posts() {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }

    //我的粉丝
    public function fans() {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }

    //我关注的Fan模型
    public function stars() {
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }

    //关注某人
    public function doFan($uid) {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($uid) {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    //当前这个人是否被uid关注
    public function hasFan($uid) {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid) {
        return $this->stars()->where('star_id', $uid)->count();
    }

}
