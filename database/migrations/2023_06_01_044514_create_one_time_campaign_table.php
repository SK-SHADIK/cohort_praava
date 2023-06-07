<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneTimeCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_time_campaign', function (Blueprint $table) {
            $table->id();
            $table->uuid('campaign_id')->default(Str::uuid());
            $table->string('campaign_name', 255);
            $table->timestamp('active_date_time');
            $table->boolean('status')->default(false);
            $table->boolean('send_email')->default(true);
            $table->text('email_body')->nullable();
            $table->boolean('send_sms')->default(true);
            $table->text('sms_body')->nullable();
            $table->text('file_upload')->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('one_time_campaign');
    }
}
