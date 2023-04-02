<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = "campaign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function cohortfk()
    {
        return $this->hasOne(Cohort::class, 'id', 'cohort_id');
    }
    public function cohortfkemailbody()
    {
        return $this->hasOne(Cohort::class, 'id', 'email_body');
    }
}
