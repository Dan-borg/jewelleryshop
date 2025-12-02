<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetalTypesTable extends Migration
{
    public function up()
    {
        Schema::create('metal_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('purity')->nullable(); // e.g., 18k
            $table->string('color')->nullable(); // e.g., rose, yellow
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metal_types');
    }
}
