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
        Schema::create('ab_articlecategory', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('ab_name', 100)->unique()->nullable(false);
            $table->string('ab_description', 1000)->nullable(false);
            $table->unsignedBigInteger('ab_parent')->nullable();

        });
        Schema::table('ab_articlecategory', function (Blueprint $table) {
            $table->foreign('ab_parent')->references('id')->on('ab_articlecategory');
            $table->string('ab_description')->nullable()->change();
        });
        Schema::table('ab_article', function (Blueprint $table) {
            $table->string('ab_description')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ab_article', function (Blueprint $table) {
            $table->string('ab_description')->nullable(false)->change();
        });
    }
};
