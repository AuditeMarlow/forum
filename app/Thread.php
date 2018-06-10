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
        'user_id', 'channel_id', 'title', 'body'
    ];

    /**
     * @return string
     */
    public function path()
    {
        return '/threads/'.$this->channel->slug.'/'.$this->id;
    }

    /**
     * @return \App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return []\App\Reply
     */
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    /**
     * @param  \App\Reply  $reply
     * @return bool
     */
    public function addReply(Reply $reply)
    {
        $this->replies()->create($reply->toArray());
    }

    /**
     * @return \App\Channel
     */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
}
