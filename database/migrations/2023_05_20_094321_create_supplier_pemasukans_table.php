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
        Schema::create('supplier_pemasukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->date("date");
            $table->foreignId("bahan_baku_id")->constrained();
            $table->string("selling");
            $table->bigInteger("income");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_pemasukans');
    }
};
