<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function anAuthenticatedUserCanCreateNewThreads()
    {
        $this->be(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $response = $this->get('/threads/'.$thread->id)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * @test
     * @return void
     * @expectedException \Illuminate\Auth\AuthenticationException
     */
    public function guestsMayNotCreateThreads()
    {
        $this->post('/threads', []);
    }
}
