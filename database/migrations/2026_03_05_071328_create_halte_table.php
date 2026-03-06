<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('halte', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koridor_id')->constrained('koridor')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('tipe', 20)->default('halte'); // halte, terminal, hub
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halte');
    }
};
