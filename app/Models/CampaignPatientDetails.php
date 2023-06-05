<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignPatientDetails extends Model
{
    protected $table = "campaign_patient_details";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function capmaign()
    {
        return $this->hasOne(OneTimeCampaign::class, 'id', 'one_time_campaign_id');
    }
}
