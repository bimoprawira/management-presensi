<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id('id_cuti');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('status_persetujuan')->default('Diproses');
            $table->text('alasan');
            $table->date('tgl_persetujuan')->nullable();
            $table->integer('jatah_cuti')->default(5);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
