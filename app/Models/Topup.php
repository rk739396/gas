<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'topup_id', 'company_id', 'amount', 'user_id', 'retailer_remarks', 'date', 'status', 'approver_id',
        'total_balance', 'topup_remarks', 'transaction_id', 'created_at', 'updated_at'
    ];
}
