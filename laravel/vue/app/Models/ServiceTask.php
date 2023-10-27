<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTask extends Model
{
    use HasFactory;

     protected $fillable = [
        'category_service_id',
        'task_name',
        'description',
        'expected_date',
        'description',
        'address',
        'customer_country_id',
        'customer_state_id',
        'city',
        'zipcode',
        'admin_approve',
        'customer_id',
        'created_at',
    ];
}
