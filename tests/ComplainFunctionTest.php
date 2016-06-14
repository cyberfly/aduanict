<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ComplainFunctionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateComplain()
    {
        //login sebagai Abu
        $user = User::whereName('abu')->first();
        $this->actingAs($user);
        $this->visit('/complain/create');
        $this->select('1-107', 'complain_category_id');
        $this->select('20', 'branch_id');
        $this->select('238', 'lokasi_id');
        $this->select('1946', 'ict_no');
        $this->select('3', 'complain_source_id');
        $this->type('test guna phpunit 3', 'complain_description');
        $this->attach('/Users/applehorizons/Documents/sofa322.jpg', 'complain_attachment');
        $this->press('Hantar');
        $this->seePageIs('/complain');
        $this->see('Senarai Aduan');

    }
}
