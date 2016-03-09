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
        $this->visit('expert/' . $expert->slug)
            ->see($imgUrl)
            //check  img in player view
            ->visit('/player/'.$expert->slug.'/'.$podcast->slug)
            ->see($imgUrl);
    }

    /**
     * Test if expert has img, it is showing
     *
     */
    public function test_expert_img_is_showing()
    {
        $this->login();
        $expert = $this->getExpertWithPodcastAndImage();
        $podcast = $expert->podcasts[0];
        $imgUrl = $expert->photo;

        $this->expert_img_is_showing($expert, $podcast, $imgUrl);
        $this->removeImage($expert);
    }

    /**
     * Test if expert does NOT have img, dummy img is showing
     *
     */
    public function test_expert_img_is_dummy()
    {
        $this->login();
        $expert = $this->getExpertWithPodcast();
        $podcast = $expert->podcasts[0];
        $imgUrl = 'expert_photo/blank-profile-picture.png';

        $this->expert_img_is_showing($expert, $podcast, $imgUrl);
        $this->removeImage($expert);
    }



}