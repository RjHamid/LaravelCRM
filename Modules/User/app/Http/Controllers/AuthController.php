<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Sms\Models\Sms;
use Modules\User\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        $User = User::create($request
            ->merge(["password" => Hash::make($request->password)])
            ->toArray());
            if($User){
                $Token = $User->createToken()->plainTextToken;   
            }
        return response()->json($Token);
    }

    public function login_v1(Request $request)
    {
        $User = User::select('id', 'phone', 'password')
            ->where('phone', $request->phone)
            ->first();
        if (!$User) {
            return response()->json('User not found!');  
        } 
            if (!Hash::check($request->password, $User->password)) {
                return response()->json('Password is INCORRECT!');
            } else {
                $Token = $User->createToken($request->phone)->plainTextToken;
            }
            return response()->json(["Token" => $Token]);
        }
            public function login_request(Request $request)
            {
            Sms::where('User_id', $request->User_id)->delete();
            $code = rand(1000, 9999);
            $expiration_time = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');
            $data = Sms::create($request
                ->merge([
                    "code" => $code,
                    "expiration_time" => $expiration_time
                ])
                ->toArray());
            return response()->json(["code" => $data]);
        }
        public function login_v2(Request $request)
        {
            $User = User::select('id', 'phone', 'password')
            ->where('phone', $request->phone)
            ->first();
            $code = Sms::select('phone', 'code', 'expiration_time')
                ->where('phone', $request->phone)
                ->first();
            $now = Carbon::now()->format('Y-m-d H:i:s');
            if ($now <= $code['expiration_time']) {
                if ($code['code'] == $request->code) {
                    $Token = $User->createToken($request->phone)->plainTextToken;
                    Sms::where('code', $request->code)->delete();

                    return response()->json(["Token" => $Token]);
                } else {
                    return response()->json('Code or phone is INCORRECT');
                }
            } else {
                return response()->json('The code is EXPIRED!');
            }
        }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('User loggedout seccessfully!');
    }
}
