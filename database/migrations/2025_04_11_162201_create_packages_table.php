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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('no_of_person')->unsigned()->nullable();
            $table->bigInteger('no_of_day')->unsigned()->nullable();
            $table->double('price')->nullable();
            $table->string('price_for',60)->nullable();
            $table->bigInteger('no_of_bed_room')->unsigned()->nullable();
            $table->bigInteger('no_of_bed')->unsigned()->nullable();
            $table->bigInteger('no_food_serve')->unsigned()->nullable();
            $table->mediumText('food_item', 191)->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
