<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table = "cohort";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function databasefk()
    {
        return $this->hasOne(Database::class, 'id', 'database_id');
    }
}
