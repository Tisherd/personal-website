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
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->dropColumn('technology_stack');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->jsonb('technology_stack');
        });
    }
};
