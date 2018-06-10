<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function anAuthenticatedUserMayParticipateInForumThreads()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post('/threads/'.$thread->id.'/replies', $reply->toArray());

        $this->get('/threads/'.$thread->id)
            ->assertSee($reply->body);
    }

    /**
     * @test
     * @return void
     * @expectedException \Illuminate\Auth\AuthenticationException
     */
    public function anUnauthenticatedUserMayNotParticipate()
    {
        $this->post('/threads/1/replies', []);
    }
}
