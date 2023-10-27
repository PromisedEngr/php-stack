<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
       'voucher_name',
       'add_date',
       'expiry_date',
       'description',
       'voucher_point',
       'redemption',
       'fk_country_id',
       'fk_state_id',
       'fk_category_id',
       'fk_sub_category_id',
       'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }

}
