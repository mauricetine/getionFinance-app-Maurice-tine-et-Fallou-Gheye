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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emetteur_id');
            $table->unsignedBigInteger('beneficiaire_id');
            $table->string('notification');
            $table->decimal('montant', 10, 2);
            $table->timestamps();

            $table->foreign('emetteur_id')->references('id')->on('users');
            $table->foreign('beneficiaire_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
