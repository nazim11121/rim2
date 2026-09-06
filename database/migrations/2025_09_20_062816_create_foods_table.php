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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('type', 191)->nullable();
            $table->string('category', 191)->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->string('image', 191)->nullable();
            $table->unsignedBigInteger('priority')->nullable()->comment('Lower value means higher priority');
            $table->text('remarks')->nullable();
            $table->boolean('status')->default(0)->comment('1=active,0=inactive');
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
        Schema::dropIfExists('foods');
    }
};
