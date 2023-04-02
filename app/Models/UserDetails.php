<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $table="user_details";
    protected $fillable = [
        'user_id',
        'address',
        'address_proof',
        'photo',
        'annual_salary',
        'job_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
