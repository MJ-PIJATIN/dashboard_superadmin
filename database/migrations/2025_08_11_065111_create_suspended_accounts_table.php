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
        Schema::create('suspended_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('suspension_id')->unique();
            $table->unsignedBigInteger('therapist_id');
            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->string('national_id_number', 20);
            $table->string('email');
            $table->string('phone_number');
            $table->text('address');
            $table->string('work_area');
            $table->string('photo_url')->nullable();
            $table->string('duration');
            $table->text('reason');
            $table->text('reason_description');
            $table->timestamp('suspended_at');
            $table->timestamp('suspension_ends_at')->nullable();
            $table->timestamps();

            // Note: Foreign key constraints assume 'therapists' and 'complaints' tables exist.
            // If not, you can add these in a separate migration.
            // $table->foreign('therapist_id')->references('id')->on('therapists')->onDelete('cascade');
            // $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspended_accounts');
    }
};
