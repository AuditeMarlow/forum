<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInThreadsTest extends TestCase
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

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /**
     * @test
     * @return void
     */
    public function anUnauthenticatedUserMayNotParticipate()
    {
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /**
     * @test
     * @return void
     */
    public function aReplyRequiresABody()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
