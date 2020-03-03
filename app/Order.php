<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Order extends Model
    {
        protected $fillable = ['buyer_id', 'sender_id', 'subtotal', 'state', 'uuid'];

        public function priceItems()
        {
            return $this->belongsToMany('App\PriceItem', 'orders_items', 'order_id', 'price_item_id')
                ->withPivot('quantity');
        }

        public function buyerUser()
        {
            return $this->belongsTo('App\User', 'buyer_id');
        }

        public function senderUser()
        {
            return $this->belongsTo('App\User', 'sender_id');
        }
    }
