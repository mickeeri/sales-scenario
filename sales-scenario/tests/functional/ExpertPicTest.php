<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpertPicTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     * Test expert img
     *
     */
    private function expert_img_is_showing($expert, $podcast, $imgUrl)
    {
        //check img in expert-view
        $this->visit('expert/' . $expert->id)
            ->see($imgUrl)
            //check  img in player view
            ->visit('/player/'.$expert->id.'/'.$podcast->id)
            ->see($imgUrl);
    }

    /**
     * Test if expert has img, it is showing
     *
     */
    public function test_expert_img_is_showing()
    {
        $expert = \App\Expert::whereNotNull('photo')->first();              //Get the 1st expert with photo in db
        $podcast = \App\Podcast::where('expert_id', $expert->id)->first();  //Get 1 podcast from the expert
        $imgUrl = $expert->photo;

        $this->expert_img_is_showing($expert, $podcast, $imgUrl);
    }

    /**
     * Test if expert does NOT have img, dummy img is showing
     *
     */
    public function test_expert_img_is_dummy()
    {
        $expert = \App\Expert::where('photo', '')->first();                 //Get the 1st expert WITHOUT photo in db
        $podcast = \App\Podcast::where('expert_id', $expert->id)->first();  //Get 1 podcast from the expert
        $imgUrl = 'expert_photo/blank-profile-picture.png';

        $this->expert_img_is_showing($expert, $podcast, $imgUrl);
    }



}