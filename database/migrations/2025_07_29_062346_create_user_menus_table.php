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
        Schema::create('user_menus', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',11)->nullable();
            $table->string('menu_id',90)->nullable();
            $table->string('user_menu_id',11)->nullable();
            $table->tinyInteger('category')->nullable();
            $table->string('name',45)->nullable();
            $table->string('route',45)->nullable();
            $table->string('icon',45)->nullable();
            $table->tinyInteger('is_menu')->nullable();
            $table->tinyInteger('is_dropdown')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_menus');
    }
};
