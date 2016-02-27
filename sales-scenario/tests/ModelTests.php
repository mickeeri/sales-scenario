<?php
use App\User;
use App\Expert;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ModelTests extends TestCase
{
    use DatabaseTransactions;



//    public function a_user_can_be_an_expert()
//    {
//        $user = factory(User::class)->create();
//        $expert = factory(Expert::class)->make();
//        $user->experts()->save($expert);
//    }
}