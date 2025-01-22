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
        Schema::create('history_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable(false);
            $table->dateTime('relapseDays')->nullable();
            $table->string('reasons', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_users');
    }
};
