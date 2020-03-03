<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceItem extends Model
{
    use SoftDeletes;
    protected $fillable = ['code', 'name', 'measure', 'price', 'price_id', 'uuid'];
    public function price() {
        return $this->belongsTo(Price::class, 'price_id');
    }
}
