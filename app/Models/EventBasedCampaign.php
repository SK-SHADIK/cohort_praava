<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBasedCampaign extends Model
{
    protected $table = "event_based_campaign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'is_send',
    ];

    public function cohort()
    {
        return $this->hasOne(Cohort::class, 'id', 'cohort_id');
    }
}
