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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->index();
            $table->string('type', 60)->nullable()->index();
            $table->string('short_code', 60)->nullable()->index();
            $table->bigInteger('adult_capacity')->nullable()->index();
            $table->bigInteger('kids_capacity')->nullable()->index();
            $table->string('base_price', 11)->nullable()->index();
            $table->bigInteger('priority')->nullable()->index();
            $table->string('amenities', 191)->nullable()->index();
            $table->text('description')->nullable();
            $table->string('image', 191)->nullable();
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
        Schema::dropIfExists('room_types');
    }
};
