<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *  1	BARU
            2	TINDAKAN
            3	SAHKAN (P)
            4	SAHKAN (H)
            5	SELESAI
            6	DIHAPUSKAN
        */
        Schema::create('complain_statuses', function (Blueprint $table) {
            $table->increments('status_id');
            $table->string('description');
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('complain_statuses');
    }
}
