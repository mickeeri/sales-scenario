<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    use DatabaseTransactions;

    private function routeTestUrl($url, $method='GET', $status = 200)
    {
        $this->login();
        $response = $this->call($method, $url);
        $this->assertEquals($status, $response->status());

        return $this;
    }

    public function test_get_dashboard_return_200()
    {
        $this->routeTestUrl('dashboard');
    }

    public function test_get_explore_return_200()
    {
        $this->routeTestUrl('explore');
    }

    public function test_get_explore_with_tag_return_200()
    {
        $tag = \App\Tag::create(['name' => 'Test']);

        $this->routeTestUrl("explore/{$tag->slug}")
        ->see('data-selected="' . $tag->id . '"');
    }

    public function test_get_expert_return_200()
    {
        $expert = $this->getExpertWithPodcast();
        $this->routeTestUrl("expert/{$expert->slug}");
    }

    public function test_get_player_return_200()
    {
        $expert = $this->getExpertWithPodcast();
        $this->routeTestUrl("player/{$expert->slug}/{$expert->podcasts[0]->slug}");
    }

    public function test_get_history_return_200()
    {
        $this->routeTestUrl("player/history");
    }

    public function test_get_history_with_parameters_return_200()
    {
        $this->routeTestUrl("player/history/7/10");
    }

    public function test_get_profile_return_200()
    {
        $this->routeTestUrl("profile");
    }
}
