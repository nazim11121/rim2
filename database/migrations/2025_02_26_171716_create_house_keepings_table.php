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
        Schema::create('house_keepings', function (Blueprint $table) {
            $table->id();
            $table->string('amenities_id', 60)->index();
            $table->string('room_no', 60)->index();
            $table->text('description')->nullable();
            $table->string('vendor_id')->nullable()->index();
            $table->boolean('status')->default(0)->comment('1=clean,0=dirty');
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
        Schema::dropIfExists('house_keepings');
    }
};
