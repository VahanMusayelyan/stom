<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_reference', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->integer('class_id');
            $table->integer('specializ_id');
            $table->integer('conversion_normal')->default(null);
            $table->integer('conversion_good')->default(null);
            $table->integer('repetition_rate_normal')->default(null);
            $table->integer('repetition_rate_good')->default(null);
            $table->integer('turnover_normal')->default(null);
            $table->integer('turnover_good')->default(null);
            $table->integer('workload_normal')->default(null);
            $table->integer('workload_good')->default(null);
            $table->integer('avarage_hour_normal')->default(null);
            $table->integer('avarage_hour_good')->default(null);
            $table->integer('avarage_visit_normal')->default(null);
            $table->integer('avarage_visit_good')->default(null);
            $table->integer('avarage_visit_normal')->default(null);
            $table->integer('avarage_visit_good')->default(null);
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
        Schema::dropIfExists('doctor_reference');
    }
}
