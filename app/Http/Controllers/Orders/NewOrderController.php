<?php

    namespace App\Http\Controllers\Orders;

    use App\Order;
    use App\Price;
    use App\PriceItem;
    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;
    use Yajra\DataTables\DataTables;

    class NewOrderController extends Controller
    {
        /** New order landing page controller
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            return view('datatables.neworder.organizationstable')->with([
                'ajax' => route('orders.new.orgData')
            ]);
        }

        /** function for organizations data in js datatable (/js/datatables.js)
         *
         * @return mixed
         * @throws \Exception
         */
        public function organizationsData()
        {
            return DataTables::of(User::query())
                ->editColumn('organization', function ($organization) {
                    return view('datatables.neworder.actions.organizationlink', ['organization' => $organization]);
                })
                ->rawColumns(['organization'])
                ->make(true);
        }

        /** Function for prices datatable view
         *
         * @param User $user
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function pricesView(User $user)
        {
            return view('datatables.neworder.pricestable')->with([
                'ajax' => route('orders.new.pricesData', $user->id),
            ]);
        }

        /** function for prices data for chosen organization in js datatable (/js/datatables.js)
         *
         * @param Request $request
         * @param User $user
         * @return mixed
         * @throws \Exception
         */
        public function pricesData(Request $request, User $user)
        {
            $session = $request->session();
            $session->put(['organization' => $user->id]);
            return DataTables::of(Price::query()->where('user_id', '=', $user->id)->where('hidden', '=', '0'))
                ->editColumn('name', function ($price) {
                    return view('datatables.neworder.actions.pricelink', ['price' => $price]);
                })
                ->rawColumns(['name'])
                ->make(true);
        }

        /** return view for Price Items datatable for chosen Price
         *
         * @param Price $price
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function itemsView(Price $price, Request $request)
        {
            $session = $request->session();
            $organization_id = $session->get('organization');
            $organization = User::find($organization_id);
            return view('datatables.neworder.priceitemstable')->with([
                'ajax' => route('orders.new.itemsData', $price->id),
                'price' => $price,
                'organization' => $organization
            ]);
        }

        /**
         * @param Price $price
         * @param Request $request
         * @return mixed
         * @throws \Exception
         */
        public function itemsData(Price $price, Request $request)
        {
            $i=0;
            $session = $request->session();
            $session->put(['price' => $price->id]);
            return DataTables::of(PriceItem::query()->where('price_id', '=', $price->id))
                ->addColumn('action', function ($priceItem) use ($i, $request) {
                    $counter[$priceItem->id] = $i;
                    $i++;
                    $session = $request->session();
                    $cartData = ($session->get('cart')) ? $session->get('cart') : array();
                    if (array_key_exists($priceItem->id, $cartData)) {
                        $quantity = $cartData[$priceItem->id]['quantity'];
                    } else $quantity = null;
                    return view('datatables.neworder.actions.orderform', ['id' => $priceItem->id, 'quantity' => $quantity, 'counter' => $counter[$priceItem->id]]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        /** Add to cart functions (calls from /js/cart.js)
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function addToCart(Request $request)
        {
            $priceItemId = $request->priceItemId;
            $session = $request->session();
            $quantity = $request->quantity;
            $priceItem = PriceItem::query()->whereKey($priceItemId)->first();
            $cartData = ($session->get('cart')) ? $session->get('cart') : array();
            if ($quantity == 0) {
                $this->checkoutDeleteItem($request);
                return response()->json(['message' => 'error'], 200);
            } else {
                if (array_key_exists($priceItemId, $cartData)) {
                    $cartData[$priceItemId]['quantity'] = $quantity;
                } else {
                    $cartData[$priceItemId]['quantity'] = $quantity;
                }
                $cartData[$priceItemId]['price'] = $priceItem->price;
                $request->session()->put('cart', $cartData);
                return response()->json(['message' => 'success'], 200);
            }
        }

        /** Returns view for checkout view
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function checkoutView(Request $request)
        {
            $session = $request->session();
            $organization_id = $session->get('organization');
            $organization = User::find($organization_id);
            $price_id = $session->get('price');
            $price = Price::find($price_id);
            return view('datatables.neworder.checkouttable', [
                'ajax' => route('orders.new.checkoutData'),
                'organization' => $organization,
                'price' => $price
            ]);
        }

        /** takes cart data from session and returns data to js datatable
         *
         * @param Request $request
         * @return mixed
         * @throws \Exception
         */
        public function checkoutData(Request $request)
        {
            $session = $request->session();
            $cartData = ($session->get('cart')) ? $session->get('cart') : array();
            $priceItemIds = array_keys($cartData);
            $priceItemQuantities = array_values($cartData);
            return Datatables::of(PriceItem::query()->whereIn('id', $priceItemIds))
                ->addColumn('quantity', function ($priceItem) use ($priceItemQuantities, $priceItemIds) {
                    $i = 0;
                    foreach ($priceItemIds as $key) {
                        if ($key == $priceItem->id) {
                            return $priceItemQuantities[$i]['quantity'];
                        }
                        $i++;
                    };
                })
                ->addColumn('action', function ($priceItem) {
                    return view('datatables.neworder.actions.cartform', ['id' => $priceItem->id]);
                })
                ->make(true);
        }

        /** function for deleting item from cart
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function checkoutDeleteItem(Request $request)
        {
            $session = $request->session();
            $cartData = ($session->get('cart')) ? $session->get('cart') : array();
            $priceItemId = $request->priceItemId;
            unset($cartData[$priceItemId]);
            $request->session()->put('cart', $cartData);
            return response()->json(['message' => 'success'], 200);
        }

        /** adds current cartData to Database
         *
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function checkoutConfirmOrder(Request $request)
        {
            $session = $request->session();
            $cartData = ($session->get('cart')) ? $session->get('cart') : array();
            $sender_id = $session->get('organization');
            $subTotal = $session->get('subTotal');
            $order = Order::create([
                'sender_id' => strval($sender_id),
                'buyer_id' => auth()->user()->id,
                'subtotal' => $subTotal,
                'state' => 'received',
                'uuid' => Str::uuid()
            ]);
            foreach ($cartData as $item => $values) {
                unset($cartData[$item]['price']);
            }
            $order->priceItems()->attach($cartData);
            $session->remove('cart');
            $session->remove('subtotal');
            return redirect()->route('orders.index');
        }

        /** Function for current order subtotal (ajax)
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function subTotalData(Request $request)
        {
            $session = $request->session();
            $cartData = $session->get('cart');
            $subTotal = 0;
            if (empty($cartData)) {
                return response()->json(['message' => 'success', 'subTotal' => $subTotal], 200);
            }
            foreach ($cartData as $priceItem) {
                $subTotal += $priceItem['price'] * $priceItem['quantity'];
            }
            $request->session()->put('subTotal', $subTotal);
            return response()->json(['message' => 'success', 'subTotal' => $subTotal], 200);
        }
    }
