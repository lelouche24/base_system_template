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
        Schema::create('submenus', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 45)->nullable();
            $table->string('submenu_id', 11)->nullable();
            $table->string('menu_id', 11)->nullable();
            $table->tinyInteger('is_nav')->nullable();
            $table->string('name',90)->nullable();
            $table->string('nav_name',255)->nullable();
            $table->string('route',255)->nullable();
            $table->string('ip_created',20)->nullable();
            $table->string('ip_updated',20)->nullable();
            $table->string('user_created',45)->nullable();
            $table->string('user_updated',45)->nullable();
            $table->integer('public')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenus');
    }
};
