<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HistoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_visit_to_player_adds_history()
    {
        $history = $this->populateHistory(1);
        $this->visit("player/history");

        foreach ($history as $entry) {
            $this->see($entry['expert'])
                ->see($entry['podcast']);
        }
    }

    public function test_latest_history_is_shown()
    {
        $history = $this->populateHistory(15);
        $this->visit("player/history");

        for ($i = count($history)-1; $i >= 10; $i--) {
            $this->dontSee($history[$i]['expert'])
                ->dontSeeInElement('span.title',$history[$i]['podcast']);
        }
    }

    public function test_invalid_arguments()
    {
        $values = [
            35 => 200,
            'sef' => 'sef',
            'sef' => 10,
            30 => 'sef'
        ];

        foreach ($values as $days => $limit) {
            $this->visit("player/history/{$days}/{$limit}")
                ->seePageIs('player/history/30/10');
        }
    }

    public function test_history_limit()
    {
        $values = [10,25,50,100];
        foreach ($values as $value) {
            $this->historyLimit($value, "player/history/30/{$value}", $value);
        }
    }

    public function test_history_days()
    {
        $values = [1,7,30];
        foreach ($values as $value) {
            $this->historyLimit($value, "player/history/{$value}/100");
        }
    }

    private function historyLimit($limit = 10, $url, $valid = 1)
    {
        $history = $this->populateHistory($limit + 5, $valid);
        $this->visit($url);

        for ($i = count($history) - 1; $i >= $limit; $i--) {
            $this->dontSee($history[$i]['expert'])
                ->dontSeeInElement('span.title',$history[$i]['podcast']);
        }

        for ($i = 0; $i < count($history) - 5; $i++) {
            $this->see($history[$i]['expert'])
                ->seeInElement('span.title',$history[$i]['podcast']);
        }
    }

    private function populateHistory($numberOfItems = 1, $valid = 30)
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $history = array();

        for($i = 0; $i < $numberOfItems; $i++){

            $expert = $this->getExpertWithPodcast();
            $podcast = $expert->podcasts[0];

            $expert->first_name .= $i . 'x';
            $podcast->title .= $i . 'x';

            $expert->save();
            $podcast->save();

            if($valid > 0){
                $date = \Carbon\Carbon::now()->subSeconds($i)->format('Y-m-d H:i:s');
            }else{
                $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d H:i:s');
            }
            $valid--;

            DB::table('podcast_user')->insert([
                'podcast_id' => $podcast->id,
                'user_id' => $user->id,
                'created_at' => $date
            ]);

            $history[] = ['expert' => $expert->full_name, 'podcast' => $podcast->title];
        }

        return $history;
    }
}
