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
        Schema::create('permintaan_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kerja_sama_id")->constrained();
            $table->foreignId("supplier_bahan_baku_id")->constrained();
            $table->longText("request");
            $table->boolean("telah_dibaca")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_bahan_bakus');
    }
};
