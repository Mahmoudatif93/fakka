<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Contacts;
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
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App;
use App\GoldPrice;
use App\UserShopingCart;
class ContactUsController extends Controller
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
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index(Request $request)
    {
        $title = 'Contact Us';
        if(isset(Auth::guard('website')->user()->id)){
            $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
           // DB::table('user_shoping_carts')->where('created_at','>=', date("Y-m-d H:i:s", strtotime("+2 hours")))->where('client_id',Auth::guard('website')->user()->id)->delete();
        }else{
            $anotherproducts =[];
        }
        $total_price2=0; 
        $total_price=0; 
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.contact_us.contact_us', compact('title','anotherproducts','total_price2','total_price','goldPrice','egy','us'));
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

        // dd($request);
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ];
        $request->validate($rules);
        $request_data = $request->all();


        Contacts::create([
            'name' => $request_data['name'],
            'email' => $request_data['email'],
            'phone' => $request_data['phone'],
            'subject' => $request_data['subject'],
            'message' => $request_data['message'],
        ]);
        session()->flash('success', "Your Message is sent Now");
        return redirect()->route('fakka.contactus.index');
    }

    public function login(Request $request)
    {
        $title = 'Login';
        $anotherproducts=[];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.login', compact('title','anotherproducts','egy','us'));
    }

    public function postlogin(Request $request)
    {

        if (Auth::guard('website')->attempt(['email' => $request->email, 'password' => $request->password])) {


            return redirect()->route('fakka.index');
        } else {
            $error = "Email Or Password Is Wrong";


            return redirect()->route('fakka.login')->with(['error' => $error]);
        }
    }





    public function resetpassword(Request $request)
    {
        $title = 'Reset Password';
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.resetpassword', compact('title','egy','us'));
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
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.newpassword', compact('title', 'email','egy','us'));
    } //end of newpassword


    public function updatenewpass(Request $request)
    {
        $rules = [

            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
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
        $this->guard()->logout();
        return redirect()->route('fakka.login');
    }
}
