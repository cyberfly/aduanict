<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class NavigationHelpdeskTest extends TestCase
{
    /**
     * Navigation test for Helpdesk user.
     *
     * @return void
     */

    public function testComplainIndexLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);
        $this->visit('/complain')
            ->see('Senarai Aduan');
    }

    public function testComplainShowLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);
        $this->visit('/complain/33373')
            ->see('Maklumat Aduan');
    }

    public function testComplainActionLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);

        $this->visit('/complain/33387/action')
            ->see('Maklumat Aduan');
    }

    public function testComplainPaginationLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);
        $this->visit('/complain?page=2')
            ->see('Senarai Aduan')
            ->seePageIs('/complain?page=2');
    }

    public function testMonthlyStatisticReportLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);
        $this->visit('/report/monthly_statistic_aduan_ict')
            ->see('Monthly Statistic Report');
    }

    public function testMonthlyStatisticTableReportLink()
    {
        //login sebagai Helpdesk
        $user = User::whereName('helpdesk')->first();
        $this->actingAs($user);
        $this->visit('/report/monthly_statistic_table_aduanict')
            ->see('Dis');
    }
}
