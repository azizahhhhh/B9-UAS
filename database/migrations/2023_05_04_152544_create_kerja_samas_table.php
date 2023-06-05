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
        Schema::create('kerja_samas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pemilik_usaha_id");
            $table->unsignedBigInteger("supplier_id");
            $table->foreign("pemilik_usaha_id")->references("id")->on("users");
            $table->foreign("supplier_id")->references("id")->on("users");
            $table->enum("is_accepted", ["Menunggu Persetujuan", "Diterima", "Ditolak"])->default("Menunggu Persetujuan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_samas');
    }
};
