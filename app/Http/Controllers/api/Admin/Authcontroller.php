<?php

namespace App\Http\Controllers\api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller
{

    use GeneralTrait;
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
//                'c_password' => 'required|same:password',
            ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }


        $Admin = new Admin();
        $Admin->name = $request->name;
        $Admin->email = $request->email;
        $Admin->password = bcrypt($request->password);
        $Admin->save();


        return $this->returnSuccessMessage('register  successfully');

    }

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function logout(Request $request)
    {
        $token = $request -> header('api-token');
        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        }else{
            $this -> returnError('','some thing went wrongs');
        }

    }
    public function profile()
    {
        return response()->json(auth()->user());
    }

}
/*
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hZG1pblwvbG9naW4iLCJpYXQiOjE2MjIwNDMwNDIsImV4cCI6MTYyMjA0NjY0MiwibmJmIjoxNjIyMDQzMDQyLCJqdGkiOiIwQlljdlZvbExadUdwc1JqIiwic3ViIjoxLCJwcnYiOiJkZjg4M2RiOTdiZDA1ZWY4ZmY4NTA4MmQ2ODZjNDVlODMyZTU5M2E5In0.wgBIeEZw8-UqrIy2fK8PILIEwdpcnFiRyU9QzyfQzLM
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hZG1pblwvbG9naW4iLCJpYXQiOjE2MjIwNDMwNzgsImV4cCI6MTYyMjA0NjY3OCwibmJmIjoxNjIyMDQzMDc4LCJqdGkiOiJPcVpjR0Q3enQwaTQ2enZGIiwic3ViIjoyLCJwcnYiOiJkZjg4M2RiOTdiZDA1ZWY4ZmY4NTA4MmQ2ODZjNDVlODMyZTU5M2E5In0.T-hr0mZmSu32p9ivnIWX0ITBBBhvDXex3pPVfShC7H8
*/

