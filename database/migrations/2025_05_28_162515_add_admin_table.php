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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('phoneNumber');
            $table->string('email');
            $table->string('address');
            $table->boolean('isActive')->default(true);
            $table->string('username', 15)->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
};
