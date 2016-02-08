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


class RegistrationTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */

    public function test_if_new_user_can_register()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;

        $this->visit('register')
            ->type($name, 'username')
            ->type($faker->email, 'email')
            ->type($password, 'password')
            ->type($password, 'password_confirmation')
            ->press('Register')
            ->seePageIs('/')->see('Welcome')

            //checks if name value is stored in database
            ->seeInDatabase('users', ['username' => $name]);
    }

}