<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrColumnsToRuangTable extends Migration
{
    public function up()
    {
        Schema::table('ruang', function (Blueprint $table) {
            $table->string('scan_token', 64)->nullable()->unique()->after('pj_ruang');
            $table->string('qr_path')->nullable()->after('scan_token'); // contoh: qr/ruang-1.svg
            $table->string('qr_url')->nullable()->after('qr_path');     // URL yang di-encode ke QR
        });
    }

    public function down()
    {
        Schema::table('ruang', function (Blueprint $table) {
            $table->dropColumn(['scan_token', 'qr_path', 'qr_url']);
        });
    }
}
