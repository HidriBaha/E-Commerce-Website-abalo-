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
        Schema::create('ab_article', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('ab_name', 80);
            $table->bigInteger('ab_price')->Nullable(false);
            $table->string('ab_description', 1000)->nullable(false);
            $table->bigInteger('ab_creator_id')->unsigned();
            $table->foreign('ab_creator_id')->references('id')->on('ab_user')->cascadeOnDelete();
            $table->timestamp('ab_createdate')->nullable(false)->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
