<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('metal_type_id')->nullable()->after('category_id');
            $table->foreign('metal_type_id')->references('id')->on('metal_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['metal_type_id']);
            $table->dropColumn('metal_type_id');
        });
    }

};
