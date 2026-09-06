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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('type', 60)->nullable()->index();
            $table->string('name', 60)->index();
            $table->string('room_no', 60)->nullable()->index();
            $table->string('floor', 60)->nullable()->index();
            $table->bigInteger('priority')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->boolean('available_status')->default(0)->comment('1=booked,0=available');
            $table->boolean('status')->default(1)->comment('1=active,0=inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
