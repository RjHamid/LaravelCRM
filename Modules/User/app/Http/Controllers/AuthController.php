<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Modules\User\Emails\SendEmail;

;
use Modules\User\Http\Requests\codeRequest;
use Modules\User\Http\Requests\loginRequest;
use Modules\User\Models\Email;
use Modules\User\Models\Sms;
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
            $Token = $User->createToken('login')->plainTextToken; 
        } else {  
            return response()->json(['error' => 'Registration failed'], 400);  
        }  
    
        return response()->json([  
            'token' => $Token,  
            'user' => new UserResource($User)  
        ]); 
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('User loggedout seccessfully!');
    }
    public function verify_code(codeRequest $request){
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
            
            
            FacadesMail::to($request->email)->send(new SendEmail($code));  
            
            
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
       
     $user = User::select('id', 'name', 'email', 'phone', 'password')  
 ->where('name', $request->identifier)  
 ->orWhere('email', $request->identifier)  
 ->orWhere('phone', $request->identifier)  
 ->first();  

if (!$user) {  
 return response()->json('User not found!',404);  
 }  

 if (Hash::check($request->credential, $user->password)) {  
 $token = $user->createToken($user->name ?? $user->email ?? $user->phone)->plainTextToken;  
 return response()->json([  
 'token' => $token,  
 'user' => new UserResource($user)  
 ]);  
 }  

 $codeEntry = null;  

 if ($user->phone === $request->identifier) {  
 $codeEntry = Sms::select('phone', 'code', 'expiration_time')  
 ->where('phone', $user->phone)  
 ->first();  
 } elseif ($user->email === $request->identifier) {  
 $codeEntry = Email::select('email', 'code', 'expiration_time')  
 ->where('email', $user->email)  
 ->first();  
 }  

 if (!$codeEntry) {  
 return response()->json('Code not found!',404);  
 }  

 $now = Carbon::now()->format('Y-m-d H:i:s');  

 if ($now <= $codeEntry->expiration_time) {  
  if ($codeEntry->code == $request->credential) {  
 $token = $user->createToken($user->name ?? $user->email ?? $user->phone)->plainTextToken;  
 if ($user->phone === $request->identifier) {  
 Sms::where('phone', $user->phone)->delete();  
 } else {  
 Email::where('email', $user->email)->delete();  
 }  
 return response()->json(["token" => $token]);  
 } else {  
 return response()->json('Code is INCORRECT!',401);  
 }  
 } else {  
 return response()->json('The code is EXPIRED!',400);  
 }  
}
    
}
    

