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
        Schema::create('period_tariffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->index();
            $table->float('amount')->index();

            $table->unique(['period_id']);

            $table->foreign('period_id')
                ->references('id')
                ->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_tariffs');
    }
};
