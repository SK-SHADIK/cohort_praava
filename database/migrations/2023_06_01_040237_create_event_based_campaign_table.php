<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBasedCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_based_campaign', function (Blueprint $table) {
            $table->id();
            $table->uuid('campaign_id')->default(Str::uuid());
            $table->string('campaign_name', 255);
            $table->timestamp('campaign_date');
            $table->unsignedBigInteger('cohort_id');
            $table->text('email_body')->nullable();
            $table->text('sms_body')->nullable();
            $table->boolean('is_send')->default(false);
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));
            

            $table->foreign('cohort_id')->references('id')->on('cohort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_based_campaign');
    }
}
