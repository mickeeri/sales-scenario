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

    public function test_if_new_user_can_register_without_name()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => '', 'email' => $faker->email, 'password' => $password, 'password_confirmation' =>$password];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/register')->see('The username field is required.')
            //checks if name value is stored in database
            ->dontSeeInDatabase('users', ['email' => $faker->email]);
    }

    /** @test */

    public function test_if_new_user_can_register_without_email()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => $name, 'email' => '', 'password' => $password, 'password_confirmation' =>$password];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/register')->see('The email field is required.')
            //checks if name value is stored in database
            ->dontSeeInDatabase('users', ['username' => $name]);
    }

    /** @test */

    public function test_if_new_user_can_register_without_password()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => $name, 'email' => $faker->email, 'password' => '', 'password_confirmation' =>$password];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/register')->see('The password field is required.')
            //checks if name value is stored in database
            ->dontSeeInDatabase('users', ['username' => $name]);
    }

    /** @test */

    public function test_if_new_user_can_register_without_password_confirmation()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => $name, 'email' => $faker->email, 'password' => $password, 'password_confirmation' => ''];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/register')->see('The password confirmation does not match.')
            //checks if name value is stored in database
            ->dontSeeInDatabase('users', ['username' => $name]);
    }

    /** @test */

    public function can_user_login()
    {
        $this->login()
            ->visit('login')
            ->see('inloggad');
    }

    /** @test */

    public function invalid_user_can_not_user_login()
    {
        $fields = ['email' => "invalid@invalid.se", 'password' => "passed"];
        $this->visit('login')
            ->submitForm('Sign in', $fields)
            ->seePageIs('/login')->see('These credentials do not match our records.');
    }

    /** @test */

    public function user_can_not_login_without_password()
    {
        $fields = ['email' => "invalid@invalid.se", 'password' => ""];
        $this->visit('login')
            ->submitForm('Sign in', $fields)
            ->seePageIs('/login')->see('The password field is required.');
    }

    /** @test */

    public function user_can_not_login_without_email()
    {
        $fields = ['email' => "", 'password' => "passed"];
        $this->visit('login')
            ->submitForm('Sign in', $fields)
            ->seePageIs('/login')->see('The email field is required.');
    }

    /** @test */

    public function email_is_sent_when_forgot_password()
    {
        $user = factory(App\User::class)->create();

        $fields = ['email' => $user->email];
        try {
            $this->visit('password/reset');
            $time = date("Y-m-d H:i:s");
            $this->submitForm('Send Password Reset Link', $fields);
        }catch(Exception $e){

        }
        finally{
            //Kan ge fail om exekveringstiden är för lång!! Ska tas tillbaka när mail är uppsatt
            $this->seeInDatabase('password_resets', ['email' => $user->email /*, 'created_at' => $time*/]);
        }
    }
}