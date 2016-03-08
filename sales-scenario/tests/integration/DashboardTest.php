<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_headings_and_links_in_dashboard_view()
    {
        $this->login();

        // If no experts or podcasts is in database.
        $this->visit('dashboard')
            ->see('Most Contributing')
            ->see('Explore Topics')
            ->seeLink('View more')
            ->dontSeeLink('Play');

        $this->getExpertWithPodcast();

        // Only show play if expert with podcast exists.
        $this->visit('dashboard')
            ->seeLink('Play');
    }
}
