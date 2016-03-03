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
    public function test_if_expert_with_most_podcasts_show(){

        //Since the factory creates expert with max 10 podcasts, this expert must be most contributing
        $expert = $this->create_expert_with_podcasts(12);
        $this->visit('dashboard')
            ->see("$expert->firstName $expert->lastName");
    }
}
