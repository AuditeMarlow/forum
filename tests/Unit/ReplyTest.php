<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itHasAnOwner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
