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
        Schema::table('cubes', function (Blueprint $table) {
            $table->foreignId('tag_id')->after('name')->nullable()->constrained()->nullOnDelete();;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cubes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tag_id');
        });
    }
};
