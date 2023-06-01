<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeCampaign extends Model
{
    protected $table = "one_time_campaign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
