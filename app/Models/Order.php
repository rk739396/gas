<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'retailer_name', 'email', 'phone', 'required_date', 'address', 'detail'
    ];
    
    public function products(){
        return $this->belongsToMany(product::class)->withPivot(['id','quantity']);
    }
}
