<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->INCREMENTS('id')->nullable();
            $table->STRING('ict_id',20)->nullable();
            $table->STRING('harta_id',20)->nullable();
            $table->STRING('butiran',100)->nullable();
            $table->INTEGER('status')->nullable();
            $table->INTEGER('kod_kategori')->nullable();
            $table->INTEGER('kod_sub_kategori')->nullable();
            $table->DATE('tkh_beli')->nullable();
            $table->DATE('tkh_jaminan')->nullable();
            $table->STRING('no_siri',50)->nullable();
            $table->STRING('no_invoice',25)->nullable();
            $table->STRING('no_rujukan',25)->nullable();
            $table->INTEGER('jenama')->nullable();
            $table->STRING('emp_id',10)->nullable();
            $table->STRING('kod_pembekal',10)->nullable();
            $table->INTEGER('harga_beli')->nullable();
            $table->INTEGER('lokasi_id')->nullable();
            $table->STRING('ipaddress',30)->nullable();
            $table->STRING('catatan',1000)->nullable();
            $table->INTEGER('ict_no_master')->nullable();
            $table->INTEGER('pembelian_id')->nullable();
            $table->STRING('kod_pinjam',10)->nullable();
            $table->STRING('pengguna_id',50)->nullable();
            $table->STRING('kod_lesen',10)->nullable();
            $table->INTEGER('kod_auditict')->nullable();
            $table->DATE('tkh_disposed')->nullable();
            $table->INTEGER('kod_alasan_disp')->nullable();
            $table->STRING('catat_disp',100)->nullable();
            $table->string('kod_tahaprisiko',1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assets');
    }
}
