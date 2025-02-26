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
        Schema::table('pers', function (Blueprint $table) {
            $table->bigInteger('cats_id') -> nullable() -> unsigned() -> change();
            $table->foreign('cats_id')->references('id')->on('cats') -> nullOnDelete();
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
