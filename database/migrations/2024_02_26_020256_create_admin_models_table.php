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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('username');
            $table->string('password');
            $table->string('user_type');
            $table->string('status');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('fullname');
            $table->string('position');
            $table->string('department');
            $table->string('user_roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
