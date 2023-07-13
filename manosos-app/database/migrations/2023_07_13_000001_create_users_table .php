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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('id_usuario');
            $table->integer('status');
            $table->string('descripcion');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
