<?php

namespace App\Http\Controllers\Navbar;

use App\Http\Controllers\Controller;
use App\Http\Requests\DrugEditRequest;
use App\Http\Requests\DrugRequest;
use App\Http\Resources\DrugNewResource;
use App\Models\Drug;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class DrugController extends Controller
{

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $drug = Drug::query()->where('expiration_date', '>=', today())->get();
        return DrugNewResource::collection($drug);
    }

    public function expired(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $drug = Drug::query()->where('expiration_date', '<=', today())->paginate(10);
        return DrugNewResource::collection($drug);
    }

    public function out_of_stock(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $drug = Drug::query()->where('quantity', 0)->wheredate('updated_at', $request->date)->get();
        return DrugNewResource::collection($drug);
    }

    public function expired_by_day(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $drug = Drug::query()->wheredate('expiration_date', $request->date)->get();
        return DrugNewResource::collection($drug);
    }

    public function near_expiry()
    {
        $near = Drug::where('expiration_date','<=',Carbon::today()->addMonths(3))->get();
        return $near;
    }

    public function store(DrugRequest $request): DrugNewResource
    {
        $request->headers->set('Accept', 'application/json');
        $drug = Drug::create([
            'name' => $request->input('name'),
            'expiration_date' => $request->input('expiration_date'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'price_for_public' => $request->input('price_for_public'),
            'dose' => $request->input('dose'),
            'form' => $request->input('form'),
            'place'=>$request->input('place'),
            'company' => $request->input('company'),
            'prescription'=>$request->input('prescription'),
            'scientific_name' => $request->input('scientific_name'),
            'body_system' => $request->input('body_system')]);
        return new DrugNewResource($drug);
    }

    public function search(Request $request)
    {
        $drug = Drug::where('name', 'LIKE', "%{$request->name}%")->get();
        return DrugNewResource::collection($drug);
    }

    public function sort(Request $request)
    {
        $request->headers->set('Accept', 'application/json');
        //$drug = Drug::query()->orderBy($request->sort , $request->direction)->get();
        $drug = Drug::query()->orderBy($request->sort , $request->direction)->get();
        return DrugNewResource::collection($drug);
    }

    public function body_system_search(Request $request)
    {
        $drug = Drug::where('body_system', 'LIKE', $request->body_system)->get();
        return $drug;
    }

    public function update(DrugEditRequest $request,$id): DrugNewResource
    {
        $request->headers->set('Accept', 'application/json');
        $drug=Drug::find($id);
        $drug->quantity = $request['quantity'];
        $drug->price = $request['price'];
        $drug->price_for_public = $request['price_for_public'];
        $drug->place = $request['place'];
        if( $request['quantity']<=0)
        {
            $this->destroy($id);
        }
        $drug->update();
        return new DrugNewResource($drug);
    }

    public function destroy($id): DrugNewResource
    {
        $drug=Drug::find($id);
        $drug->delete();
        return new DrugNewResource($drug);
    }
}
