<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_id')->constrained('ruang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('no_seri');
            $table->string('jenis');
            $table->string('merk');
            $table->string('type');
            $table->string('kapasitas');
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
        Schema::dropIfExists('data_acs');
    }
}
