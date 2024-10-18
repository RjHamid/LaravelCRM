<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Modules\Email\Models\Email;
use Modules\Sms\Models\Sms;
use Modules\User\Http\Requests\codeRequest;
use Modules\User\Http\Requests\loginRequest;
use Modules\User\Models\User;
use Modules\User\Transformers\UserResource;

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
        $existingUser = User::where('name', $request->name)->first();  
    
        if ($existingUser) {  
            return response()->json(['error' => 'User with this name already exists'], 409);  
        }  
    
        $User = User::create($request  
            ->merge(["password" => Hash::make($request->password)])  
            ->toArray());  
    
        if($User) {  
            $Token = $User->createToken('login')->plainTextToken; // 'YourAppName' نام توکن است  
        } else {  
            return response()->json(['error' => 'Registration failed'], 400);  
        }  
    
        return response()->json(['token' => $Token]);  
    }

    public function login_v1(Request $request)
    {
        $User = User::select('id', 'phone','email', 'password')
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
            Sms::where('phone', $request->phone)->delete();
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
        public function email_request(Request $request){

        Email::where('email',$request->email)->delete();
           
            $code = rand(1000, 9999);

            $expiration_time = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');

            FacadesMail::to($request->email)->send(new Mail($code));

            $data =Email::create($request
            ->merge([
                'email' => $request->email,  
                "code" => $code,
                "expiration_time" => $expiration_time
            ])
            ->toArray());

            return response()->json(["code" => $data]);
        }
        public function login_code(Request $request)
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
        public function email_code(Request $request)
        {
            $User = User::select('id', 'email', 'password')
            ->where('email', $request->email)
            ->first();
            $code = Email::select('email', 'code', 'expiration_time')
                ->where('email', $request->email)
                ->first();
            $now = Carbon::now()->format('Y-m-d H:i:s');
            if ($now <= $code['expiration_time']) {
                if ($code['code'] == $request->code) {
                    $Token = $User->createToken($request->email)->plainTextToken;
                    Sms::where('code', $request->code)->delete();

                    return response()->json(["Token" => $Token]);
                } else {
                    return response()->json('Code or email is INCORRECT');
                }
            } else {
                return response()->json('The code is EXPIRED!');
            }
        }
        public function login_v2(Request $request)
        {
            $User = User::select('id', 'name', 'phone', 'email', 'password') 
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
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('User loggedout seccessfully!');
    }
    public function code(codeRequest $request){
        if ($request->phone) {  
                
            Sms::where('phone', $request->phone)->delete();  
            
            
            $password_phone = rand(1000, 9999);  
            $expiration_time = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');  
            
            
            $data_phone = Sms::create([  
                'phone' => $request->phone,  
                'code' => $password_phone,  
                'expiration_time' => $expiration_time  
            ]);  
            
             
            return response()->json(["code" => $data_phone->code, "message" => "کد به شماره تلفن ارسال شد."]);  
        }  
    
        
        if ($request->email) {  
           
            Email::where('email', $request->email)->delete();  
            
             
            $code = rand(1000, 9999);  
            $expiration_time = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');  
            
            
            FacadesMail::to($request->email)->send(new Mail($code));  
            
            
            $data_email = Email::create([  
                'email' => $request->email,  
                'code' => $code,  
                'expiration_time' => $expiration_time  
            ]);  
            
           
            return response()->json(["code" => $data_email->code, "message" => "کد به ایمیل ارسال شد."]);  
        }  
    
       
        return response()->json(["message" => "لطفاً شماره تلفن یا ایمیل را وارد کنید."], 400);  
    } 
    public function login(loginRequest $request) {  
       
        if ($request->name) {  
            $user = User::select('id', 'name', 'password')  
                ->where('name', $request->name)  
                ->first();  
    
            
            if (!$user) {  
                return response()->json('User not found!');  
            }   
    
            
            if (!Hash::check($request->password, $user->password)) {  
                return response()->json('Password is INCORRECT!');  
            }  
    
             
            $token = $user->createToken($user->name)->plainTextToken; 
            return response()->json([  
                'token' => $token,  
                'user' => new UserResource($user) 
            ]);    
        }  
    
        
        if ($request->phone) {  
            $user = User::select('id', 'phone', 'password')  
                ->where('phone', $request->phone)  
                ->first();  
    
            if (!$user) {  
                return response()->json('User not found!');  
            }  
    
            if($request->has('password')){

            if (!Hash::check($request->password, $user->password)) {  
                return response()->json('Password is INCORRECT!');  
            }  
    
            
            $token = $user->createToken($user->phone)->plainTextToken;
            return response()->json([  
                'token' => $token,  
                'user' => new UserResource($user)   
            ]); 
        }
        $code = Sms::select('phone', 'code', 'expiration_time')  
        ->where('phone', $request->phone)  
        ->first();  

    $now = Carbon::now()->format('Y-m-d H:i:s');  

    
    if ($now <= $code['expiration_time']) {  
        
        if ($code['code'] == $request->code) {  
            
            $token = $user->createToken($request->phone)->plainTextToken;  
            Sms::where('code', $request->code)->delete();  

            return response()->json(["Token" => $token]);  
        } else {  
            return response()->json('Code or phone is INCORRECT', 401);  
        }  
    } else {  
        return response()->json('The code is EXPIRED!', 400);  
    } 
        
    }
    
        
        if ($request->email) {  
            $user = User::select('id', 'email', 'password')  
            ->where('email', $request->email)  
            ->first();  
    
        
        if (!$user) {  
            return response()->json('User not found!', 404);  
        }  
    
         
        if ($request->has('password')) {  
           
            if (!Hash::check($request->password, $user->password)) {  
                return response()->json('Password is INCORRECT!', 401);  
            }  
    
            
            $token = $user->createToken($user->email)->plainTextToken;  
            return response()->json([  
                'token' => $token,  
                'user' => new UserResource($user)  
            ]);
        }  
    
        
        $code = Email::select('email', 'code', 'expiration_time')  
            ->where('email', $request->email)  
            ->first();  
    
        $now = Carbon::now()->format('Y-m-d H:i:s');  
    
        
        if ($now <= $code['expiration_time']) {  
            
            if ($code['code'] == $request->code) {  
                
                $token = $user->createToken($request->email)->plainTextToken;  
                Sms::where('code', $request->code)->delete();  
    
                return response()->json(["Token" => $token]);  
            } else {  
                return response()->json('Code or email is INCORRECT', 401);  
            }  
        } else {  
            return response()->json('The code is EXPIRED!', 400);  
        }  
        
    }
    
}
    
}
