<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('id_cuti');
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_persetujuan', ['Disetujui', 'Ditolak', 'Menunggu'])->default('Menunggu');
            $table->text('alasan');
            $table->date('tanggal_persetujuan')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('hr_admins', 'id_admin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuti');
    }
};