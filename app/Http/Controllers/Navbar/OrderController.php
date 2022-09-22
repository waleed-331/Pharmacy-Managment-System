<?php

namespace App\Http\Controllers\Navbar;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource as OrderResource;
use App\Models\Drug;
use App\Models\DrugOrder;
use App\Models\Order;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
           $order = Order::query()->where('date', '<=', today())->with('drugs')->paginate(10);
        return $order;
    }

    public function search(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $order = Order::where('supplier_name', 'LIKE', "%{$request->supplier_name}%")->get();

        return OrderResource::collection($order);
    }

    public function sort(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $order = Order::query()->orderBy($request->sort, $request->direction)->get();

        return OrderResource::collection($order);

    }

    public function paid_orders($month)
    {
        $i=0;
        $monthly_paid=0;
        $order_ids = Order::select('id')->whereMonth('date', '=', $month)->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);
            $monthly_paid += $orderRecord->paid;

        }
        return $monthly_paid;
    }

    public function monthly_loans($month)
    {
        $i=0;
        $monthly_loan=0;
        $order_ids = Order::select('id')->whereMonth('date', '=', $month)->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);
            $monthly_loan += $orderRecord->remaining;

        }

        return $monthly_loan;

    }

    public function daily_loans()
    {
        $i=0;
        $daily_loan=0;
        $order_ids = Order::select('id')->where('date', '=', today())->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);
            $daily_loan += $orderRecord->remaining;

        }

        return $daily_loan;

    }

    public function loans_per_day(Request $request)
    {
        $i=0;
        $daily_loan=0;
        $order_ids = Order::select('id')->where('date', '=',  $request->date)->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);
            $daily_loan += $orderRecord->remaining;

        }

        return $daily_loan;

    }

    public function avg_monthly_loans($month){

        $i=0;
        $monthly_loans=0;
        $avg=0;
        $order_ids = Order::whereMonth('date', '=', $month)->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);
            $monthly_loans += $orderRecord->remaining;


        }
        $avg=$monthly_loans / $i;
        return $avg;

    }

    public function store(Request $request): OrderResource
    {

        $i=0;
        $j=0;
        $totalPrice=0;
        $remaining=0;

        $drugs = json_decode($request->drug_id, true);
        $quantities = json_decode($request->quantity, TRUE);


        foreach ($drugs as $drug) {
            $drugRecord = Drug::find($drug);


            $totalPrice += $quantities[$j] * $drugRecord->price_for_public;

            $newquan = $drugRecord->quantity + $quantities[$j];

            $j++;
            $drugRecord->update(['quantity'=>$newquan]);
        }

        $remaining= $totalPrice - $request->input('paid');
        $supp=Supplier::find($request->supplier_id);
        $newLoan = $supp->loans + $remaining;
        $supp->update(['loans'=>$newLoan]);
        $order=Order::create([
            'supplier_id' => $request->input('supplier_id'),
            'supplier_name' => $request->input('supplier_name'),
            'date'=> Carbon::now(),
            'total_price' => $totalPrice,
            'paid'=>$request->input('paid'),
            'remaining'=> $remaining,
        ]);
        $remainings= $totalPrice - $request->input('paid');



        foreach ($drugs as $drug) {


            $order->drugs()->attach(
                [$drug => ['quantity' => $quantities[$i]]]
            );
            $i++;
        }




        return new OrderResource($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return OrderResource
     */
    public function update(Request $request, $id)
    {
        $request->headers->set('Accept', 'application/json');
        $i=0;
        $order=Order::find($id);

        $order->supplier_name = $request['supplier_name'];

        $order->paid =$request['paid'];

        $order->update();
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return OrderResource
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        $order->delete();
        return new OrderResource($order);
    }

    public function today_order(Request $request)
    {
        $i=0;

        $order_ids = Order::where('date', '=',  $request->date)->with('drugs')->get();

        foreach ($order_ids as $order_id) {
            $i++;

            $orderRecord = Order::find($order_id->id);

        }



        return $order_ids;
    }
}
