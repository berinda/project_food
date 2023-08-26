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
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menuId');
            $table->longText('tutorialmemasak');
            $table->timestamps();

            $table->foreign('menuId')->references('id')->on('menus')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};
