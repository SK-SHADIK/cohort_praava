<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeCampaign extends Model
{
    protected $table = "one_time_campaign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'campaign_id',
        'campaign_name',
        'active_date_time',
        'status',
        'send_email',
        'email_body',
        'send_sms',
        'sms_body',
        'is_send',
        'file_upload',
    ];

}
