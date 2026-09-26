<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory;

    protected $table ='orders';

    protected $fillable = [
        'po_no',
        'cust_name',
        'cust_email',
        'po_date',
        'total_amount',
        'payment_status',
    ];
}
