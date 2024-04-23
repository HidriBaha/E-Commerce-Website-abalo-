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
        Schema::create('ab_article_has_articlecategory', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
                        $table->bigInteger('ab_article_id')->unsigned()->nullable(false); // Corrected column name
;
            $table->bigInteger('ab_articlecategory_id')->unsigned()->nullable(false);
            $table->foreign('ab_article_id')->references('id')->on('ab_article');
            $table->foreign('ab_articlecategory_id')->references('id')->on('ab_articlecategory');

            $table->unique(['ab_article_id', 'ab_articlecategory_id']); // Corrected unique constraint
        });
       /*Schema::table('ab_articlecategory', function (Blueprint $table) {
            $table->unique(['ab_articlecategory_id', 'ab_article_id']);
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
