<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataAwn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_awns', function(Blueprint $table){
            $table->id();
            $table->string('nama_stasiun', 20)->nullable(false);
            $table->integer('stok_awal');
            $table->integer('output');
            $table->integer('input');
            $table->date('tanggal')->nullable(false);
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
        //
    }
}
