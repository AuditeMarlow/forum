<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * @return \App\User
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
