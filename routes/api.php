<?php



//use App\Http\Controllers\Navbar\DrugController;
use App\Http\Controllers\Navbar\DrugController;
//use App\Http\Controllers\Navbar\OrderContoller;
//use App\Http\Controllers\Navbar\BillContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/show_profile',[\App\Http\Controllers\API\AuthController::class,'show_profile']);
    Route::post('/edit_profile',[\App\Http\Controllers\API\AuthController::class,'edit_profile']);
    //************************* DRUGS *************************//
    Route::resource('drugs', '\App\Http\Controllers\Navbar\DrugController');// this route contains the index,store,update,delete for the storage
    Route::get('/expired',[\App\Http\Controllers\navbar\DrugController::class,'expired']); // this route contains the drugs that had expired
    Route::post('/out_of_stock',[\App\Http\Controllers\navbar\DrugController::class,'out_of_stock']); //
    Route::post('/expired_by_day',[\App\Http\Controllers\navbar\DrugController::class,'expired_by_day']); //
    Route::get('/near_expiry',[\App\Http\Controllers\navbar\DrugController::class,'near_expiry']); // this route contains the drugs that has ex_date les that 3 months (near expiry)
    Route::get('/search_drug',[\App\Http\Controllers\navbar\DrugController::class,'search']); //this route can search for a drug name
    Route::get('/body_system_search',[\App\Http\Controllers\navbar\DrugController::class,'body_system_search']); //this route for the body system search
    Route::get('/sort_drug',[\App\Http\Controllers\navbar\DrugController::class,'sort']); // this route can sort the drugs by whatever the front want
    //************************* LOANS *************************//
    Route::get('/loans/{id}',[\App\Http\Controllers\SupplierController::class,'get_loans']); //this route return the loans for any supplier by the supplier id
    Route::get('/daily_loans',[\App\Http\Controllers\navbar\OrderController::class,'daily_loans']); // this route return TODAY'S loans
    Route::post('/loans_per_day',[\App\Http\Controllers\navbar\OrderController::class,'loans_per_day']); // this route return TODAY'S loans
    Route::get('/monthly_loans/{month}',[\App\Http\Controllers\navbar\OrderController::class,'monthly_loans']); // this route return the given month average loans
    Route::get('/avg_monthly_loans/{month}',[\App\Http\Controllers\navbar\OrderController::class,'avg_monthly_loans']); // this route return the given month average loans
    //************************* PROFITS *************************//
    Route::get('/daily_profits',[\App\Http\Controllers\Navbar\BillController::class,'daily_profits']); // this route returns TODAY'S profits
    Route::post('/profits_by_day',[\App\Http\Controllers\Navbar\BillController::class,'profits_by_day']); // this route returns TODAY'S profits
    Route::get('/monthly_profits/{month}',[\App\Http\Controllers\Navbar\BillController::class,'monthly_profits']); // this route return the given month profits
    Route::get('/avg_monthly_profits/{month}',[\App\Http\Controllers\Navbar\BillController::class,'avg_monthly_profits']); //this route return the given month average profitsRoute::get('/daily_sales',[\App\Http\Controllers\Navbar\BillController::class,'daily_sales']); // this route return TODAY'S sales
    //************************* SALES *************************//
    Route::get('/daily_sales',[\App\Http\Controllers\Navbar\BillController::class,'daily_sales']); // this route return TODAY'S sales
    Route::post('/sales_per_day',[\App\Http\Controllers\Navbar\BillController::class,'sales_per_day']); // this route return TODAY'S sales
    Route::get('/monthly_sales/{month}',[\App\Http\Controllers\Navbar\BillController::class,'monthly_sales']); //this route return the given month sales
    Route::get('/avg_monthly_sales/{month}',[\App\Http\Controllers\Navbar\BillController::class,'avg_monthly_sales']); //this route return the given month average sales
    //************************* SUPPLIERS *************************//
    Route::resource('suppliers', '\App\Http\Controllers\SupplierController'); // this route contains the index,store,update,delete for the supplier
    Route::get('/search_supplier_name',[\App\Http\Controllers\SupplierController::class,'search']); //this route can search for the supplier name
    Route::put('/paid/{id}',[\App\Http\Controllers\SupplierController::class,'pay']); // this route can pay the loans to the supplier by the supplier id
    //************************* ORDERS *************************//
    Route::resource('orders', '\App\Http\Controllers\Navbar\OrderController');// this route contains the index,store,delete for the orders
    Route::post('/today_order',[\App\Http\Controllers\navbar\OrderController::class,'today_order']);
    Route::get('/searchOrder',[\App\Http\Controllers\navbar\OrderController::class,'search']); // this route can search for the supplier name orders
    Route::get('/sortOrder',[\App\Http\Controllers\navbar\OrderController::class,'sort']); // this route can sort thr orders by whatever the front wants
    Route::get('/paid_orders/{month}',[\App\Http\Controllers\navbar\OrderController::class,'paid_orders']); // this route return the given month the paid amount of the orders
    //************************* BILLS *************************//
    Route::resource('bills', '\App\Http\Controllers\Navbar\BillController');// this route contains the index,store,delete for the bills
    Route::post('/today_bills',[\App\Http\Controllers\navbar\BillController::class,'today_bills']);
    Route::get('/searchBill',[\App\Http\Controllers\navbar\BillController::class,'search']); //this route can search for the whatever the front want
    Route::get('/sortBill',[\App\Http\Controllers\navbar\BillController::class,'sort']); //this route can sort for whatever the front want
});
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




