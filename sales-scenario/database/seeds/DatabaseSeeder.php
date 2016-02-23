<?php

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        // To avoid foreign key constraints.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Clear out all tables in toTruncate-array
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->call('LinksTableSeeder');
        $this->command->info('Links table seeded');

        $this->call('UsersTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('ExpertsTableSeeder');
        $this->command->info('Experts table seeded!');

        $this->call('TagsTableSeeder');
        $this->command->info('Tags table seeded!');

        $this->call('PodcastsTableSeeder');
        $this->command->info('Podcast table seeded!');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        factory('App\User', 40)->create();

        User::create
        (
            [
                'username'  => 'Testuser',
                'email'     => 'test@user.se',
                'password'  => '123456',
                'remember_token' => str_random(10),

            ]
        );
    }
}

class ExpertsTableSeeder extends Seeder {

    public function run()
    {
        factory('App\Expert', 100)->create();
    }
}


class PodcastsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();
        $experts =  \App\Expert::all();

        // Creates between 1 and 10 podcasts per expert.
        foreach ($experts as $expert) {
            $loop = rand(0,10);
            for($i = 0; $i <= $loop; $i++) {
                $podcast = new \App\Podcast();
                $podcast->expert_id = $expert->id;
                $podcast->title = $faker->sentence($nbWords = 3);
                $podcast->filename = str_random(6).'m4a';
                $podcast->save();
                // Assigns filename same as podcast id and saves again.
                $podcast->filename = $podcast->id.'.m4a';
                $podcast->save();

                // Replace with example-file in /seed.
                copy(__DIR__ . '/example.m4a', \App\Podcast::podcastLocation() . $podcast->filename);
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
        $defaultTagNames = ['Sales Strategy', 'Sales Tactics', 'Sales Process', 'Big Deals Management',
            'Selling To Small & Medium Businesses', 'Sales Team Coaching', 'Sales Hiring', 'Social Selling',
            "Sales KPIs", 'Old School Sales', 'Management & Business Growth'];

        foreach($defaultTagNames as $tagName) {
            \App\Tag::create(['name' => $tagName]);
        };

        // Adding tags to experts.
        $experts = Expert::all();
        $tags = \App\Tag::all();

        /** @var \App\Expert $expert */
        foreach($experts as $expert)
        {
            $loop = rand(0,3);

            for($i = 0; $i <= $loop; $i++) {

                $id = rand($tags->min('id'), $tags->count());

                // Avoiding duplication.
                if(!$expert->tags()->find($id))
                {
                    $expert->tags()->attach($id);
                    $expert->save();
                }
            }
        }
    }
}
