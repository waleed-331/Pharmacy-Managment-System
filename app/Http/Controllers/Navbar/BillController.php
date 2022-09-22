<?php

namespace App\Http\Controllers\Navbar;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Models\BillDrug;
use App\Models\Drug;
use App\Models\DrugOrder;
use App\Models\Order;
use App\Models\Supplier;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        $bill = Bill::query()->where('date', '<=', today())->with('drugs')->paginate(10);
        return $bill;
    }

    public function search(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $bill = Bill::query()->where($request->search,'LIKE', "$request->value")->get();
        return Bill::collection($bill);
    }

    public function sort(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $bill = Bill::query()->orderBy($request->sort, $request->direction)->get();

        return BillResource::collection($bill);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return BillResource
     */
    public function store(Request $request)
    {
        $i = 0;
        $j = 0;
        $totalPrice = 0;

        $drugs = json_decode($request->drug_id, TRUE);
        $quantities = json_decode($request->quantity, TRUE);
        foreach ($drugs as $drug) {


            $drugRecord = Drug::find($drug);
            $totalPrice += $quantities[$j] * $drugRecord->price_for_public;
            $newquantity = $drugRecord->quantity - $quantities[$j];
            if($newquantity<0)
            {
                return "you don't have this quantity of the" ;
            }
            $j++;
            $drugRecord->update(['quantity'=>$newquantity]);
        }

        $bill = Bill::create([
            'date'=> Carbon::now(),
            'total_price'=>$totalPrice
        ]);



        foreach ($drugs as $drug) {


            $bill->drugs()->attach(
                [$drug => ['quantity' => $quantities[$i]]]
            );
            $i++;
        }

        return new BillResource($bill);


    }

    public function monthly_profits($month){

        $monthly_pro=0;
        $i=0;

        $bill_ids = Bill::select('id')->whereMonth('created_at', '=', $month)->get();
        foreach ($bill_ids as $bill_id) {
            $i++;


            $BillRecord = Bill::find($bill_id->id);
            $monthly_pro += $BillRecord->total_price * 0.2 ;

        }

        return $monthly_pro;

    }

    public function avg_monthly_profits($month){

        $monthly_pro=0;
        $i = 0;
        $avg=0;

        $bill_ids = Bill::select('id')->whereMonth('created_at', '=', $month)->get();
        foreach ($bill_ids as $bill_id) {
            $i++;


            $BillRecord = Bill::find($bill_id->id);
            $monthly_pro += $BillRecord->total_price * 0.2 ;

        }
        $avg=$monthly_pro / $i;
        return $avg;

    }

    public function daily_sales()
    {


        $i=0;
        $daily_sales=0;
        $bill_ids = Bill::select('id')->whereDate('date', Carbon::today())->get();

        foreach ($bill_ids as $bill_id) {
            $i++;

            $BillRecord = Bill::find($bill_id->id);
            $daily_sales += $BillRecord->total_price  ;

        }


        return $daily_sales;



    }

    public function sales_per_day(Request $request)
    {


        $i=0;
        $daily_sales=0;
        $bill_ids = Bill::select('id')->whereDate('date','=',  $request->date)->get();



        foreach ($bill_ids as $bill_id) {
            $i++;

            $BillRecord = Bill::find($bill_id->id);
            $daily_sales += $BillRecord->total_price  ;

        }


        return $daily_sales;



    }

    public function monthly_sales($month){

        $monthly_sales=0;
        $i=0;

        $bill_ids = Bill::select('id')->whereMonth('date', '=', $month)->get();
        foreach ($bill_ids as $bill_id) {
            $i++;

            $BillRecord = Bill::find($bill_id->id);
            $monthly_sales += $BillRecord->total_price ;

        }
        return $monthly_sales;

    }

    public function avg_monthly_sales($month){

        $monthly_sales=0;
        $i=0;
        $avg=0;
        $bill_ids = Bill::select('id')->whereMonth('date', '=', $month)->get();
        foreach ($bill_ids as $bill_id) {
            $i++;

            $BillRecord = Bill::find($bill_id->id);
            $monthly_sales += $BillRecord->total_price ;


        }
        $avg=$monthly_sales / $i;
        dd($avg);
        return $avg;

    }

    public function daily_profits()
    {


       $i=0;
       $daily_pro=0;
        $bill_ids = Bill::select('id')->whereDate('created_at', Carbon::today())->get();

            foreach ($bill_ids as $bill_id) {
                $i++;

                $BillRecord = Bill::find($bill_id->id);
                $daily_pro += $BillRecord->total_price * 0.2 ;

            }


        return $daily_pro;



    }

    public function profits_by_day(Request $request)
    {


        $i=0;
        $daily_pro=0;
        $bill_ids = Bill::select('id')->whereDate('date','=',  $request->date)->get();


        foreach ($bill_ids as $bill_id) {
            $i++;

            $BillRecord = Bill::find($bill_id->id);
            $daily_pro += $BillRecord->total_price * 0.2 ;

        }


        return $daily_pro;



    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */


    public function update(Request $request, $id)
    {
          return "sad";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return BillResource
     */
    public function destroy($id)
    {
        $bill=Bill::find($id);
        $bill->delete();
        return new BillResource($bill);
    }

    public function today_bills(Request $request)
    {
        $i=0;

        $bill_ids = Bill::query()->where('date', '=',  $request->date)->with('drugs')->get();

        foreach ($bill_ids as $bill_id) {
            $i++;

            $billRecord = Bill::find($bill_id->id);

        }



        return $bill_ids;
    }
}
