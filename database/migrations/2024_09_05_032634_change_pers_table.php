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
			$table->renameColumn('email', 'sort_order')->integer('sort_order');
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
