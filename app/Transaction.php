<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// From Maatwebsite
use Maatwebsite\Excel\Concerns\ToModel;

class Transaction extends Model
{
    protected $fillable = [
        'product_id', 'trx_date', 'trx_price',
    ];
}
