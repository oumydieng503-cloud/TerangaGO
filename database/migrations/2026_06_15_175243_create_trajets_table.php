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
    Schema::create('trajets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ligne_id')->constrained('lignes')->onDelete('cascade');
        $table->foreignId('bus_id')->constrained('bus')->onDelete('cascade');
        $table->date('date_depart');
        $table->time('heure_depart');
        $table->decimal('prix', 8, 2);
        $table->integer('places_dispo');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
