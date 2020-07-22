<?php

namespace App\Imports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
           'product_id'     => $row[0],
           'trx_date'    => date('Y-m-d H:i:s',strtotime($row[1])),
           'trx_price' => $row[2],
        ]);
    }
}
