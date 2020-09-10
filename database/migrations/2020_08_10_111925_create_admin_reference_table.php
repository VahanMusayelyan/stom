<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_reference', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->integer('class_id');
            $table->integer('specializ_id');
            $table->integer('conversion1_normal')->default(null);
            $table->integer('conversion1_good')->default(null);
            $table->integer('conversion2_normal')->default(null);
            $table->integer('conversion2_good')->default(null);
            $table->integer('conversion3_normal')->default(null);
            $table->integer('conversion3_good')->default(null);
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
        Schema::dropIfExists('admin_reference');
    }
}
