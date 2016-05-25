<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complain_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('complain_id')->unsigned();
            $table->string('action_by',10);
            $table->text('action_comment');
            $table->text('reference')->nullable();
            $table->text('delay_reason')->nullable();
            $table->text('user_comment')->nullable();
            $table->string('user_emp_id',10)->nullable();
            $table->timestamp('verify_date')->nullable();
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
        Schema::drop('complain_actions');
    }
}
