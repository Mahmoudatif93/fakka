<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use DB;
use App\UserShopingCart;
use App\SmsCode;
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App;
use App\GoldPrice;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest:website')->except(['guard', 'logout', 'updatenewpass']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index(Request $request)
    {
        $title = 'Register';
        $anotherproducts = [];
        $refer_id = $request->get('refer_id');
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.register', compact('title', 'anotherproducts', 'refer_id','goldPrice','egy','us'));
    } //end of inde


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    public function store(Request $request)
    {






        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:clients|numeric',
            'email' => 'required|unique:clients',
            'address' => 'required',
            //'national_id_front_img' => 'required',
            //'national_id_back_img' => 'required',
            'national_id' => 'required|unique:clients|numeric',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:password|same:password',
            //  'g-recaptcha-response' => 'required|captcha'
            'captcha' => 'required',
            'checkbox' => 'required'

        ];
        // dd($rules);
        $request->validate($rules);
        $request_data = $request->all();
        /////first image
        if ($request->national_id_front_img) {
            Image::make($request->national_id_front_img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/clients/' . $request->national_id_front_img->hashName()));

            $request_data['national_id_front_img'] = $request->national_id_front_img->hashName();
        } //end of if
        else {
            $request_data['national_id_front_img'] = "";
        }
        if ($request->national_id_back_img) {
            Image::make($request->national_id_back_img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/clients/' . $request->national_id_back_img->hashName()));

            $request_data['national_id_back_img'] = $request->national_id_back_img->hashName();
        } //end of if
        else {
            $request_data['national_id_back_img'] = "";
        }
        // client::create($request_data);

        Client::create([
            'first_name' => $request_data['first_name'],
            'last_name' => $request_data['last_name'],
            'phone' =>  $request_data['countarycode'].$request_data['phone'],
          
            'email' => $request_data['email'],
            'address' => $request_data['address'],
            'national_id' => $request_data['national_id'],
            'national_id_front_img' => $request_data['national_id_front_img'],
            'national_id_back_img' => $request_data['national_id_back_img'],
            'password' => Hash::make($request_data['password']),
            'refer_id' => rand(1, 9999999),
        ]);
        ///////////////////points///////////////////
        $refer_id = $request->refer_id;

        if (!empty($refer_id)) {
            $clientrefere = Client::where('refer_id', $refer_id)->first();

            $points['client_id'] = $clientrefere->id;
            $points['client_name'] = $clientrefere->first_name . '' . $clientrefere->last_name;
            $points['client_phone'] = $clientrefere->phone;
            $points['client_email'] = $clientrefere->email;
            $points['created_at'] = date('Y-m-d H:i:s');
            $points['totalpoints'] = 100 + DB::table('clients_points')->where(array('client_id' => $clientrefere->id))->sum('points');

            DB::table('clients_points')->insertGetId($points);
        }
        ///////////////////


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('fakka.login');
    }

    public function login(Request $request)
    {
        $title = 'Login';
        $anotherproducts = [];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.login', compact('title', 'anotherproducts','goldPrice','us','egy'));
    }

    public function postlogin(Request $request)
    {

        

        $clientapprove = Client::where(array('email' => $request->email, 'adminapprove' => 1))->first();
        
        if (!empty($clientapprove)) {
            if (Auth::guard('website')->attempt(['email' => $request->email, 'password' => $request->password])) {
                //  dd(auth('website')->user());

                return redirect()->route('fakka.index');
            } else {
                $error = "Email Or Password Is Wrong";


                return redirect()->route('fakka.login')->with(['error' => $error]);
            }
        }else{
            $error = "Email Or Password Is Wrong Or Account still not confirmed ";
            return redirect()->route('fakka.login')->with(['error' => $error]);
        }
    }





    public function resetpassword(Request $request)
    {
        $title = 'Reset Password';
        if (isset(Auth::guard('website')->user()->id)) {
            $anotherproducts = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
            // DB::table('user_shoping_carts')->where('created_at','>=', date("Y-m-d H:i:s", strtotime("+2 hours")))->where('client_id',Auth::guard('website')->user()->id)->delete();
        } else {
            $anotherproducts = [];
        }
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.resetpassword', compact('title', 'anotherproducts','goldPrice','egy','us'));
    }


    public function forgetpassword(Request $request)
    {
        $user = DB::table('clients')->where('email', '=', $request->email)
            ->first();
        //   dd($user);
        //Check if the user exists
        if ($user != null) {
            if (count(array($user)) < 1) {
                return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            }
            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token) == null) {
                $error = "A reset link has been sent to your email address.";

                return redirect()->route('fakka.resetpassword')->with(['error' => $error]);
            } else {
                $error = "A Network Error occurred. Please try again..";

                return redirect()->route('fakka.resetpassword')->with(['error' => $error]);
            }
        } else {
            $error = "There Is No User For This Email.";
            return redirect()->route('fakka.resetpassword')->with(['error' => $error]);
        }
    }


    public function sendResetEmail($user, $code)
    {

        $send =   Mail::send(
            'web.clients.linkreset',
            ['user' => $user, 'code' => $code],
            function ($message) use ($user) {
                $message->to($user);
                $message->subject("$user, reset your password .");
            }
        );
    }


    public function newpassword($code)
    {

        $email = Password_resets::where('token', $code)->first()->email;

        // dd($email);
        $title = 'new password';
        $anotherproducts = [];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.newpassword', compact('title', 'email', 'anotherproducts','goldPrice','egy','us'));
    } //end of newpassword


    public function updatenewpass(Request $request)
    {
        $rules = [

            'password' => 'required|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:password|same:password',
        ];
        $request->validate($rules);
        $request_data = $request->all();

        $password = Hash::make($request_data['password']);

        Client::where('email', $request_data['email'])
            ->update(['password' => $password]);

        session()->flash('success', "Password updated Successfully ");
        return redirect()->route('fakka.login');
    }
    public function guard()
    {
        return Auth::guard('website');
    }
    public function logout(Request $request)
    {
        //dd( $request);
        Auth::guard('website')->logout();
        return redirect()->route('fakka.login');
    }


    public function savesmscode(Request $request)
    {
       $inserted= SmsCode::create([
            
            'phone' => $request['phone'],
            'countarycode' => $request['code'],
            'smscode' => rand(1, 9999999),
        ]);
       
        echo  $inserted->smscode;
    }

    public function checkcode(Request $request)
    {

        //,'smscode'=>$request->smscode
       $sms= SmsCode::where(array('phone'=>$request->phone,'countarycode'=>$request->code))->latest()->first();

  
       if($sms->smscode ==$request->smscode ){
           echo 1;
       }else{
            echo 0;
       }
        
    }
    public function checkacountexist(Request $request)
    {
        $phone=$request->code.$request->phone;
        $clientapprove = Client::where(array('email' => $request->email))->orWhere('phone',$phone)->get();


if(count($clientapprove) > 0)
{
    echo 0;
}else{
    echo 1;
}
        //,'smscode'=>$request->smscode
      // $sms= SmsCode::where(array('phone'=>$request->phone,'countarycode'=>$request->code))->latest()->first();

  
     /*  if($sms->smscode ==$request->smscode ){
           echo 1;
       }else{
            echo 0;
       }*/
        
    }

    

    
}
