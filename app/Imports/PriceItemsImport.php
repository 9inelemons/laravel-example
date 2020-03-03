<?php

namespace App\Imports;

use App\PriceItem;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PriceItemsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $_price_id;

    public function __construct($price_id=null)
    {
        $this->_price_id = $price_id;

    }

    public function model(array $row)
    {
        return new PriceItem([
            'code' => $row['artikul'],
            'name' => $row['naimenovanie'],
            'measure' => $row['ed_izm'],
            'price' => $row['tsena'],
            'price_id' => $this->_price_id,
            'uuid' => Str::uuid(),
        ]);
    }
}
