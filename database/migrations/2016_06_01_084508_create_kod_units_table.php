<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKodUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spsm_kod_unit', function (Blueprint $table) {
            $table->increments('kod_id',22);
            $table->string('butiran',50);
            $table->integer('susunan');
            $table->string('kod_papar',3);
            $table->string('initials',10);
            $table->string('emp_id_ketua',10);
            $table->string('idkerani',10);
            $table->integer('status');
            $table->integer('kodbhg');
            $table->string('operasi',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kod_units');
    }
}
