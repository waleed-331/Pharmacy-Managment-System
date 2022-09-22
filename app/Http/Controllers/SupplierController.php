<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierEditRequest;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $sup = Supplier::all();
        return SupplierResource::collection($sup);
    }

    public function get_loans($id)
    {
            $SuppRecord = Supplier::find($id);
            $loans = $SuppRecord->loans ;

        return $loans;
    }

    public function pay(Request $request,$id)
        {
            $paid=0;
            $sup=Supplier::find($id);

            $newLoan = $sup->loans -$request['paid'];

            if($newLoan<=0)
            {
                return "you have paid enough";
            }
            $sup->update(['loans'=>$newLoan]);

            return new SupplierResource($sup);
        }

    public function store(SupplierRequest $request)
    {
        $request->headers->set('Accept', 'application/json');




        $loans =0;
        $sup =Supplier::create([
            'name' => $request->input('name'),
            'company'=>$request->input('company'),
            'phone_number'=>$request->input('phone_number'),
            'email'=>$request->input('email'),
            'loans'=> $loans,
            ]);


        return new SupplierResource($sup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return SupplierResource
     */
    public function update(SupplierEditRequest $request, $id): SupplierResource
    {
        $request->headers->set('Accept', 'application/json');
        $sup=Supplier::find($id);
        $sup->company = $request['company'];
        $sup->phone_number = $request['phone_number'];
        $sup->email = $request['email'];

        $sup->update();
        return new SupplierResource($sup);
    }

    public function search(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $sup = Supplier::where('name', 'LIKE', "%{$request->name}%")->get();
        return SupplierResource::collection($sup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return SupplierResource
     */
    public function destroy($id)
    {
        $sup=Supplier::find($id);
        $sup->delete();
        return new SupplierResource($sup);
    }

}
