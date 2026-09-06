<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* A RESERVATION is a website booking request for a STAY (see the stays-table
   comment). It is unrelated to the existing Admin\CheckIn / Admin\Checkout
   front-desk flow, which tracks a physical guest at a physical ROOM. Called
   "reservation", not "booking", to keep that boundary unmistakable.

   Every money column is whole taka, stored as an integer. Never a float: a float
   subtotal is how a quote and an invoice come to disagree by one taka.

   The five money columns are stored, not recomputed, so an old reservation still
   shows the price the guest actually agreed to after a rate change.

   No payment gateway in this build: bookings are reservation requests, not paid
   transactions. The resort confirms dates first, then collects a deposit
   directly. amount_paid / payment_status are still tracked so staff can record
   that manually. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $t) {
            $t->id();
            $t->string('reference')->unique();            // BON-8F3K2Q, what the guest quotes on the phone

            $t->foreignId('stay_id')->constrained();
            $t->date('check_in');
            $t->date('check_out');
            $t->unsignedSmallInteger('nights');
            $t->unsignedTinyInteger('guests');

            $t->string('guest_name');
            $t->string('guest_phone');
            $t->string('guest_email')->nullable();
            $t->text('guest_note')->nullable();

            $t->foreignId('promo_id')->nullable()->constrained()->nullOnDelete();
            $t->string('promo_code')->nullable();         // kept verbatim even if the promo is deleted

            $t->unsignedInteger('nightly_rate');          // per person, per night, as quoted
            $t->unsignedInteger('gross');
            $t->unsignedInteger('weekday_discount')->default(0);
            $t->unsignedInteger('promo_discount')->default(0);
            $t->unsignedInteger('net');
            $t->unsignedInteger('vat');
            $t->unsignedInteger('total');
            $t->unsignedInteger('amount_paid')->default(0);

            $t->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'no_show'])
              ->default('pending');
            $t->enum('payment_status', ['unpaid', 'partial', 'paid', 'refunded'])
              ->default('unpaid');

            $t->string('source')->default('website');     // website, phone, walk_in, ota
            $t->timestamp('confirmed_at')->nullable();
            $t->timestamp('cancelled_at')->nullable();
            $t->text('cancel_reason')->nullable();
            $t->timestamps();

            // The availability query reads these three together on every check.
            $t->index(['stay_id', 'check_in', 'check_out']);
            $t->index('status');
        });
    }

    public function down(): void { Schema::dropIfExists('reservations'); }
};
