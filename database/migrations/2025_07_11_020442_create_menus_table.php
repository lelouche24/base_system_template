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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('slug',90)->nullable();
            $table->string('menu_id',11)->nullable();
            $table->string('menuCategory_create',45)->nullable();
            $table->integer('order')->nullable();
            $table->string('menuName_create',45)->nullable();
            $table->string('menuRoute_create',45)->nullable();
            $table->string('icon',45)->nullable();
            $table->tinyInteger('is_menu_create')->nullable();
            $table->tinyInteger('is_dropdown_create')->nullable()->default(0);
            $table->timestamps();
            $table->string('ip_created',20)->nullable();
            $table->string('ip_updated',20)->nullable();
            $table->string('user_created',45)->nullable();
            $table->string('user_updated',45)->nullable();
            $table->string('tags')->nullable();
            $table->string('menuPortal_create')->nullable();
            $table->tinyInteger('vis')->default(1);
            $table->tinyInteger('lm')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
