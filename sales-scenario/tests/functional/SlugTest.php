<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlugTest extends TestCase
{
    use DatabaseTransactions;

    private function getExpert()
    {
        return App\Expert::create([
            'first_name' => "First name",
            'last_name' => "Last name",
            'info' => "info",
            'website' => "website"
        ]);
    }
    private function getTag()
    {
        return App\Tag::create([
            'name' => "Tag name"
        ]);
    }

    private function getPodcast($expert)
    {
        $podcast = new \App\Podcast();
        $podcast->expert_id = $expert->id;
        $podcast->title = "Podcast name";
        $podcast->filename = str_random(6).'m4a';
        $podcast->save();
        // Assigns filename same as podcast id and saves again.
        $podcast->filename = $podcast->id.'.m4a';
        $podcast->save();
        return $podcast;
    }

    public function test_expert_slugs_iterates()
    {
        $expert = $this->getExpert();

        $this->assertEquals("first-name-last-name", $expert->slug);

        $expert2 = $this->getExpert();

        $this->assertNotEquals("first-name-last-name", $expert2->slug);
        $this->assertEquals("first-name-last-name-1", $expert2->slug);

        $expert3 = $this->getExpert();

        $this->assertNotEquals("first-name-last-name", $expert3->slug);
        $this->assertNotEquals("first-name-last-name-1", $expert3->slug);
        $this->assertEquals("first-name-last-name-2", $expert3->slug);
    }

    public function test_model_with_soft_delete_does_not_break_constraint()
    {
        $expert = $this->getExpert();
        $this->assertEquals("first-name-last-name", $expert->slug);

        $expert->delete();

        $verify = $this->getExpert();
        $this->assertEquals("first-name-last-name-1", $verify->slug);
    }

    public function test_tag_slugs_iterates()
    {
        $tag = $this->getTag();

        $this->assertEquals("tag-name", $tag->slug);

        $tag2 = $this->getTag();

        $this->assertNotEquals("tag-name", $tag2->slug);
        $this->assertEquals("tag-name-1", $tag2->slug);

        $tag3 = $this->getTag();

        $this->assertNotEquals("tag-name", $tag3->slug);
        $this->assertNotEquals("tag-name-1", $tag3->slug);
        $this->assertEquals("tag-name-2", $tag3->slug);
    }

    public function test_podcast_slugs_iterates()
    {
        $expert = $this->getExpert();

        $podcast = $this->getPodcast($expert);

        $this->assertEquals("podcast-name", $podcast->slug);

        $podcast2 = $this->getPodcast($expert);

        $this->assertNotEquals("podcast-name", $podcast2->slug);
        $this->assertEquals("podcast-name-1", $podcast2->slug);

        $podcast3 = $this->getPodcast($expert);

        $this->assertNotEquals("podcast-name", $podcast3->slug);
        $this->assertNotEquals("podcast-name-1", $podcast3->slug);
        $this->assertEquals("podcast-name-2", $podcast3->slug);
    }
}
