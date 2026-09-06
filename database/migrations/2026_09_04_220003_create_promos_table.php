<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* Discount codes lived in the page source until now, readable by anyone and with
   no use counter. This table is the fix. max_uses and used_count are the columns
   that were missing: without them a code never really expires. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();                 // stored uppercase
            $t->enum('type', ['pct', 'flat']);
            $t->decimal('value', 8, 4);                   // pct: 0.1000 = 10%.  flat: taka
            $t->string('label');

            $t->date('starts_on')->nullable();            // null: always live
            $t->date('ends_on')->nullable();
            $t->unsignedTinyInteger('min_nights')->nullable();
            $t->json('stay_slugs')->nullable();           // null: any stay

            $t->unsignedInteger('max_uses')->nullable();  // null: unlimited
            $t->unsignedInteger('used_count')->default(0);
            $t->unsignedInteger('max_uses_per_email')->nullable();

            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('promos'); }
};
