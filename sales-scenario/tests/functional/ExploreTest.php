<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExploreTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;
    
    private function getExpertWithPodcast()
    {
        //Create an expert with a podcast record
        $expert = factory(App\Expert::class)->create();
        $podcast = new App\Podcast;
        $podcast->title = "Example podcast";
        $podcast->expert_id = $expert->id;
        $expert->podcasts->add($podcast);
        $podcast->filename = "test.mp3";
        $podcast->save();
        $podcast->filename = "{$podcast->id}.mp3";
        $podcast->save();

        return $expert;
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_explore_returns_correrct_url()
    {
        $this->visit('explore')
            ->seePageIs('/explore');
    }

    public function test_explore_returns_200()
    {
        $response = $this->call('GET', '/explore');
        $this->assertEquals(200, $response->status());
    }

    public function test_expert_without_podcast_does_not_list()
    {
        $expert = factory(App\Expert::class)->create();
        $this->visit('explore')
            ->seePageIs('/explore')
            ->dontSeeLink("$expert->first_name $expert->last_name");
    }

    public function test_expert_with_podcast_does_list()
    {
        $expert = $this->getExpertWithPodcast();
        $podcast = $expert->podcasts[0];

        $this->seeInDatabase('podcasts', ['title' => "$podcast->title"]);

        //First letter in last name that we want to see in expert list
        $letter = strtoupper(substr($expert->last_name, 0, 1));

        //Go to explore page and see expert in list
        $this->visit('explore')
            ->seePageIs('/explore')
            ->seeLink("$expert->first_name $expert->last_name")
            ->seeInElement('h2', $letter);

    }

    public function test_expert_view_displays_expert_info_and_podcast()
    {
        $expert = $this->getExpertWithPodcast();

        //Test response code of expert route
        $response = $this->call('GET', 'expert/' . $expert->id);
        $this->assertEquals(200, $response->status());

        //Navigate to Experts page and see relevant information and podcast.
        $this->visit('expert/' . $expert->id)
            ->see("$expert->first_name $expert->last_name")
            ->see($expert->website)
            ->see($expert->info)
            ->seeInElement('h3', 'Podcasts by '.$expert->name)
            ->seeInElement('.title', $expert->podcasts[0]->title)
            ->seeInElement('.podcast-date', date("Y-m-d"));
    }
}
