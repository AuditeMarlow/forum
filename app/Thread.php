<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * @return []\App\Reply
     */
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
