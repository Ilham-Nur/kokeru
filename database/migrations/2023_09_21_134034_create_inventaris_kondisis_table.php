<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisKondisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_kondisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_sarana_id')->constrained('inventaris_saranas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('bulan');
            $table->tinyInteger('kuantiti');
            $table->tinyInteger('kondisi');
            $table->tinyInteger('dipinjam');
            $table->tinyInteger('mutasi');
            $table->tinyInteger('user');
            $table->tinyInteger('sign');
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
        Schema::dropIfExists('inventaris_kondisis');
    }
}
