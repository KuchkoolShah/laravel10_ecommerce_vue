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
        Schema::create('temp_users', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('user_type')->default(2)->comment('1-regestered user, 2-non regestered user ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_users');
    }
};
