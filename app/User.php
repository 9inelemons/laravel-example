<?php

    namespace App;

    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class User extends Authenticatable
    {
        use Notifiable, SoftDeletes;
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'email', 'password', 'inn', 'organization', 'phone', 'description', 'uuid'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function prices()
        {
            return $this->hasMany('App\Price');
        }

        public function ownOrders()
        {
            return $this->hasMany('App\Order', 'buyer_id', 'id');
        }

        public function customerOrders()
        {
            return $this->hasMany('App\Order', 'sender_id', 'id');
        }
    }
