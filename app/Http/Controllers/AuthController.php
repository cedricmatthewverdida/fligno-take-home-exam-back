<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Helpers\APIHelper;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthController extends Controller
{

    use RefreshDatabase;
    public function alluser(){
        $users = User::all();
        $response = APIHelper::APIResponse(false,200,'',$users);
        return response()->json($response,200);
    }

    public function register(Request $request){
        try{
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role')
            ]);

            return response()->json("Success", 200);
        }catch(Exception $e){
            return response()->json("Failed",404);
        }
    }

    public function destroy($id)
    {
        $category = User::find($id);
        $deleteCategory = $category->delete();

        if($deleteCategory){
            $response = APIHelper::APIResponse(false,200,'Success',null);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(true,'Failed',null);
            return response()->json($response,400);
        }
    }

    public function login (Request $request){

        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid Credential'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('token' , $token , 60 * 24);

        return response ([
            'user' => $user,
            'token' => $token,
        ])->withCookie($cookie);

    }

    public function user(){
        return response ([
            'auth' => Auth::user()
        ]);
    }


    public function logout(){
        $cookie = Cookie::forget('token');
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
