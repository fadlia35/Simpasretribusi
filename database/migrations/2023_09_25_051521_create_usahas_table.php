<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usahas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pemilik');
            $table->uuid('id_blok');
            $table->string('nama_usaha', 255);
            $table->text('foto_usaha');
            $table->date('tgl_tagihan');
            $table->double('jlh_tagihan');
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
        Schema::dropIfExists('usahas');
    }
}
