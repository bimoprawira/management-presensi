<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->string('status');
            $table->text('geolokasi');
            $table->time('time_clock_in')->nullable();
            $table->time('time_clock_out')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensis');
    }
};