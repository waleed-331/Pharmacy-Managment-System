<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'c_password'=> 'required|same:password',
            'date_of_birth'=>'required|date',
            'gender'=>'in:Male,Female,Unspecified'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'pharmacy_name'=>$request->pharmacy_name,
            'date_of_birth'=> $request->date_of_birth,
            'name' => $request->name,
            'email' => $request->email,
            'gender'=>$request->gender,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
//        dd($request->toArray());
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function show_profile()
    {
        $user=Auth::user();
            //$user=User::find(1);
        $details=User::where('id',Auth::id())->get();

        return  response()->json($details);
     //       return $details;
    }

    public function edit_profile(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $user=Auth::user();

        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->update();
        return $user;
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
