<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardFuncTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

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

}
