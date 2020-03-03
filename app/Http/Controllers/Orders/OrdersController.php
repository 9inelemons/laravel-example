<?php

    namespace App\Http\Controllers\Orders;

    use App\Order;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Yajra\DataTables\DataTables;

    class OrdersController extends Controller
    {
        /** Orders landing page
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            return view('datatables.order.orderstable', [
                'ajax' => route('orders.ordersData')
            ]);
        }

        /** loads data for Orders js datatable
         *
         * @param Request $request
         * @return mixed
         * @throws \Exception
         */
        public function ordersData(Request $request)
        {
            return Datatables::of(Order::where('buyer_id', '=', Auth::user()->id)->get())
                ->editColumn('id', function ($order) {
                    return view('datatables.order.actions.orderlink', ['order' => $order]);
                })
                ->editColumn('state', function ($order) {
                    switch ($order->state) {
                        case 'received':
                            return 'Получен';
                        case 'completed':
                            return 'Выполнен';
                    }
                })
                ->editColumn('sender', function ($order) {
                    return $order->senderUser()->first()->organization;
                })
                ->rawColumns(['id', 'state', 'sender'])
                ->make(true);
        }

        /** return view of table for order items
         *
         * @param int $orderId
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function itemsView(int $orderId)
        {
            return view('datatables.order.orderitemstable', [
                'ajax' => route('orders.itemsData', $orderId)
            ]);
        }

        /** returns data of items in order for js datatable
         *
         * @param int $orderId
         * @return mixed
         * @throws \Exception
         */
        public function itemsData(int $orderId)
        {
            return DataTables::of(Order::find($orderId)->priceItems()->get())
                ->editColumn('quantity', function ($item) {
                    return $item->pivot->quantity;
                })
                ->rawColumns(['quantity'])
                ->make(true);
        }
    }
