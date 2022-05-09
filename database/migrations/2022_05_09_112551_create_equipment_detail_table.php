<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_detail', function (Blueprint $table) {
            $table->id();
            $table->string("equipment_header_code");
            $table->string("component_number");
            $table->string("material_description");
            $table->string("component_quantity");
            $table->string("unit");
            $table->string("storage");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_detail');
    }
};
