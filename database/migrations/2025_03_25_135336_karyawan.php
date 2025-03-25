<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password'); // Tambahkan kolom password
            $table->string('jabatan');
            $table->date('tanggal_bergabung');
            $table->foreignId('last_updated_by')->nullable()->constrained('hr_admins', 'id_admin');
            $table->rememberToken(); // Untuk fitur "remember me"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
