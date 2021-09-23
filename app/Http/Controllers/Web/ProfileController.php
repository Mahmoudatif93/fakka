<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Contacts;
use App\UserShopingCart;
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
use App\Product;
use App\clients_payments;
use App\ClientWallet;
use App\VirtualDetails;
use App\clientIban;
use App\Client;
use App\OrderPayment;
use App\virtualBalancesGold;
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App\AdminBankDetails;
use App\clientsPoints;
use App\PointsPrice;
use App;
use App\Shippingcost;
use App\Cart;
use App\FeesCaches;
use PDF;
use App\Gifts;
use App\ClientGifts;
use App\GoldPrice;
use App\Orderheader;
use App\Orderdetails;
class ProfileController  extends Controller
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

        $title = 'Profile ';

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalphysical = 0;
        $totalcard = 0;
        $totaldeleted = 0;
        $total_virtual = 0;
        $wallet = 0;
        $feesCaches = FeesCaches::with('Ingots')->get();
        $savedcart = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->get();
        if (isset(Auth::guard('website')->user()->id)) {
            $anotherproducts = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
           // $shopingcartproducts = clients_payments::where(array('client_id' => Auth::guard('website')->user()->id, 'status' => 1, 'deleted' => 0))->get();
            $shopingcartproducts = Orderheader::with('client')->with('Orderdetails')->where(array('client_id' => Auth::guard('website')->user()->id, 'status' => 1, 'deleted' => 0,'type'=>'Sell'))->get();

            $virtualpayment = VirtualDetails::where(array('paid' => 1, 'status' => 1, 'client_id' => Auth::guard('website')->user()->id))->get();
            $virtualBalanceGold = virtualBalancesGold::where(array('client_id' => Auth::guard('website')->user()->id))->get();
           // $total_virtual2 = VirtualDetails::orderBy('id', 'DESC')->where(array('paid' => 1, 'status' => 1, 'deleted' => 0, 'client_id' => Auth::guard('website')->user()->id))->first();
            $total_virtual2 = Orderheader::with('client')->with('Orderdetails')->where(array('client_id' => Auth::guard('website')->user()->id, 'status' => 1, 'deleted' => 0,'type'=>'virtual'))->get();

            $total_virtualdeleted = VirtualDetails::orderBy('id', 'DESC')->where(array('deleted' => 1, 'client_id' => Auth::guard('website')->user()->id))->get();
            foreach ($total_virtualdeleted  as $vdeleted) {
                $totaldeleted += $vdeleted->quantity;
            }

            foreach ($virtualBalanceGold as $virtual) {
                $totalphysical += $virtual->unite_weight *  $virtual->amount;
            }


            //dd(  $shopingcartproducts);
            if (!empty($shopingcartproducts)) {
                foreach ($shopingcartproducts as $card) {
                    if($card->type =="Sell"  ){

                    
                   // $totalcard += $card->total_grams;
                    foreach($card->Orderdetails as $details){
                        if($details->purchased ==0 ){
                            $totalcard += $details->product_weight * $details->qty;
                        }
                       // 
                    }
                }
                }
            }



            /*     echo $total_virtual2->total_quantity2;echo"<br>";echo $totaldeleted;echo"<br>";
        */

            if (!empty($total_virtual2)) {
                foreach($total_virtual2 as $row){
                    foreach($row->Orderdetails as $details)
                    if($details->purchased ==0){
                        $total_virtual += $details->product_weight;
                    }else{
                        $total_virtual += 0;
                    }
                   
                }
               
            } else {
                $total_virtual = 0;
            }
        } else {
            $shopingcartproducts = [];
            $anotherproducts = [];
            $virtualpayment = [];
            $total_virtual = 0;
            $virtualBalanceGold = [];
        }

        $wallets = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email, 'status' => 1))->first();
        $all_wallets = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email))->get();
        //$shopping_carts = clients_payments::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email))->get();
        $shopping_carts = Orderheader::with('client')->with('Orderdetails')->orderBy('id', 'DESC')->where(array('client_id' => Auth::guard('website')->user()->id))->get();

        if (!empty($wallets)) {
          //  foreach ($wallets as $walletss) {
                $wallet = $wallets->amount;
            //}
        } else {
            $wallet = 0;
        }
        $total_price2 = 0;
        $total_price = 0;

        //dd($virtualBalanceGold);
        $banks = AdminBankDetails::all();
        $ibans = clientIban::where(array('client_id' => Auth::guard('website')->user()->id))->get();
        /////// for wiew in profile web history
        $virtualpaymenthistory = VirtualDetails::where(array('paid' => 1, 'status' => 1, 'client_id' => Auth::guard('website')->user()->id))->get();

        ///////////points//////////////
        // $total_point=0;
        $points = clientsPoints::where(array('client_id' => Auth::guard('website')->user()->id))->get();
        /*foreach( $points as $point){
                $total_point+=$point->points;
            }*/


        $total_points = clientsPoints::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email))->first();
        if (!empty($total_points)) {
            $total_point =  $total_points->totalpoints;
        } else {
            $total_point = 0;
        }


        //////////////////
        //  dd($virtualpaymenthistory);

        $shippingcosts = Shippingcost::orderBy('id', 'DESC')->first();

        if (empty($shippingcosts)) {
            $shippingcost = 0;
        } else {
            $shippingcost =  $shippingcosts->shippingcost;
        }

        $pointsPrice = PointsPrice::orderBy('id', 'DESC')->first();
        if (empty($pointsPrice)) {
            $point_added = 1;
            $point_dedicated = 0;
        } else {
            $point_added =  $pointsPrice->point_added;
            $point_dedicated =  $pointsPrice->point_dedicated;
        }



       $gifts= Gifts::where('sold',0)->get();

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }


        //   dd(  $totalcard);

        return view('web.profile.profile', ['goldPrice'=>$goldPrice,'egy'=>$egy
,   'us'=>$us,        'anotherproducts' => $anotherproducts, 'title' => $title, 'products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty, 'price' => $cart->Price, 'total_price' => $total_price, 'total_price2' => $total_price2, 'virtualpayment' => $virtualpayment, 'total_virtual' => $total_virtual, 'ibans' => $ibans,
            'virtualBalanceGold' => $virtualBalanceGold, 'totalphysical' => $totalphysical,
            'shopingcartproducts' => $shopingcartproducts, 'banks' => $banks, 'wallet' => $wallet
        ])
            ->with('virtualpaymenthistory', $virtualpaymenthistory)->with('points', $points)->with('total_point', $total_point)
            ->with('shippingcost', $shippingcost)->with('all_wallets', $all_wallets)
            ->with('shopping_carts', $shopping_carts)->with('feesCaches', $feesCaches)
            ->with('totalcard', $totalcard)->with('point_added', $point_added)->with('gifts',$gifts)->with('point_dedicated',$point_dedicated );
    } //end of inde





    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    public function store(Request $request)
    {

        $rules = [

            'image' => 'required',
        ];

        $request->validate($rules);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/clients/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }
        if (!empty($request_data['image'])) {
            $update = Client::where('id', $request->id)->update([
                'image' => $request_data['image'],

            ]);
        }


        return redirect()->route('fakka.profile.index');
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
        $total_price2 = 0;
        $total_price = 0;
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.clients.resetpassword', compact('title', 'anotherproducts', 'total_price2', 'total_price','egy','us'));
    }
    public function update_address(Request $request, $id)
    {
        $data['address'] = $request->address;
        $update = Client::where('id', $id)->update($data);

        if ($update == 1) {
            return "updated";
        } else {

            return "error";
        }
    }


    public function delete_image(Request $request)
    {

        $update = Client::where('id', $request->id)->update([
            'image' => null,

        ]);
        //  $update= Client::where('id',$request->id)->delete('image');
        if ($update == 1) {
            return "updated";
        } else {

            return "error";
        }
    }

    public function newpassword(Request $request)
    {

        $email2 = Client::where('id', $request->id)->first();
        $email = $email2->email;
        //  dd($email->email);
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
        return view('web.clients.newpassword', compact('title', 'anotherproducts','egy','us'))->with('email', $email);
    } //end of newpassword

    public function saveredeemgold(Request $request)
    {



        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }


        $post['client_id'] = Auth::guard('website')->user()->id;
        $post['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $post['client_phone'] = Auth::guard('website')->user()->phone;
        $post['client_email'] = Auth::guard('website')->user()->email;
        $post['unite_weight'] = $request->quantity;
        $post['amount'] = $request->amount;
        $post['price'] = $request->amount * $request->quantity * $egy;
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['recet_no'] = rand(1, 9999999);
        $post['certificate_no'] = rand(1, 7456995);


        if ($request->total_gram < $request->amount * $request->quantity) {
            echo "false";
            $post2['total_quantity2'] = 0;
        } else {
            $post2['total_quantity2'] = $request->total_gram - ($request->amount * $request->quantity);


            $addfees = .995 * $egy *  $post['unite_weight'] * $post['amount'];

            $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();

            $added['amount'] = $total_amount->amount + $addfees;

            ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->update($added);

            if ($post['unite_weight'] == 10) {
                $dedecti = (50 + $egy) * $post['unite_weight'] * $post['amount'];

                $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();
                $Final['amount'] = ($total_amount->amount - $dedecti);
                ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->update($Final);
            }

            if ($post['unite_weight'] == 20 || $post['amount'] == 31.5) {
                $dedecti = (45 + $egy) * $post['unite_weight'] * $post['amount'];
                $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();
                $Final['amount'] = ($total_amount->amount - $dedecti);
                ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->update($Final);
            }

            if ($post['unite_weight'] == 100 || $post['amount'] == 50) {
                $dedecti = (37 + $egy) * $post['unite_weight'] * $post['amount'];
                $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();
                $Final['amount'] = ($total_amount->amount - $dedecti);
                ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->update($Final);
            }
            foreach ($request->cachbacks as $cachback) {
                $post['cache_back'] = $cachback;
            }


            //////////////////////////*save physicalorder///////////////

            if ($post['unite_weight'] == 10) {
                $physical['total_fees'] = (50 + $egy) * $post['unite_weight'] * $post['amount'];
            }
            if ($post['unite_weight'] == 20 || $post['amount'] == 31.5) {
                $physical['total_fees']= (45 + $egy) * $post['unite_weight'] * $post['amount'];
            }
            if ($post['unite_weight'] == 100 || $post['amount'] == 50) {
                $physical['total_fees'] = (37 + $egy) * $post['unite_weight'] * $post['amount'];
            }
                $physical['year'] =date("Y");
                $physical['type'] ='Sell';
                $physical['client_id'] =Auth::guard('website')->user()->id;
                $physical['total_grams']=$request->amount * $request->quantity;
                $physical['total_price'] =$request->amount * $request->quantity * $egy;
                $physical['price_per_gram'] =$egy;
                $physical['currency'] = "EGP";
                $physical['payment_date'] =date("d-m-Y H:i:s");
                $physical['created_at'] =date("Y-m-d H:i:sO");
                $physical['updated_at'] =date("Y-m-d H:i:sO");
                $physical['status']=1;
                $physicalid=DB::table('orderheaders')->insertGetId($physical);
                 
                $physicaldetails['order_year'] =date("Y");
                $physicaldetails['orderheaders_id'] = $physicalid;
                $physicaldetails['product_id'] = -1;
                $physicaldetails['product_weight'] =$request->amount * $request->quantity;
                $physicaldetails['unit_price'] =$request->amount * $request->quantity * $egy;
                $physicaldetails['total_price'] = $request->amount * $request->quantity * $egy;
                 $physicaldetails['qty'] =$request->amount;
                $physicaldetails['earned_points'] = $request->amount * $request->quantity * 1000;
                $physicaldetails['created_at'] =date("Y-m-d H:i:sO");
                $physicaldetails['updated_at'] =date("Y-m-d H:i:sO");
                $physicaldetails['recet_no'] = rand(1, 9999999);
                $physicaldetails['certificate_no'] = rand(1, 7456995);
        
                DB::table('orderdetails')->insertGetId($physicaldetails);
          
        //////////////////****//////////////////////////*save vertual buy order///////////////
       
        if ($post['unite_weight'] == 10) {
            $vertual['total_fees'] = (50 + $egy) * $post['unite_weight'] * $post['amount'];
        }
        if ($post['unite_weight'] == 20 || $post['amount'] == 31.5) {
            $vertual['total_fees']= (45 + $egy) * $post['unite_weight'] * $post['amount'];
        }
        if ($post['unite_weight'] == 100 || $post['amount'] == 50) {
            $vertual['total_fees'] = (37 + $egy) * $post['unite_weight'] * $post['amount'];
        }
            $vertual['year'] =date("Y");
            $vertual['type'] ='virtual';
            $vertual['client_id'] =Auth::guard('website')->user()->id;
            $vertual['total_grams']= -($request->amount * $request->quantity);
            $vertual['total_price'] = -($request->amount * $request->quantity * $egy);
            $vertual['price_per_gram'] =$egy;
            $vertual['currency'] = "EGP";
            $vertual['payment_date'] =date("d-m-Y H:i:s");
            $vertual['created_at'] =date("Y-m-d H:i:sO");
            $vertual['updated_at'] =date("Y-m-d H:i:sO");
            $vertual['status']=1;
            $vertualid=DB::table('orderheaders')->insertGetId($vertual);
             
            $vertualdetails['order_year'] =date("Y");
            $vertualdetails['orderheaders_id'] = $vertualid;
            $vertualdetails['product_id'] = -1;
            $vertualdetails['product_weight'] = -($request->amount * $request->quantity);
            $vertualdetails['unit_price'] = -($request->amount * $request->quantity * $egy);
            $vertualdetails['total_price'] = -($request->amount * $request->quantity * $egy);
         
            $vertualdetails['earned_points'] = 0;
            $vertualdetails['created_at'] =date("Y-m-d H:i:sO");
            $vertualdetails['updated_at'] =date("Y-m-d H:i:sO");
            $vertualdetails['recet_no'] = rand(1, 9999999);
            $vertualdetails['certificate_no'] = rand(1, 7456995);
    
            DB::table('orderdetails')->insertGetId($vertualdetails);
            /////////////////////////////////////////

           // $update = VirtualDetails::orderBy('id', 'DESC')->where(array('paid' => 1, 'status' => 1, 'client_id' => Auth::guard('website')->user()->id))->update($post2);
           // $id = DB::table('virtual_balances_gold')->insertGetId($post);
        }
        ///////////////////points///////////////////
        $points['client_id'] = Auth::guard('website')->user()->id;
        $points['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $points['client_phone'] = Auth::guard('website')->user()->phone;
        $points['client_email'] = Auth::guard('website')->user()->email;
        $points['created_at'] = date('Y-m-d H:i:s');

        $points['points'] = $request->amount * $request->quantity * 1000;
        $points['totalpoints'] = $points['points'] + DB::table('clients_points')->where(array('client_id' => Auth::guard('website')->user()->id))->sum('points');
        DB::table('clients_points')->insertGetId($points);


        //////////////////////////////////////////////
        echo "inserted";
    }

    public function savereclientiban(Request $request)
    {

        $post['client_id'] = Auth::guard('website')->user()->id;
        $post['Iban_number'] = $request->iban_number;
        $post['bank_name'] = $request->clientbank;
        $post['created_at'] = date('Y-m-d H:i:s');
        $id = DB::table('client_ibans')->insertGetId($post);
        return "updated";
    }
    public function saveredeemmoney(Request $request)
    {

        $post['client_id'] = Auth::guard('website')->user()->id;
        $post['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $post['client_phone'] = Auth::guard('website')->user()->phone;
        $post['client_email'] = Auth::guard('website')->user()->email;
        $post['amount'] = $request->amount;
        $post['equal'] = $request->equal;
        $post2['total_quantity2'] = $request->total_gram - $request->amount;
        $post['created_at'] = date('Y-m-d H:i:s');
        $khasm = $post['equal'] * .005;

        $addedmoey = $post['equal'] - $khasm;

        $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();
        $Final['amount'] = $total_amount->amount + $addedmoey;
        ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->update($Final);
        //VirtualDetails::orderBy('id', 'DESC')->where(array('paid' => 1, 'status' => 1, 'client_id' => Auth::guard('website')->user()->id))->update($post2);


      //  $id = DB::table('virtual_balances_money')->insertGetId($post);







   //////////////////****//////////////////////////*save vertual buy order///////////////
       
 
    $vertualredeem['year'] =date("Y");
    $vertualredeem['type'] ='virtual';
    $vertualredeem['client_id'] =Auth::guard('website')->user()->id;
    $vertualredeem['total_grams']= - $request->amount;
    $vertualredeem['total_price'] = -($request->equal );
    $vertualredeem['total_fees'] =($request->equal  * .005);
    
    $vertualredeem['currency'] = "EGP";
    $vertualredeem['payment_date'] =date("d-m-Y H:i:s");
    $vertualredeem['created_at'] =date("Y-m-d H:i:sO");
    $vertualredeem['updated_at'] =date("Y-m-d H:i:sO");
    $vertualredeem['status']=1;
    $vertualredeemid=DB::table('orderheaders')->insertGetId($vertualredeem);
     
    $vertualdetails['order_year'] =date("Y");
    $vertualdetails['orderheaders_id'] = $vertualredeemid;
    $vertualdetails['product_id'] = -1;
    $vertualdetails['product_weight'] = -($request->amount );
    $vertualdetails['unit_price'] = -($request->equal);
    $vertualdetails['total_price'] = -($request->equal);
 
    $vertualdetails['earned_points'] = $request->amount *  1000;
    $vertualdetails['created_at'] =date("Y-m-d H:i:sO");
    $vertualdetails['updated_at'] =date("Y-m-d H:i:sO");
    $vertualdetails['recet_no'] = rand(1, 9999999);
    $vertualdetails['certificate_no'] = rand(1, 7456995);

    DB::table('orderdetails')->insertGetId($vertualdetails);
    /////////////////////////////////////////



        ///////////////////points///////////////////
        $points['client_id'] = Auth::guard('website')->user()->id;
        $points['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $points['client_phone'] = Auth::guard('website')->user()->phone;
        $points['client_email'] = Auth::guard('website')->user()->email;
        $points['created_at'] = date('Y-m-d H:i:s');
        $points['points'] = $request->amount *  1000;
        $points['totalpoints'] = $points['points'] + DB::table('clients_points')->where(array('client_id' => Auth::guard('website')->user()->id))->sum('points');
        DB::table('clients_points')->insertGetId($points);
        ///////////////////////////

        echo "inserted";
    }
    public function confirmpass(Request $request)
    {
        $email = Auth::guard('website')->user()->email;
        if (Auth::guard('website')->attempt(['email' => $email, 'password' => $request->password])) {
            echo "true";
        } else {
            echo 'false';
        }
    }
    public function checkwaletredeme(Request $request)
    {
        $email = Auth::guard('website')->user()->email;
        $amount = $request->amount;
        $quantity = $request->quantity;
        $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $email, 'status' => 1))->get();
        $currnet = Session::get('price') * $amount;
        $amount_wallet = 0;

        if ($quantity = 10) {
            $khsm = 50;
        }
        if ($quantity == 20 || $quantity == 31.5) {
            $khsm = 45;
        }
        if ($quantity == 100 || $quantity == 50) {
            $khsm = 37;
        }

        if (!empty($total_amount)) {
            foreach ($total_amount as $total) {
                $amount_wallet += $total->amount;
            }
            if ($amount_wallet > ($khsm * $currnet)) {
                echo "true";
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }

    public function checkamountredeemgold(Request $request)
    {
        $email = Auth::guard('website')->user()->email;
        $amount = $request->equal2;

        /* $created_at=$virtual->added_at ;
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $created_at);
            $daysToAdd=2;
            $created_at2 = $date->addDays($daysToAdd);*/
        $total_gram = $request->total_gram;
        $quantitya = 0;
        //$virtuals = VirtualDetails::where(array('email' => $email, 'status' => 1, 'paid' => 1))->where('created_at', '<', date("Y-m-d 00:00:00", strtotime("-48 hours")))->get();
       

        $virtuals = Orderheader::with('client')->with('Orderdetails')->where(array('client_id' => Auth::guard('website')->user()->id, 'status' => 1, 'deleted' => 0,'type'=>'virtual'))
        ->where('created_at', '<', date("Y-m-d 00:00:00", strtotime("-48 hours")))->OrWhere('total_grams','<', 0)->get();
      

       
        if (!empty($virtuals)) {
            foreach ($virtuals as $virtual) {
                $quantitya += $virtual->total_grams;
            }
         //   dd($quantitya);

            if ($quantitya >= $amount) {

                if ($quantitya != 0 && $quantitya > 0) {
                    $total = $total_gram - $amount;

                    // dd($total);
                    if ($total < 0) {
                        echo "false";
                    } else {
                        echo "true";
                    }
                } else {
                    echo "false";
                }
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    }


    public function savephysicalredeemmoney(Request $request)
    {

     
        $ids = $request->results;
        $resultshopping = $request->resultshopping;
        $shopingproductid = $request->shopingproductid;
        $virtualcashs = $request->virtualcashs;
        $numberofgrams = $request->multislsect;
        $priceofallgrams = $request->physicalredeemmoney;

        $allshopcachback = 0;

        $allvirtualcachback = 0;
        $allnumberofgrams = 0;

        if (!empty($shopingproductid)) {
            foreach ($shopingproductid as $product_id) {
                if ($product_id != null) {
                    $product = Product::where(array('id' => $product_id))->first();
                    $allshopcachback += $product->cashs;
                }
            }
        } else {
            $allshopcachback = 0;
        }
        if (!empty($virtualcashs)) {

            foreach ($virtualcashs as $virtualcash) {

                if ($virtualcash != null) {
                    $allvirtualcachback += $virtualcash;
                }
            }
        } else {
            $allvirtualcachback = 0;
        }

        $allcachback = $allshopcachback + $allvirtualcachback;

        foreach ($numberofgrams as $grams) {
            $allnumberofgrams += $grams;
        }
        $addwallet = ($allcachback * $allnumberofgrams) + $priceofallgrams;


        $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_id' => Auth::guard('website')->user()->id, 'status' => 1))->first();
        $Final['amount'] = $total_amount->amount + $addwallet;
        ClientWallet::where(array('client_id' => Auth::guard('website')->user()->id))->update($Final);

        if (!empty($ids)) {
            foreach ($ids as $id) {
                virtualBalancesGold::where(array('client_id' => Auth::guard('website')->user()->id, 'id' => $id))->delete();
            }
        }

        if (!empty($resultshopping)) {
            foreach ($resultshopping as $idshop) {
               
                $orderdetails=Orderdetails::where(array('id' => $idshop))->first();
                
                $Orderheader=Orderheader::with('client')->with('Orderdetails')->where(array('id' => $orderdetails->orderheaders_id))->first();

                $update['purchased'] =1;
                Orderdetails::where(array('id' => $idshop))->update($update);

                $data3['year'] =date("Y");
                $data3['type'] ='buy';
                $data3['client_id'] =Auth::guard('website')->user()->id;
                $data3['total_grams'] =- $allnumberofgrams;
                $data3['total_fees'] = - $allcachback * $allnumberofgrams;
                $data3['total_price'] = ($allnumberofgrams * $Orderheader->price_per_gram * count($request->multislsect) )+ ($allcachback * count($request->multislsect) *$allnumberofgrams) ;
                $data3['price_per_gram'] = $Orderheader->price_per_gram;
                $data3['total_qty'] = count($request->multislsect);
                $data3['currency'] = "EGP";
                $data3['payment_date'] =date("d-m-Y H:i:s");
                $data3['created_at'] =date("Y-m-d H:i:sO");
                $data3['updated_at'] =date("Y-m-d H:i:sO");
                $data3['status'] =1;
               
                
            }
                $data4['orderheaders_id']=DB::table('orderheaders')->insertGetId($data3);

                for ($i = 0; $i < count($resultshopping); $i++) {
                    $orderdetails2=Orderdetails::where(array('id' => $resultshopping[$i]))->get();
               //echo"<pre>";print_r( $resultshopping[1]);echo"<pre>";print_r($orderdetails2[0]); 

                    $product2 = Product::where(array('id' => $shopingproductid[$i]))->get();
                    $data4['order_year'] =date("Y");
                    $data4['product_id'] =$shopingproductid[$i];
                    $data4['product_name'] =$orderdetails2[0]->product_name;
                    $data4['category_name'] = $orderdetails2[0]->category_name;
                    $data4['product_weight'] =  $orderdetails2[0]->product_weight;
                    $data4['qty'] = -$orderdetails2[0]->qty;
                    $data4['unit_price'] = $orderdetails2[0]->product_weight * $orderdetails2[0]->qty * $Orderheader->price_per_gram;
                    $data4['total_price'] =$orderdetails2[0]->product_weight * $orderdetails2[0]->qty * $Orderheader->price_per_gram + $orderdetails2[0]->product_weight * $product2[0]->cashs  * $Orderheader->price_per_gram;
                    $data4['fees'] = - $product2[0]->cashs * $orderdetails2[0]->product_weight ;
                    $data4['earned_points'] = $orderdetails2[0]->product_weight * $orderdetails2[0]->qty * 1000;
                    $data4['created_at'] =date("Y-m-d H:i:sO");
                    $data4['updated_at'] =date("Y-m-d H:i:sO");
                    $data4['purchased'] =1;
                    $data4['recet_no'] = rand(1, 9999999);
                    DB::table('orderdetails')->insertGetId($data4);

                }


                //clients_payments::where(array('client_id' => Auth::guard('website')->user()->id, 'id' => $idshop))->delete();
          
        }
////////////////////////wallet
/*
$post= Orderheader::where('id', $request->id)->first();
$total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post->client_id, 'status' => 1))->first();
$Final['amount'] = ($total_amount->amount -   $post->total_price);
ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post['client_id'], 'status' => 1))->update($Final);*/

        ///////////////////points///////////////////
        $points['client_id'] = Auth::guard('website')->user()->id;
        $points['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $points['client_phone'] = Auth::guard('website')->user()->phone;
        $points['client_email'] = Auth::guard('website')->user()->email;
        $points['created_at'] = date('Y-m-d H:i:s');
        $points['points'] = $allnumberofgrams *  1000;
        $points['totalpoints'] = $points['points'] + DB::table('clients_points')->where(array('client_id' => Auth::guard('website')->user()->id))->sum('points');
        DB::table('clients_points')->insertGetId($points);
        ///////////////////////////

        echo "handled";

        $email = Auth::guard('website')->user()->email;
        $this->sendnetofyEmail($email);
    }


    public function sendnetofyEmail($user)
    {

        $send =   Mail::send(
            'web.profile.physicalbancenotify',
            ['user' => $user],
            function ($message) use ($user) {
                $message->to($user);
                $message->subject("$user, Wallet transaction.");
            }
        );
    }
    public function delete_iban(Request $request)
    {
        $update = clientIban::where('id', $request->id)->delete();
        if ($update == 1) {
            return "updated";
        } else {
            return "error";
        }
    }


    public function savewalletmoney(Request $request)
    {

        $post['client_id'] = Auth::guard('website')->user()->id;
        $post['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $post['client_phone'] = Auth::guard('website')->user()->phone;
        $post['client_email'] = Auth::guard('website')->user()->email;
        $post['currency'] = 'EGP';
        $post['bank_name'] = $request->bank_name;
        $post['iban'] = $request->iban;
        $post['transaction_number'] = $request->transaction_number;
        $post['created_at'] = date('Y-m-d H:i:s');
        $wallet = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $post['client_email'], 'status' => 1))->first();
        if (!empty($wallet)) {
            $post['amount'] = $wallet->amount + $request->amount;
            $post['unitamount'] =  $request->amount;
        } else {
            $post['amount'] = $request->amount;
            $post['unitamount'] =  $request->amount;
        }

        $id = DB::table('client_wallets')->insertGetId($post);
        $this->sendEmail($post['client_email'], $id);
        echo "inserted";
    }


    public function checkwithdrowamount(Request $request)
    {
        $email = Auth::guard('website')->user()->email;
        $withdrowamount = $request->withdrowamount;
        $wallet = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => $email, 'status' => 1))->first();

        if (!empty($wallet)) {
            if ($wallet->amount >= $withdrowamount) {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    }



    public function withdrowwalletmoney(Request $request)
    {

        $post['client_id'] = Auth::guard('website')->user()->id;
        $post['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $post['client_phone'] = Auth::guard('website')->user()->phone;
        $post['client_email'] = Auth::guard('website')->user()->email;
        $post['currency'] = 'EGP';
        $post['bank_name'] = $request->bank_name;
        $post['iban'] = $request->iban;
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['amount'] = $request->amount;


        $id = DB::table('clients_withdrow_histories')->insertGetId($post);
        $this->sendEmail($post['client_email'], $id);
        echo "inserted";
    }




    public function sendEmail($user, $id)
    {
        $send =   Mail::send(
            'web.profile.confirmLink',
            ['user' => $user, 'id' => $id],
            function ($message) use ($user, $id) {
                $message->to($user);
                $message->subject("Wallet Money  .");
            }
        );
    }


    public function saveshippingcost(Request $request)
    {
        $ids = $request->results;



        foreach ($ids as $id) {
           $Orderdetails=Orderdetails::where('id',$id)->first();
            $product=Product::with('ProductTranslation')->with('category')->where('id',$Orderdetails->product_id)->first();
            
            $post['client_id'] = Auth::guard('website')->user()->id;
            $post['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
            $post['client_phone'] = Auth::guard('website')->user()->phone;
            $post['client_email'] = Auth::guard('website')->user()->email;
            $post['shipping_cost'] = $request->shipping_cost;
            $post['amount_id'] = $id;
            $post['amount'] = $request->amount;
            $post['created_at'] = date('Y-m-d H:i:s');;
            $d = DB::table('shipping_ingots')->insertGetId($post);

        $data3['year'] =date("Y");
        $data3['type'] ='shipping';
        $data3['client_id'] =Auth::guard('website')->user()->id;
        $data3['total_grams'] =$request->amount;
        $data3['total_price'] =$request->shipping_cost;
        $data3['currency'] = "EGP";
        $data3['payment_date'] =date("d-m-Y H:i:s");
        $data3['created_at'] =date("Y-m-d H:i:sO");
        $data3['updated_at'] =date("Y-m-d H:i:sO");
        $data4['orderheaders_id']=DB::table('orderheaders')->insertGetId($data3);
        $data4['order_year'] =date("Y");
        $data4['product_id'] = $Orderdetails->product_id;
        $data4['purchased'] =1;
        $data4['recet_no'] = rand(1, 9999999);
        
if($Orderdetails->product_id >0){
    $data4['product_name'] = $product->ProductTranslation[0]->name;
    $data4['category_name'] = $product->category->CategoryTranslation[0]->name;
}
       
        $data4['product_weight'] = $product->weight;
        $data4['earned_points'] = $request->amount *  1000;
        $data4['created_at'] =date("Y-m-d H:i:sO");
        $data4['updated_at'] =date("Y-m-d H:i:sO");
    

        DB::table('orderdetails')->insertGetId($data4);

        $update['purchased'] =1;
        Orderdetails::where(array('id' => $id))->update($update);

        }
        ///////////////////points///////////////////
        $points['client_id'] = Auth::guard('website')->user()->id;
        $points['client_name'] = Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
        $points['client_phone'] = Auth::guard('website')->user()->phone;
        $points['client_email'] = Auth::guard('website')->user()->email;
        $points['created_at'] = date('Y-m-d H:i:s');
        $points['points'] = $request->amount *  1000;
        $points['totalpoints'] = $points['points'] + DB::table('clients_points')->where(array('client_id' => Auth::guard('website')->user()->id))->sum('points');
        DB::table('clients_points')->insertGetId($points);
        ///////////////////////////


        $this->sendEmail(Auth::guard('website')->user()->email, $d);
        echo "inserted";
    }

    public function certifcates(Request $request, $id)
    {
        $title = 'Certicates';
        $virtualpaymenthistory = VirtualDetails::where(array('id' => $id, 'paid' => 1, 'client_id' => Auth::guard('website')->user()->id))->first();

        $anotherproducts = [];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.profile.certicates', compact('title', 'anotherproducts', 'virtualpaymenthistory','egy','us'));
    }


    public function printcertifcates(Request $request, $id)
    {
        $title = 'Certicates';
        $virtualpaymenthistory = VirtualDetails::where(array('id' => $id, 'paid' => 1, 'client_id' => Auth::guard('website')->user()->id))->first();

        $anotherproducts = [];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.profile.print', compact('title', 'anotherproducts', 'virtualpaymenthistory','us','egy'));
    }


    public function downloadPDF($id)
    {
        $virtualpaymenthistory = VirtualDetails::find($id);
        //  $pdf = PDF::loadView('web.profile.pdf', compact('virtualpaymenthistory'));

        $pdf    = PDF::loadView('web.profile.invoice', compact('virtualpaymenthistory'))->setPaper('a4', 'portrait');
        return $pdf->download('web.profile.invoice.pdf');
    }


    //////////////////////////////* physical_certifcates */////////////////////
    public function physical_certifcates(Request $request, $id)
    {
        $title = 'Certicates';
        $virtualpaymenthistory = virtualBalancesGold::where(array('id' => $id, 'client_id' => Auth::guard('website')->user()->id))->first();

        $anotherproducts = [];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.profile.physical_certifcates', compact('title', 'anotherproducts', 'virtualpaymenthistory','us','egy'));
    }


    public function physical_printcertifcates(Request $request, $id)
    {
        $title = 'Certicates';
        $virtualpaymenthistory = virtualBalancesGold::where(array('id' => $id, 'client_id' => Auth::guard('website')->user()->id))->first();

        $anotherproducts = [];
        return view('web.profile.physical_print', compact('title', 'anotherproducts', 'virtualpaymenthistory'));
    }


    public function physical_downloadPDF($id)
    {
        $virtualpaymenthistory = virtualBalancesGold::find($id);

        $pdf    = PDF::loadView('web.profile.physical_invoice', compact('virtualpaymenthistory'))->setPaper('a4', 'portrait');
        return $pdf->download('web.profile.physical_invoice.pdf');
    }

    //////////////////////////////////

    public function getaddiban(Request $request)
    {
        foreach ($request->results as $id) {
            $ibans = AdminBankDetails::where('id', $id)->first();
            if (!empty($ibans)) {
                return ($ibans);
            } else {
                echo ('false');
            }
        }
    }

    public function getwithdrwiban(Request $request)
    {
        foreach ($request->results as $id) {
            $ibans = clientIban::where('id', $id)->first();
            if (!empty($ibans)) {
                return ($ibans);
            } else {
                echo ('false');
            }
        }
    }



    public function  redeempoints(Request $request)
    {

        $points_added = $request->points_added;

        $wallet = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email, 'status' => 1))->first();
        if (!empty($wallet)) {
            $post['amount'] = $wallet->amount +  $points_added;
        } else {
            $post['amount'] = $points_added;
        }

        foreach ($request->results as $id) {

            if ($id != 0) {
                clientsPoints::where(array('client_id' => Auth::guard('website')->user()->id, 'id' => $id))->delete();
            }
        }

        ClientWallet::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email, 'status' => 1))->update($post);

        echo 'handeled';
    }


    public function dedectpointsmonthl()
    {


        $pointsPrice = PointsPrice::orderBy('id', 'DESC')->first();
        if (empty($pointsPrice)) {
            $point_added = 1;
            $point_dedicated = 0;
        } else {
            $point_added =  $pointsPrice->point_added;
            $point_dedicated =  $pointsPrice->point_dedicated;
        }
        $total_pointssss = clientsPoints::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email))->first();
        $client = Client::where(array('id' => Auth::guard('website')->user()->id))->where('created_at', '<', date("Y-m-d 00:00:00", strtotime("-730 hours")))->first();
        if (!empty($client)) {
            $dedactp['totalpoints'] =  $total_pointssss->totalpoints - $point_dedicated;

            clientsPoints::orderBy('id', 'DESC')->where(array('client_email' => Auth::guard('website')->user()->email))->update($dedactp);
        }
    }

    public function redeemgift(Request $request)
    {
        $totalpoints = $request->totalpoints;
        $id = $request->id;
       $gift= Gifts::where(array('id' => $id))->first();
       if(!empty($gift)){
            $gift_point=$gift->gift_points;
            if($totalpoints >= $gift_point){
                $request_data['gift_id']=$id;
                $request_data['client_name']=Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name;
                $request_data['client_email']=Auth::guard('website')->user()->email;;
                $gift= ClientGifts::create($request_data);
                $up['sold']=1;
                Gifts::where(array('id' => $id))->update($up);
                echo "true";
            }else{

                echo "false";
            }

       }else{
        echo "false";
       }

}



public function slfestore(Request $request)
{
    $rules = [

        'id_image' => 'required',
    ];


    $request->validate($rules);

    if ($request->id_image) {

        Image::make($request->id_image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/clients/' . $request->id_image->hashName()));

        $request_data['id_image'] = $request->id_image->hashName();
    }


    if (!empty($request_data['id_image'])) {
        $update = Client::where('id', $request->id)->update([
            'id_image' => $request_data['id_image'],

        ]);
    }
    return redirect()->route('fakka.profile.index');
}

public function delete_selfeimage(Request $request)
{

    $update = Client::where('id', $request->id)->update([
        'id_image' => null,

    ]);
    //  $update= Client::where('id',$request->id)->delete('image');
    if ($update == 1) {
        return "updated";
    } else {

        return "error";
    }
}



}
