<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_amount',
        'installments',
        'token',
        'payment_method_id',
        'entity_type',
        'type',
        'email',
        'identification_type',
        'identification_number',
        'notification_url',
        'created_at',
        'updated_at',
        'status',
    ];

    protected $casts = [
        'payer' => 'json', 
    ];

    protected $dates = ['created_at', 'updated_at'];
}

