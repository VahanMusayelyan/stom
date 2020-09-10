<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id');
            $table->integer('ownership_type_id');
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->integer('org_class_id');
            $table->integer('org_active')->default(0);
            $table->integer('profile_data')->default(null);
            $table->text('organization_data1')->default(null);
            $table->text('organization_data2')->default(null);
            $table->text('organization_data3')->default(null);
            $table->text('organization_data4')->default(null);
            $table->text('organization_data5')->default(null);
            $table->text('organization_data6')->default(null);
            $table->text('organization_data7')->default(null);
            $table->text('organization_data8')->default(null);
            $table->text('organization_data9')->default(null);
            $table->text('organization_data10')->default(null);
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->default(null);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
