<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateComplainLink()
    {
        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain/create')
            ->see('Hantar Aduan');
    }

    public function testComplainIndexLink()
    {
        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain')
            ->see('Senarai Aduan');
    }

    public function testComplainShowLink()
    {
        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain/33373')
            ->see('Maklumat Aduan');
    }

    public function testComplainEditLink()
    {
        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain/33387/edit')
            ->see('Maklumat Aduan');
    }

    public function testComplainPaginationLink()
    {
        $user = new User(array('name' => 'abu'));
        $this->be($user);
        $this->visit('http://aduanict.dev/complain?page=2')
            ->see('Senarai Aduan')
            ->seePageIs('http://aduanict.dev/complain?page=2');
    }



}
