<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    public $baseUrl = 'http://homestead.app';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function login()
    {
        $user = factory(App\User::class)->create();
        return $this->actingAs($user);
    }

    public function loginAsAdmin()
    {
        $user = factory(Serverfireteam\Panel\Admin::class)->create();
        return $this->actingAs($user);
    }

    protected function getExpertWithPodcast()
    {
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

    protected function getExpertWithPodcastAndImage()
    {
        $expert = $this->getExpertWithPodcast();
        $expert->photo = "{$expert->id}.png";
        $expert->save();
        copy(__DIR__ . '/example.png', public_path() . '/expert_photo/' . $expert->photo);
        return $expert;
    }

    protected function removeImage($expert)
    {
        if(is_file(public_path() . '/expert_photo/' . $expert->photo)){
            unlink(public_path() . '/expert_photo/' . $expert->photo);
        }
    }
}
