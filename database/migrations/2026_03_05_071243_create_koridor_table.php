<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('koridor', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);          // K01, K02, ...
            $table->string('nama');               // Koridor 01 - Terminal Mamboro - ...
            $table->string('warna', 20)->default('#3b82f6'); // hex color
            $table->text('deskripsi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koridor');
    }
};
