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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_title', 191)->nullable();
            $table->string('receiver_name', 191)->nullable();
            $table->decimal('payment_amount', 10,2)->nullable();
            $table->decimal('due_amount', 10,2)->nullable();
            $table->string('payment_method', 50)->comment('cash,bkash,nagad,card,bank');
            $table->text('note')->nullable();
            $table->boolean('status')->default(0)->comment('1=paid,0=unpaid,2=partial');
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
        Schema::dropIfExists('expenses');
    }
};
