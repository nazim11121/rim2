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
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice')->index()->unsigned()->nullable();
            $table->bigInteger('checkout_id')->index()->unsigned()->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->string('start_date', 60)->index();
            $table->string('end_date', 60)->index();
            $table->string('day', 60)->index();
            $table->integer('adult')->index();
            $table->integer('kids')->nullable()->index();
            $table->string('room_id', 191)->nullable()->index();
            $table->string('name', 60)->nullable()->index();
            $table->string('nid_no', 60)->nullable()->index();
            $table->string('address', 60)->nullable()->index();
            $table->string('mobile', 15)->nullable()->index();
            $table->string('email', 60)->nullable()->index();
            $table->string('gender', 60)->nullable()->index();
            $table->string('age', 60)->nullable()->index();
            $table->string('name2', 60)->nullable()->index();
            $table->string('nid_no2', 60)->nullable()->index();
            $table->string('address2', 60)->nullable()->index();
            $table->string('mobile2', 15)->nullable()->index();
            $table->string('email2', 60)->nullable()->index();
            $table->string('file', 191)->nullable()->index();
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
        Schema::dropIfExists('check_ins');
    }
};
