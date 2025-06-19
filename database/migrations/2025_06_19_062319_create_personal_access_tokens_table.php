<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Cegah error duplikat jika tabel sudah ada
        if (!Schema::hasTable('personal_access_tokens')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->morphs('tokenable'); // Kolom tokenable_type & tokenable_id
                $table->string('name'); // Nama token (misal: "Token Login Mobile")
                $table->string('token', 64)->unique(); // Token unik yang dipakai user
                $table->text('abilities')->nullable(); // Hak akses (bisa null)
                $table->timestamp('last_used_at')->nullable(); // Terakhir dipakai
                $table->timestamp('expires_at')->nullable(); // Jika token punya masa kedaluwarsa
                $table->timestamps(); // created_at & updated_at
            });
        }
    }

    /**
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
