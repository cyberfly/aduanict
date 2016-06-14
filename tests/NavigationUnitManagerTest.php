<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationUnitManagerTest extends TestCase
{
    /**
     * Navigation test for Unit Manager user.
     *
     * @return void
     */

    public function testCreateComplainLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/complain/create')
            ->see('Hantar Aduan');
    }

    public function testComplainIndexLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->see('Senarai Aduan');
    }

    public function testComplainAgihanLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/complain/33384/assign')
            ->see('Agih');
    }

    public function testComplainShowLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/complain/33373')
            ->see('Maklumat Aduan');
    }

    public function testComplainPaginationLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/complain?page=2')
            ->see('Senarai Aduan')
            ->seePageIs('/complain?page=2');
    }

    public function testMonthlyStatisticReportLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/report/monthly_statistic_aduan_ict')
            ->see('Monthly Statistic Report');
    }

    public function testMonthlyStatisticTableReportLink()
    {
        //login sebagai UnitManager
        $user = User::whereName('unitmanager')->first();
        $this->actingAs($user);
        $this->visit('/report/monthly_statistic_table_aduanict')
            ->see('Dis');
    }
}
