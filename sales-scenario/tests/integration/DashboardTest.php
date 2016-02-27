<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = \App\User::find(1);

        //Test if Heading Most Contributing exists
        $this->actingAs($user)
            ->visit('dashboard')
            ->see('Most Contributing');

        //Test if Heading Explore Topics exists
        $this->actingAs($user)
            ->visit('dashboard')
            ->see('Explore Topics');

        //Test if View More Link Topics exists
        $this->actingAs($user)
            ->visit('dashboard')
            ->seeLink('View more', '/explore');

        //Test if element a exists in /dashboard
        $this->actingAs($user)
            ->visit('dashboard')
            ->seeLink('Play');
    }
}
