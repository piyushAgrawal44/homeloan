<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRemarks extends Model
{
    use HasFactory;
    protected $table="loan_remarks";
    protected $fillable = [
        'loan_id',
        'status',
        'remark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
