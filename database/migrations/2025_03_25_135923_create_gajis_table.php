<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan');
            $table->decimal('gaji_pokok', 12, 2);
            $table->decimal('komponen_tambahan', 12, 2)->default(0);
            $table->decimal('potongan', 12, 2)->default(0);
            $table->string('periode_pembayaran'); // Format: YYYY-MM
            $table->foreignId('processed_by')->constrained('hr_admins', 'id_admin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gaji');
    }
};