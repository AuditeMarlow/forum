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
        $response = $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     * @return void
     */
    public function aUserCanReadRepliesThatAreAssociatedWithAThread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $response = $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
