<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class authcontroller extends Controller
{
    //



    public function login(Request $request)
    {
        try {
            $rules = [
                'email'=>'required|email',
                'password' => 'required',
            ];
            $validator  = Validator::make($request->all(),$rules);

            if ($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($validator,$code);
            }

            $credentials = $request->only(['email','password']);
            $token = Auth::guard('api')->attempt($credentials);

            if (!$token){
                return response()->json(['msg', 'error']);
            }

            $user = Auth::guard('api')->user();
            $user->token = $token;
            //return token
            return response()->json(['msg', $user]);

        }catch (\Exception $e){
            $this->returnError($e->getCode(),$e->getMessage());
        }
        return $this->returnError("","No Data Found");
}
public function logout(Request $request)
{
    try {
        JWTAuth::invalidate($request->token);
        return response()->json(["msg"=>"sucess"]);
    } catch (JWTException $exception) {
        return response()->json(["msg",'Sorry, user cannot be logged out']);
    }
}
}
