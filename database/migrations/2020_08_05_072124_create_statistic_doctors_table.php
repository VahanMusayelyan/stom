<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_doctors', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('employee_id');
            $table->integer('specializ_id');
            $table->integer('first_consulting')->default(null);
            $table->integer('first_therapy')->default(null);
            $table->integer('total_therapy')->default(null);
            $table->float('schedule_time')->default(null);
            $table->float('spent_time')->default(null);
            $table->float('turnover')->default(null);
            $table->integer('clients')->default(null);
           $table->date('date')->default(null);
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
        Schema::dropIfExists('statistic_doctors');
    }
}
