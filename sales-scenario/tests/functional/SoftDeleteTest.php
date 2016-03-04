<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SoftDeleteTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_exists_in_database_after_delete()
    {
        $user = User::create([
            'username'  => 'SoftDelete',
            'email'     => 'delete@user.se',
            'password'  => '123456',
            'remember_token' => str_random(10),
        ]);

        $this->seeInDatabase('users', ['username' => "$user->username", 'deleted_at' => null]);

        $time = date("Y-m-d H:i:s");
        $user->delete();
        $this->seeInDatabase('users', ['username' => "$user->username", 'deleted_at' => $time]);
    }

    public function test_expert_exists_in_database_after_delete()
    {
        $expert = \App\Expert::create([
            'first_name' => 'Kalle',
            'last_name' => 'Anka',
            'info' => 'Hej',
            'website' => 'http://www.test.com'
        ]);

        $this->seeInDatabase('experts', ['id' => "$expert->id", 'deleted_at' => null]);

        $time = date("Y-m-d H:i:s");
        $expert->delete();
        $this->seeInDatabase('experts', ['id' => "$expert->id", 'deleted_at' => $time]);
    }
}