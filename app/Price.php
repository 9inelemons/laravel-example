<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'hidden'];

    public function user() {
        return $this->belongsTo('App/User', 'user_id');
    }

    public function priceItems() {
        return $this->hasMany(PriceItem::class);
    }
}
