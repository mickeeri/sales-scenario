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

    private function getRegistrationUserFields()
    {
        $faker = Faker\Factory::create();
        return ['username' => $faker->name, 'email' => $faker->email, 'password' => $faker->password, 'password_confirmation' =>$faker->password];
    }

    private function attemptRegistration($message, $empty, $check = 'email')
    {
        $fields = $this->getRegistrationUserFields();
        $fields[$empty] = '';

        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/register')->see($message)
            //checks if name value is stored in database
            ->dontSeeInDatabase('users', [$check => $fields[$check]]);
    }
    /** @test */
    public function test_if_new_user_can_register()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $password = $faker->password;
        $fields = ['username' => $name, 'email' => $faker->email, 'password' => $password, 'password_confirmation' =>$password];
        $this->visit('register')
            ->submitForm('Register', $fields)
            ->seePageIs('/dashboard')->see('Logout')
            //checks if name value is stored in database
            ->seeInDatabase('users', ['username' => $name]);
    }

    /** @test */
    public function test_if_new_user_can_register_without_name()
    {
        $this->attemptRegistration('The username field is required.', 'username');
    }

    /** @test */
    public function test_if_new_user_can_register_without_email()
    {
        $this->attemptRegistration('The email field is required.', 'email', 'username');
    }

    /** @test */
    public function test_if_new_user_can_register_without_password()
    {
        $this->attemptRegistration('The password field is required.', 'password');
    }

    /** @test */
    public function test_if_new_user_can_register_without_password_confirmation()
    {
        $this->attemptRegistration('The password confirmation does not match.', 'password_confirmation');
    }

    /** @test */
    public function can_user_login()
    {
        $this->login()
            ->visit('login')
            ->see('Logout');
    }

    private function attemptLogin($fields, $message)
    {
        $this->visit('login')
            ->submitForm('Sign in', $fields)
            ->seePageIs('/login')->see($message);
    }

    public function invalid_user_can_not_user_login()
    {
        $this->attemptLogin(['email' => "invalid@invalid.se", 'password' => "passed"], 'These credentials do not match our records.');
    }

    /** @test */
    public function user_can_not_login_without_password()
    {
        $this->attemptLogin(['email' => "invalid@invalid.se", 'password' => ""], 'The password field is required.');
    }

    /** @test */
    public function user_can_not_login_without_email()
    {
        $this->attemptLogin(['email' => "", 'password' => "passed"], 'The email field is required.');
    }

    /** @test */
    public function email_is_sent_when_forgot_password()
    {
        $user = factory(App\User::class)->create();

        $fields = ['email' => $user->email];
        try {
            $this->visit('password/reset');
            $this->submitForm('Send Password Reset Link', $fields);
        }catch(Exception $e){}finally{
            $this->seeInDatabase('password_resets', ['email' => $user->email]);
        }
    }
}