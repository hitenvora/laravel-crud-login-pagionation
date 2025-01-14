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
        Schema::create('cruds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_pic');
            $table->string('hobby');
            $table->string('gender');
            $table->string('email');
            $table->string('number');
            $table->string('address');
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('cruds');
        Schema::table('cruds', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
