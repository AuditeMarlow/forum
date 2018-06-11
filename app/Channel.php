<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The threads associated with this channel.
     *
     * @return []\App\Thread
     */
    public function threads()
    {
        return $this->hasMany('App\Thread');
    }
}
