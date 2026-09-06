<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('email', 191);
            $table->string('phone', 60)->nullable();
            $table->string('subject', 191)->nullable();
            $table->text('message')->nullable();
            $table->string('type', 30)->default('contact')->comment('contact,booking');
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->integer('guests')->nullable();
            $table->string('status', 30)->default('new')->comment('new,responded,closed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
