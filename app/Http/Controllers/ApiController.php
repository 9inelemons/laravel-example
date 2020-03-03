<?php

    namespace App\Http\Controllers;

    use App\Order;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\User;


    class ApiController extends Controller
    {

        /** Send XML with NOT completed orders by accepted user's GUID
         *
         * @param Request $request
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
         */
        public function getOrdersData(Request $request)
        {
            if ($request->exists('userGuid')) {
                $userGuid = $request->userGuid;
            } else {
                return response(view('api.error1'))
                    ->header('Content-Type', 'application/xml');
            }
            $user = User::whereUuid($userGuid)
                ->first();
            if ($user) {
                $orders = $user->ownOrders()->where('state', '!=', 'completed')->get();
                if ($orders->isEmpty()) {
                    return response(view('api.error')->withUser($user))
                        ->header('Content-Type', 'application/xml');
                } else {
                    return response(view('api.orders', ['orders' => $orders]))
                        ->header('Content-Type', 'application/xml');
                }
            } else {
                return response(view('api.error2'))
                    ->header('Content-Type', 'application/xml');
            }
        }

        /** Set to requested orders 'state=completed'
         *
         * @param Request $request
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
         */
        public function sendOrdersData(Request $request)
        {
            $ordersGuid = $request->ordersGuid;
            $ordersGuid = explode(", ", $ordersGuid);
            Order::whereIn('uuid', $ordersGuid)
                ->chunk(count($ordersGuid), function ($orders) {
                    foreach ($orders as $order) {
                        $state = 'completed';
                        $order->state = $state;
                        $order->save();
                    }
                });
            return response(view('api.successsend'))
                ->header('Content-Type', 'application/xml');
        }
    }
