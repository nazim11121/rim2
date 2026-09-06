<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* VAT, weekend days, holidays and the property cap belong here rather than in
   config, because the office needs to change them without a deploy. Eid moves
   every year; nobody should need a developer for that. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->json('value');
            $t->string('note')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('settings'); }
};
