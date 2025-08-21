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
        Schema::dropIfExists('notifications');
        
        Schema::create('notifications', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->string('action');
            $table->enum('target_type', ['SuperAdmin', 'Admin', 'Karyawan', 'Terapis', 'Pelanggan'])->nullable();
            $table->string('target_id', 255)->nullable();
            $table->text('message');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
