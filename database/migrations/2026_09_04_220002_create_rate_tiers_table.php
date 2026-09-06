<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* ONE table prices both modes. The resolver is the same sentence in both cases:
   "the tier whose from_guests is the highest value not exceeding the party size."

   Cottages have tiers at 1, 2, 3.  The Pod at 6, 8, 10.

   weekday_rate is the ALREADY REDUCED figure. The 15% Sunday-to-Thursday
   discount is stored, never applied a second time at quote time. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_tiers', function (Blueprint $t) {
            $t->id();
            $t->foreignId('stay_id')->constrained()->cascadeOnDelete();
            $t->unsignedTinyInteger('from_guests');
            $t->unsignedInteger('weekday_rate');   // Sun to Thu, per person, per night, whole taka
            $t->unsignedInteger('weekend_rate');   // Fri, Sat, holidays
            $t->timestamps();

            $t->unique(['stay_id', 'from_guests']);
        });
    }

    public function down(): void { Schema::dropIfExists('rate_tiers'); }
};
