<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* A STAY is the thing the website sells. A ROOM is the thing housekeeping cleans.
   Four cottages are one stay and one room each. The Pod is ONE stay and THREE
   rooms, sold as a whole unit only (confirmed by the client). Do not collapse
   these two ideas into one table: the website needs the stay, the front desk
   needs the room. This table is deliberately separate from Admin\Room /
   Admin\RoomType, which power the existing front-desk check-in flow. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stays', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();            // golpata, moual, arronyok, chitra, pod

            $t->string('name');
            $t->string('meaning')->nullable();
            $t->text('description')->nullable();

            $t->unsignedTinyInteger('min_guests')->default(1);
            $t->unsignedTinyInteger('max_guests')->default(3);

            /* per_person_occupancy: the cottages. Rate depends on how many share
                 one cottage, and sole occupancy costs MORE per head.
               per_person_group:     the Pod. Rate depends on group size and the
                 weekday reduction is already inside the stored figure. */
            $t->enum('pricing_mode', ['per_person_occupancy', 'per_person_group'])
              ->default('per_person_occupancy');

            // Whole-unit stays cannot be part-sold. The Pod is the only one today.
            $t->boolean('whole_unit_only')->default(false);

            $t->string('hero_image')->nullable();
            $t->unsignedSmallInteger('sort_order')->default(0);
            $t->boolean('is_published')->default(true);

            $t->integer('created_by')->nullable();
            $t->integer('updated_by')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('stays'); }
};
