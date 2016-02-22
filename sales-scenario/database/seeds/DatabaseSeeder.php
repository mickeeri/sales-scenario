<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Expert;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'links','expert_tag', 'tags', 'experts', 'podcasts'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        // To avoid foreign key constraints.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Clear out all tables in toTruncate-array
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $this->call('LinksTableSeeder');
        $this->command->info('Links table seeded');

        $this->call('UsersTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('TagsTableSeeder');
        $this->command->info('Tags table seeded!');

        $this->call('ExpertsTableSeeder');
        $this->command->info('Experts table seeded!');

        $this->call('PodcastsTableSeeder');
        $this->command->info('Podcast table seeded!');

        // TODO: tags to experts.
        // TODO: Seedklasser i egna filer?
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        factory('App\User', 40)->create();
    }
}

class ExpertsTableSeeder extends Seeder {

    public function run()
    {
        factory('App\Expert', 40)->create();
    }
}


class PodcastsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();
        $experts =  \App\Expert::all();

        // Creates 3 podcast per expert.
        foreach ($experts as $expert) {
            foreach (range(1, 3) as $index) {
                $podcast = new \App\Podcast();
                $podcast->expert_id = $expert->id;
                $podcast->title = $faker->sentence($nbWords = 3);
                $podcast->filename = str_random(6).'m4a';
                $podcast->save();
                // Assigns filename same as podcast id and saves again.
                $podcast->filename = $podcast->id.'.m4a';
                $podcast->save();

                // TODO: filnamn kopplade till riktig fil.
            }
        }
    }
}

class LinksTableSeeder extends Seeder {

    public function run()
    {
        $defaultLinksSalesScenario =
        [
            ['display' => 'Links'   ,   'url' => 'Link', 'main' => 1],
            ['display' => 'Users'   ,   'url' => 'User', 'main' => null],
            ['display' => 'Experts' ,   'url' => 'Expert', 'main' => null],
            ['display' => 'Podcasts' ,   'url' => 'Podcast', 'main' => null]
        ];

        // Seed to db from $defaultLinksSalesScenario
        foreach($defaultLinksSalesScenario as $link)
        {
            \Serverfireteam\Panel\Link::create
            (
                [
                    'display' => $link['display'],
                    'url'     => $link['url'],
                    'main'     => $link['main']
                ]
            );
        };
    }
}

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $defaultTagNames = ['Sales Strategy', 'Sales Tactics', 'Big Deals Management', 'Big Deals Management',
            'Selling To Small & Medium Businesses', 'Sales Team Coaching', 'Sales Hiring', 'Social Selling',
            "Sales KPI's", 'Old School Sales', 'Management & Business Growth'];

        foreach($defaultTagNames as $tagName) {
            \App\Tag::create(['name' => $tagName]);
        };
    }
}
