<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spesifikasi_bus', function (Blueprint $table) {
            $table->id();
            $table->string('kunci', 50)->unique(); // kapasitas, kursi, warna, dll
            $table->string('label');               // Kapasitas Total
            $table->string('nilai');               // 35 Penumpang
            $table->string('ikon', 50)->default('bx bx-info-circle');
            $table->string('warna', 20)->default('#3b82f6');    // icon color
            $table->string('warna_bg', 40)->default('rgba(59,130,246,0.08)'); // bg color
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_bus');
    }
};
