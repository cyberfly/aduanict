<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
//        $this->withoutMiddleware();

        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain/create')
             ->see('Hantar Aduan');
    }
}
