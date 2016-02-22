<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Expert;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('LinksTableSeeder');
        $this->command->info('Links table seeded');

        //$this->call('UserTableSeeder');
        //$this->command->info('User table seeded!');
    }

}


/*
//To seed db with som data run php artisna db:seed
class UserTableSeeder extends Seeder {

    public function run()
    {
        //Seed users table
        DB::table('users')->delete();

        User::create
        (
            [
                'username'  => 'userseed',
                'email'     => 'user@user.se',
                'password'  => '123456'
            ]
        );

        DB::table('experts')->delete();

        //Seed experts table
        Expert::create
        (
            [
                'first_name'                => 'testers_first_name',
                'last_name'                 => 'testers_last_name',
                'website'                  => 'www.tester.com',
                'info'                      => 'Best salesman ever!',
            ]
        );
    }
}
*/


class LinksTableSeeder extends Seeder {

    public function run()
    {
        //Warning! Delete() will Remove all existing rows
        DB::table('links')->delete();

        $defaultLinksSalesScenario =
        [
            ['display' => 'Users'   ,   'url' => 'User'],
            ['display' => 'Experts' ,   'url' => 'Expert'],
            ['display' => 'Podcasts',   'url' => 'Podcast']
        ];


        //Seed to db from $defaultLinksSalesScenario =
        foreach($defaultLinksSalesScenario as $link)
        {
            \Serverfireteam\Panel\Link::create
            (
                [
                    'display' => $link['display'],
                    'url'     => $link['url']
                ]
            );
        };
    }
}




