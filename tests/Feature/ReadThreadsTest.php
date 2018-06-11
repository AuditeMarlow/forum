<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Thread
     */
    protected $thread;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanViewAllThreads()
    {
        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanReadASingleThread()
    {
        $response = $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanReadRepliesThatAreAssociatedWithAThread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanFilterThreadsAccordingToAChannel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanFilterThreadsByAnyUsername()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }
}
