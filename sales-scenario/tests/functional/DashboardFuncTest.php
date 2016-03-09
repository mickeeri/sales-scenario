<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardFuncTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    private function create_expert_with_podcasts($numberOfPodcasts){

        $expert = factory(App\Expert::class)->create();

        for ($i = 0; $i <= $numberOfPodcasts; $i++) {
            $podcast = new App\Podcast;
            $podcast->title = "Example podcast";
            $podcast->expert_id = $expert->id;
            $expert->podcasts->add($podcast);
            $podcast->filename = "test.mp3";
            $podcast->save();
            $podcast->filename = "{$podcast->id}.mp3";
            $podcast->save();
        }
        return $expert;
    }

    public function test_expert_with_most_podcasts_show(){

        //Since the factory creates expert with max 10 podcasts, this expert must be most contributing

        $leastContributing = $this->create_expert_with_podcasts(2);

        for ($i = 0; $i < 5; $i++) {
            $this->create_expert_with_podcasts(5);
        }

        $mostContributing = $this->create_expert_with_podcasts(8);

        $this->visit('dashboard')
            ->see("$mostContributing->full_name")
            ->dontSee("$leastContributing->full_name");
    }

    public function test_expert_not_most_contributing_not_show(){

        $expert_no_podcasts = factory(App\Expert::class)->create();

        $this->visit('dashboard')
            ->dontSeeLink("$expert_no_podcasts->full_name");

    }

    public function test_5_tags_always_show(){
        $tags = [];
        for ($i = 0; $i < 5; $i++) {
            $tags[] = \App\Tag::create([
                'name' => "Tag name " . $i
            ]);
        }

        //Tags are randomized, so lets make sure we see the 5 tags after a refresh
        for ($i = 0; $i < 2; $i++) {
            $this->visit("dashboard");

            foreach ($tags as $tag) {
                $this->seeLink($tag->name);
            }
        }
    }

    public function test_expert_without_podcast_not_show(){
        for ($i = 0; $i < 4; $i++) {
            $this->create_expert_with_podcasts(1);
        }

        $expert_no_podcasts = factory(App\Expert::class)->create();
        $this->visit('dashboard')
            ->dontSeeLink("$expert_no_podcasts->full_name");
    }
}
