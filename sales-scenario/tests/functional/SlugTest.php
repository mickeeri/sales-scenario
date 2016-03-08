<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlugTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function test_if_valid_expert_slug_dont_redirect()
    {
        $expert = factory(App\Expert::class)->create();
        $page = 'expert/' . $expert->slug;

        $this->visit($page)
            ->seePageIs($page);
    }

    public function test_if_invalid_expert_slug_redirects_to_explore_view()
    {
        $expert = factory(App\Expert::class)->create();
        $page = 'expert/invalid' . $expert->slug;

        $this->visit($page)
            ->seePageIs('explore')
            ->see("The sales expert you are looking for can't be found");
    }
}
