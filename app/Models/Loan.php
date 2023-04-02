<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table="loan";
    protected $fillable = [
        'user_id',
        'loan_amt',
        'loan_duration',
        'annual_interest_rate',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
