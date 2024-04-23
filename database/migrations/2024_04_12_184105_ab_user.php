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
        Schema::create('ab_user', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('ab_name', 80);
            $table->string('ab_password', 200)->Nullable(false);
    $table->string('ab_email', 200)->unique()->nullable(false);
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
