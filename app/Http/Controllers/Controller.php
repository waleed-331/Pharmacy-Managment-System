<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use App\Http\Resources\DrugResource as DrugstoreResource;
use App\Models\Drug;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
