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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->nullable()->index();
            $table->string('nid_no', 60)->nullable()->index();
            $table->text('address')->nullable();
            $table->string('mobile', 15)->nullable()->index();
            $table->string('email', 60)->nullable()->index();
            $table->string('gender', 60)->nullable()->index();
            $table->string('image', 191)->nullable()->index();
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
        Schema::dropIfExists('vendors');
    }
};
