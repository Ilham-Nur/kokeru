<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintananceAcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintanance_ac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_ac_id')->constrained('data_ac')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mitra')->constrained('users');
            $table->date('tanggal');
            $table->text('description');
            $table->bigInteger('arus');
            $table->bigInteger('tegangan');
            $table->bigInteger('tekanan');
            $table->string('remaks');
            // $table->enum('kondisi', ['sudah_pemeliharaan','belum_pemeliharaan']);
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
        Schema::dropIfExists('maintanance_acs');
    }
}
