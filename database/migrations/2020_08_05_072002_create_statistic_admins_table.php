<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('employee_id');
            $table->integer('specializ_id');
            $table->integer('first_patient')->default(null);
            $table->integer('recorded_patient')->default(null);
            $table->integer('final_patient')->default(null);
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
        Schema::dropIfExists('statistic_admins');
    }
}
