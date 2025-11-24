<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('file_integrity_records')) {
            Schema::create('file_integrity_records', function (Blueprint $table) {
                $table->id();
                $table->string('path')->unique();
                $table->string('sha256_hash');
                $table->timestamp('last_scanned_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('file_integrity_records');
    }
};
