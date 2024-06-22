<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_usaha');
            $table->dateTime('tgl_pembayaran');
            $table->double('jlh_pembayaran');
            $table->double('denda');
            $table->text('bukti_pembayaran');
            $table->enum('status', ['baru', 'lunas', 'jatuh_tempo'])->default('baru');
            $table->string('updated_by', 150);
            $table->string('deleted_by', 150);
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
        Schema::dropIfExists('pembayarans');
    }
}
