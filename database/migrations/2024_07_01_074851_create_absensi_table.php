<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('jenis', ['MASUK', 'PULANG']);
            $table->string('photo_path');
            $table->decimal('lat', 15, 10);
            $table->decimal('lng', 15, 10);
            $table->unsignedTinyInteger('izin')->default(0);
            $table->unsignedBigInteger('izin_id');
            $table->foreign('izin_id')->references('id')->on('izins')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
