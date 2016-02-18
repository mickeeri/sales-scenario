<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    public $baseUrl = 'http://homestead.app';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * login as a fake user
     */
    public function login()
    {
        $user = factory(App\User::class)->create();
        return $this->actingAs($user);
    }
    /**
     * login as a fake admin
     */
    public function loginAsAdmin()
    {
        $user = factory(Serverfireteam\Panel\Admin::class)->create();
        return $this->actingAs($user);
    }
}
