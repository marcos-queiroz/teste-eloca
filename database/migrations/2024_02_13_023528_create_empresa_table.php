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
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigInteger('recnum')->unsigned()->unique();
            $table->decimal('codigo', 4, 0)->unique();
            $table->decimal('empresa', 4, 0);
            $table->string('sigla', 40);
            $table->string('razao_social', 255);

            $table->primary(['codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
