<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationTest extends TestCase
{
    /**
     * Navigation test for normal user
     *
     * @return void
     */

    //when access direct link to Tambah Aduan
    public function testCreateComplainLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain/create')
            ->see('Hantar Aduan');
    }

    //when access direct link to Senarai Aduan

    public function testComplainIndexLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->see('Senarai Aduan');
    }

    //when access direct link to Papar Aduan

    public function testComplainShowLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain/33373')
            ->see('Maklumat Aduan');
    }

    //when access direct link to Kemaskini Aduan

    public function testComplainEditLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain/33387/edit')
            ->see('Maklumat Aduan');
    }

    //when access direct link to Pengesahan Aduan

    public function atestVerifyComplainEditLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('complain/33374/edit')
            ->see('Selesai')
            ->see('Tidak Selesai');
    }

    //when access direct link to pagination Senarai Aduan

    public function testComplainPaginationLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain?page=2')
            ->see('Senarai Aduan')
            ->seePageIs('/complain?page=2');
    }

    //when click Tambah Aduan button on Senarai Aduan
    public function testCreateComplainMenuLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->click('Tambah Aduan')
            ->see('Hantar Aduan')
            ->seePageIs('/complain/create');
    }

    //when click Kemaskini button on Senarai Aduan
    public function atestEditComplainMenuLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->click('Kemaskini')
            ->see('Maklumat Aduan')
            ->see('Hantar');
    }

    //when click Papar button on Senarai Aduan
    public function testShowComplainMenuLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->click('Papar')
            ->see('Maklumat Aduan');
    }

    //when click Pengesahan button on Senarai Aduan
    public function atestVerifyComplainMenuLink()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->click('Pengesahan')
            ->see('Selesai')
            ->see('Tidak Selesai');
    }
}
