<?php

    namespace App\Http\Controllers\Owner;

    use App\Http\Requests\ImportPrice;
    use App\Imports\PriceItemsImport;
    use App\Price;
    use App\Http\Controllers\Controller;
    use App\PriceItem;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use Maatwebsite\Excel\Facades\Excel;
    use Yajra\DataTables\DataTables;

    class PricesController extends Controller
    {
        /** Prices landing page
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            return view('datatables.owner.pricestable')->with([
                'ajax' => route('owner.prices.data'),
            ]);
        }

        /** function for Prices js datatable
         * @return mixed
         * @throws \Exception
         */
        public function pricesData()
        {
            return Datatables::of(Price::query()->where('user_id', Auth::user()->id))
                ->editColumn('name', function ($price) {
                    return view('datatables.owner.actions.pricelink', ['price' => $price]);
                })
                ->editColumn('hidden', function ($price) {
                    return $price->hidden == '0' ? 'Видимый' : 'Скрытый';
                })
                ->addColumn('action', function ($price) {
                    return view('datatables.owner.actions.pricesactions', ['price' => $price]);
                })
                ->rawColumns(['name', 'hidden', 'action'])
                ->make(true);
        }

        /** Delete Price
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         * @throws \Exception
         */
        public function destroy(Request $request)
        {
            $priceId = $request->priceId;
            $price = Price::query()->whereKey($priceId)->first();
            $price->delete();
            return response()->json(['message' => 'success'], 200);
        }

        /** Import Price from Excel file
         *
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function import(ImportPrice $request)
        {
            $request->validated();
            $price = Price::create([
                'name' => request()->input('name'),
                'user_id' => Auth::user()->id
            ]);
            Excel::import(new PriceItemsImport($price->id), request()->file('file'));
            return back();
        }


        /** Import landing page
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function importViewPage()
        {
            return view('owner.prices.import');
        }

        /** Price Items datatable view
         *
         * @param Price $price
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function priceItemsTableView(Price $price)
        {
            return view('datatables.owner.priceitemstable')->with([
                'ajax' => route('owner.items.data', $price->id),
            ]);
        }

        /** Ajax data for Price Items datatable
         *
         * @param Price $price
         * @return mixed
         * @throws \Exception
         */
        public function priceItemsData(Price $price)
        {
            return Datatables::of(PriceItem::query()->where('price_id', $price->id))
                ->make(true);
        }

        /** Hides or show Price for other users
         * @param Request $request
         * @return mixed
         */
        public function showOrHidePrice(Request $request)
        {
            $priceId = $request->priceId;
            $price = Price::query()->whereKey($priceId)->first();
            $price->hidden = $price->hidden == '0' ? true : false;
            $price->save();
            return response()->json(['message' => 'success'], 200);
        }
    }
