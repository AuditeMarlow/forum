<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'thread_id', 'user_id', 'body'
    ];

    /**
     * @return \App\User
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
