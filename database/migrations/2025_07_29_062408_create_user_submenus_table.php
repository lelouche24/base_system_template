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
        Schema::create('user_submenus', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',11)->nullable();
            $table->string('submenu_id',90)->nullable();
            $table->string('user_menu_id',90)->nullable();
            $table->tinyInteger('is_nav')->nullable();
            $table->string('name',90)->nullable();
            $table->string('nav_name',90)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_submenus');
    }
};
