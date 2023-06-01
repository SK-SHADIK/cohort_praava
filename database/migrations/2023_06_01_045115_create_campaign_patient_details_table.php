<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_patient_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('one_time_campaign_id');
            $table->string('email', 255)->nullable();
            $table->string('mobileno', 255)->nullable();
            $table->string('patientname', 255)->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('one_time_campaign_id')->references('id')->on('one_time_campaign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_patient_details');
    }
}
