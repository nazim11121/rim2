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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('amenities_id', 191)->nullable()->index();
            $table->string('room_no', 191)->nullable()->index();
            $table->text('description')->nullable();
            $table->string('vendor_id')->nullable()->index();
            $table->string('quantity')->nullable()->index();
            $table->boolean('status')->default(0)->comment('1=received,0=assigned');
            $table->string('assign_date', 60)->nullable()->index();
            $table->string('receive_date', 60)->nullable()->index();
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
        Schema::dropIfExists('laundries');
    }
};
