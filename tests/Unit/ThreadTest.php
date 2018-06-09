<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
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

        $this->thread = factory('App\Thread')->create();
    }

    /**
     * @test
     * @return void
     */
    public function aThreadCanHaveReplies()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->thread->replies
        );
    }

    /**
     * @test
     * @return void
     */
    public function aThreadHasACreator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /**
     * @test
     * @return void
     */
    public function aThreadCanAddAReply()
    {
        $reply = factory('App\Reply')->make([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);

        $this->thread->addReply($reply);

        $this->assertCount(1, $this->thread->replies);
    }
}
