<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserProfileTest extends TestCase
{

    use DatabaseTransactions;


    public function getCredentials($user)
    {
        return ['email' => $user->email, 'password' => 'qwerty', 'password_confirmation' => 'qwerty',
            'current_password' => 'qwerty' ];
    }

    /**
     * @param $message = The message users see
     * @param $change = Change on optional attribute in field array
     * @param $value = value for the changed attribute
     * @param string $passwordConfirmation = optional if you want to change password confirmation
     */
    public function updateUserAttempt($message, $change, $value, $passwordConfirmation = 'qwerty')
    {
        $user = factory(App\User::class)->create(['password' => 'qwerty']);
        $fields = $this->getCredentials($user);
        $fields[$change] = $value;
        $fields['password_confirmation'] = $passwordConfirmation;
        $this->actingAs($user)
            ->visit('profile')
            ->submitForm('Update', $fields)
            ->see($message);
    }


    /** @test */

    public function test_if_user_can_update_email()
    {
        $this->updateUserAttempt('User successfully updated', 'email', 'newMail@mail.se');
            $this->seeInDatabase('users', ['email' => 'newMail@mail.se']);
    }

    /** @test */

    public function try_to_update_user_without_entering_current_password()
    {
        $this->updateUserAttempt('The current password field is required', 'current_password', '');
    }

    /** @test */

    public function try_to_update_user_with_wrong_current_password()
    {
        $this->updateUserAttempt('Current password is wrong', 'current_password', 'wrong');
    }

    /** @test */

    public function test_if_user_can_change_password()
    {
        $this->updateUserAttempt('User successfully updated', 'password', '123456', '123456');
    }

    /** @test */

    public function test_if_user_can_change_to_existing_email()
    {
        factory(App\User::class)->create(['email' => 'newMail@mail.se']);
        $this->updateUserAttempt('The email has already been taken', 'email', 'newMail@mail.se');
        $this->seeInDatabase('users', ['email' => 'newMail@mail.se']);
    }

}
