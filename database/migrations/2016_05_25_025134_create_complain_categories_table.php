<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complain_categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('description');
            $table->integer('kod_unit');
            $table->boolean('has_asset')->nullable()->default(true);
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
        Schema::drop('complain_categories');
    }
}
