<?php

namespace App;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body'
    ];

    /**
     * @return []\App\Reply
     */
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    /**
     * @return \App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @param  \App\Reply  $reply
     * @return bool
     */
    public function addReply(Reply $reply)
    {
        $this->replies()->create($reply->toArray());
    }
}
