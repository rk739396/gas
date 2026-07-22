<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccessRequest extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'status',
        'approved_by'
    ];
    use HasFactory;
}
