<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpertTest extends TestCase
{

    public function test_create_new_expert()
    {
        $this->visit('/panel/login')
            ->type('admin@change.me', 'email')
            ->type('12345', 'password')
            ->press('Login')
            ->see('Dashboard')
            //Logged in
            ->get('/panel/User/edit')
            ->see('Save')
            ->post
            ($this->baseUrl . 'panel/User/edit?insert=1',
                [
                    'username'              => 'cocdco',
                    'email'                 => 'cocco@cooco.se',
                    'password'              => '123456',
                    'password_confirmation' => '123456',
                    '_token'                => csrf_field(),
                ]
            )
            ->dontSee('Save');






    }
}
