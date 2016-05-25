<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->increments('complain_id');
            $table->string('id_pengguna', 10)->comment('Siapa yang submit aduan');
            $table->string('user_emp_id',10)->nullable()->comment('Siapa owner aduan');
            $table->text('complain_description');
            $table->smallInteger('complain_level_id')->unsigned();
            $table->smallInteger('complain_source_id')->unsigned();
            $table->smallInteger('unit_id')->nullable()->unsigned()->comment('Unit mana yang bertindak atau bertanggungjawab');
            $table->integer('ict_no')->nullable()->unsigned()->comment('Ambil dari table SMICT_MASTER');
            $table->integer('lokasi_id')->nullable()->unsigned()->comment('Ambil dari table SPH_KOD_LOKASI');
            $table->smallInteger('complain_category_id')->unsigned();
            $table->smallInteger('complain_status_id')->unsigned();
            $table->timestamp('assign_date')->nullable();
            $table->text('helpdesk_delay_reason')->nullable();
            $table->timestamp('complete_date')->nullable();
            $table->text('delay_reason')->nullable();
            $table->text('action_comment')->nullable();
            $table->string('action_emp_id',10)->nullable();
            $table->timestamp('action_date')->nullable();
            $table->text('reference')->nullable();
            $table->string('verify_emp_id',10);
            $table->timestamp('verify_date')->nullable();
            $table->text('user_comment')->nullable();
            $table->smallInteger('verify_status')->nullable()->unsigned();
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
        Schema::drop('complains');
    }
}
