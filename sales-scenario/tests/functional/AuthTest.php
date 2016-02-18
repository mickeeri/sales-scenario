<?php

/**
 * Created by PhpStorm.
 * User: roYal
 * Date: 08/02/16
 * Time: 18:44
 */
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AuthTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */

    public function test_if_new_user_can_register()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => $name, 'email' => $faker->email, 'password' => $password, 'password_confirmation' =>$password];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/dashboard')->see('inloggad')
            //checks if name value is stored in database
            ->seeInDatabase('users', ['username' => $name]);
    }

    /** @test */

    public function can_user_login()
    {
        $this->login()
            ->visit('login')
            ->see('inloggad');
    }

}