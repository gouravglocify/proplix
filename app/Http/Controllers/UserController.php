<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SignUpNotification;
use Illuminate\Support\Str;
use App\UserCalculation;
use App\UserSubscription;
use App\Notifications\EmailChangeNotification;
use App\Notifications\SupportNotificationToUser;
use App\Notifications\SupportNotificationToAdmin;
use App\Notifications\PasswordReset;
use App\Notifications\ContactUs;
class UserController extends Controller
{
    public function index(Request $request){
        $userDetails = Auth::user();
        return view('welcome',compact('userDetails'));
    }
    public function login(Request $request){
        $checkUserLoggedIn = Auth::user();
        if(!is_null($checkUserLoggedIn)){
            return redirect(url('dashboard'));
        }

    	if(!empty($request->all())){
    		//CHECK USER EXISTANCE
    		$userDetails = User::where('email',$request->input('email'))->first();
    		if(is_null($userDetails)){
    			return back()->with('error','There is no account registered with this email '.strtoupper($request->input('email')).'.');
    		}

    		//CHECK EMAIL VERIFED OR NOT
    		if(is_null($userDetails->email_verified_at) || empty($userDetails->email_verified_at) ){
    			return back()->with('error','Please verify your email address '.strtoupper($request->input('email')).'.');
    		}

            $auth = Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);

            if($auth==false){
                return back()->with('error','Please enter valid credentials.');
            }

            if($userDetails->user_type=='2'){
                return redirect(url('adminDashboard'));
            }
            
    		
    		Auth::login($userDetails);
    		return redirect(url('dashboard'));
    	}
    	return view('auth.login');
    }


    public function register(Request $request){
        $checkUserLoggedIn = Auth::user();
        if(!is_null($checkUserLoggedIn)){
            return redirect(url('dashboard'));
        }
        if(!empty($request->all())){
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
                'phone' => ['required', 'string', 'max:10'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $user =  User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
                'user_type' => '1',
                'token'=>Str::random(60),
                'login_status'=>'1',
            ]);

            $user->notify((new SignUpNotification($user)));
            return back()->with('success','Account registered successfully. Please check your email for further instructions.');

        }
        return view('auth.register');
    }


    public function confirmEmail(Request $request,$id,$token){
        $getDetails = User::where([
                            'id'=>base64_decode($id),
                            'token'=>$token,
                            ])->first();

        if(is_null($getDetails)){
            return redirect(url('login'))->with('error','Authentication failed !');
        }
        User::where('id',$getDetails->id)->update(['email_verified_at'=>date('Y-m-d h:i:s')]);
        $userDetails = User::where('id',$getDetails->id)->first();
        Auth::login($userDetails);
        return redirect(url('dashboard'));

    }


    public function profile(Request $request){
        $userDetails = Auth::user();
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],
                                ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
        if(!empty($request->all())){
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'max:25'],
                'phone' => ['required', 'string','max:10',],
            ]);

            if(strtolower($request->input('email'))==strtolower($userDetails->email)){
                if(!is_null($request->input('password'))){
                    User::where('id',$userDetails->id)->update([
                                                            'name'=>$request->input('name'),
                                                            'password'=>bcrypt($request->input('password')),
                                                            'phone'=>$request->input('phone'),
                                                        ]);
                }   
                else{
                    User::where('id',$userDetails->id)->update([
                                                            'name'=>$request->input('name'),
                                                            'phone'=>$request->input('phone'),
                                                        ]);
                }
                return back()->with('success','Profile updated successfully.');
            }
            else{
                $checkEmail = User::where('email',$request->input('email'))->first();
                if(!is_null($checkEmail)){
                    return back()->with('error',strtoupper($request->input('email')).' email is already in use.');
                }
                if(!is_null($request->input('password'))){
                    User::where('id',$userDetails->id)->update([
                                                            'name'=>$request->input('name'),
                                                            'email'=>$request->input('email'),
                                                            'token'=>Str::random(60),
                                                            'email_verified_at'=>null,
                                                            'password'=>bcrypt($request->input('password')),
                                                            'phone'=>$request->input('phone'),
                                                        ]);
                }   
                else{
                    User::where('id',$userDetails->id)->update([
                                                            'name'=>$request->input('name'),
                                                            'email'=>$request->input('email'),
                                                            'token'=>Str::random(60),
                                                            'email_verified_at'=>null,
                                                            'phone'=>$request->input('phone'),
                                                        ]);
                }
                $user = User::where('id',$userDetails->id)->first();
                $user->notify((new EmailChangeNotification($user)));
                Auth::logout();
                return redirect(url('login'))->with('success','Please check your provided email for further assistance.');
            }
        }
        return view('user.profile',compact('userDetails','getUserSubscription','getCaluationshit'));
    }

    public function support(Request $request){
        $userDetails = Auth::user();
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],
                                ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
         if(!empty($request->all())){
            $request->validate([
                'message' => ['required', 'string', 'min:5'],
            ]);
            $userDetails->notify((new SupportNotificationToUser($request->input('message'))));
            //SENDING TO ADMIN
            $details = ['name'=>$userDetails->name,'email'=>$userDetails->email,'message'=>$request->input('message')];
            $when = now()->addSeconds(30);
            (new User)->forceFill([
                  'name' =>'PROPLIX',
                  'email' => env('SUPPORT_EMAIL'),
            ])->notify((new SupportNotificationToAdmin($details))->delay($when));


            return back()->with('success','Your message has been sent.');
        }
        return view('user.support',compact('userDetails','getUserSubscription','getCaluationshit'));
    }

    public function forgotPassword(Request $request){
        $checkUserLoggedIn = Auth::user();
        if(!is_null($checkUserLoggedIn)){
            return redirect(url('dashboard'));
        }
        if(!empty($request->all())){
            $request->validate([
                'email' => ['required', 'string', 'email'],
            ]);

            $getUserDetails = User::where('email',$request->input('email'))->first();
            if(is_null($getUserDetails)){
                return back()->with('error','There is not account link with this email '.strtoupper($request->input('email')).'.');
            }
            User::where('id',$getUserDetails->id)->update(['reset_token'=>Str::random(60)]);
            $updatedDetails =  User::where('id',$getUserDetails->id)->first();
            $getUserDetails->notify((new PasswordReset($updatedDetails)));
            return back()->with('success','Password reset link sent to your email '.strtoupper($request->input('email')).'.');
           
        }
        return view('auth.passwords.email');
    }


    public function passwordReset(Request $request,$id,$token){
        $getDetails = User::where([
                            'id'=>base64_decode($id),
                            'reset_token'=>$token,
                            ])->first();

        if(is_null($getDetails)){
            return redirect(url('login'))->with('error','Authentication failed !');
        }

        if(!empty($request->all())){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            User::where('id',$getDetails->id)->update([
                        'email_verified_at'=>date('Y-m-d h:i:s'),
                        'password'=>Hash::make($request->input('password')),
                        'reset_token'=>null,
                    ]);
            $userDetails = User::where('id',$getDetails->id)->first();
            Auth::login($userDetails);
            return redirect(url('dashboard'));
        }
        
        return view('auth.passwords.reset',compact('getDetails'));

    }

    public function plans(Request $request){
        $userDetails = Auth::user();
        return view('plans',compact('userDetails'));
    }

    public function privacyPolicy(Request $request){
        $userDetails = Auth::user();
        return view('privacyPolicy',compact('userDetails'));
    }
    public function termsConditions(Request $request){
        $userDetails = Auth::user();
        return view('termsConditions',compact('userDetails'));
    }
    public function refundPolicy(Request $request){
        $userDetails = Auth::user();
        return view('refundPolicy',compact('userDetails'));
    }
    public function aboutUs(Request $request){
        $userDetails = Auth::user();
        return view('aboutUs',compact('userDetails'));
    }
    public function contactUs(Request $request){
        $userDetails = Auth::user();
        if(!empty($request->all())){
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'max:50'],
                'message' => ['required', 'string'],
            ]);
            $details = $request->all();
            (new User)->forceFill([
                  'name' =>'PROPLIX',
                  'email' => env('SUPPORT_EMAIL'),
            ])->notify((new ContactUs($details)));
            return redirect(url('contactUs'))->with('success','Quote sent successfully !');
        }
        return view('contactUs',compact('userDetails'));
    }


}
