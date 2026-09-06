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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('checkout_date', 60)->index();
            $table->bigInteger('booking_id')->index()->unsigned();
            $table->decimal('room_cost', 10,2);
            $table->decimal('food_cost', 10,2)->nullable();
            $table->decimal('laundry_cost', 10,2)->nullable();
            $table->decimal('service_cost', 10,2)->nullable();
            $table->decimal('other_cost', 10,2)->nullable();
            $table->decimal('subtotal', 10,2);
            $table->decimal('discount', 10,2)->nullable();
            $table->string('discount_type', 20)->nullable()->comment('percentage,fixed');
            $table->decimal('vat', 10,2)->nullable();
            $table->decimal('grand_total', 10,2);
            $table->decimal('advanced', 10,2)->nullable();
            $table->decimal('due', 10,2)->nullable();
            $table->string('payment_method', 50)->comment('cash,card,bkash,nagad,bank');
            $table->string('transaction_id', 191)->nullable();
            $table->string('file', 191)->nullable();
            $table->string('note', 191)->nullable();
            $table->boolean('payment_status')->default(0)->comment('1=active,0=inactive');
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
        Schema::dropIfExists('checkouts');
    }
};
