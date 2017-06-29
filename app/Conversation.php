<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function user_one() {
        return $this->belongsToMany('App\User', 'users', 'user_one_id');
    }

    public function user_two() {
        return $this->belongsToMany('App\User', 'users', 'user_two_id');
    }
}
