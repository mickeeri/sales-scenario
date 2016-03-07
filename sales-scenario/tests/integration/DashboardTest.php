<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    public function test_headings_and_links_in_dashboard_view()
    {
        $user = \App\User::find(1);

        $this->actingAs($user)
            ->visit('dashboard')
            ->see('Most Contributing')
            ->see('Explore Topics')
            ->seeLink('View more')
            ->seeLink('Play');
    }
}
