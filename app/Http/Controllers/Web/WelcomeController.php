<?php

namespace App\Http\Controllers\Web;

use App\Category;
//use App\Client;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\AboutUs;
use App\Cart;
use Carbon\Carbon;
use App\UserShopingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Scheduling\Schedule;
use App\clients_payments;
use Cookie;
use App\GoldPrice;
use Goutte\Client;
class WelcomeController extends Controller
{
    public function index(Request $request)
    {


 ////////get eg gold price
 $client = new Client();
 //  $page = $client->request('GET', 'https://www.xe.com/currencytables/?from=XAU&date=2020-12-29');
 $page = $client->request('GET', 'http://goldpricez.com/eg/gram');

 $total=$page->filter('.display_rates')->text();
 $percentage = .2;
$coldeprice = substr($total,27);
$new_total = ($percentage / 100) * $coldeprice;
$last_total=$coldeprice + $new_total;

$request->session()->put('priceproduct',$last_total );
///////////////////get dollar gold

$page_us = $client->request('GET', 'http://goldpricez.com/us/gram');
$total_us=$page_us->filter('.display_rates')->text();
$coldeprice_us = substr($total_us,29);
$percentage = .2;
$new_total_us = ($percentage / 100) * $coldeprice_us;
$last_total_us=$coldeprice_us + $new_total_us;
$request->session()->put('priceproduct_us',$last_total_us );

///////////////////////


        $title = 'الصفحه الرئيسيه';

   $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->get();


        if (isset(Auth::guard('website')->user()->id)) {
            $anotherproducts = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
            // DB::table('user_shoping_carts')->where('created_at','>=', date("Y-m-d H:i:s", strtotime("+2 hours")))->where('client_id',Auth::guard('website')->user()->id)->delete();
        } else {
            $anotherproducts = [];
        }
        $total_price2 = 0;
        $total_price = 0;
        $clients_payments = clients_payments::groupBy('ingot_id')->selectRaw('sum(total_price) as totalpice, ingot_id')->with('Product')->get();
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
       //dd($clients_payments );

       
        return view('web.welcome', compact('products', 'title', 'anotherproducts', 'total_price2', 'total_price','clients_payments','goldPrice','egy','us'));
    } //end of index


    public function  getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);



        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
        // return redirect()->route('fakka.index');
    }


    public function about_us(Request $request)
    {
        $title = 'About Us';
        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(5);


        if (isset(Auth::guard('website')->user()->id)) {
            $anotherproducts = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
            // DB::table('user_shoping_carts')->where('created_at','>=', date("Y-m-d H:i:s", strtotime("+2 hours")))->where('client_id',Auth::guard('website')->user()->id)->delete();
        } else {
            $anotherproducts = [];
        }
        $total_price2 = 0;
        $total_price = 0;

       $abouts= AboutUs::orderBy('id', 'DESC')->first();
       $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
       
       if(empty($goldPrice)){
       $egy=1;
       $us=1;

       }else{
        $egy= $goldPrice->price_eg;
        $us=$goldPrice->price_us;
       }

       
        return view('web.about_us', compact('products', 'title', 'anotherproducts', 'total_price2', 'total_price','abouts','goldPrice','egy','us'));
    } //


    public function gold_charts(Request $request){
       
        
                $client = new Client();
            
              $page = $client->request('GET', 'http://goldpricez.com/gold/history/egp/days-30');
        
              $total=$page->filter('.tb')->text();
            
            $coldeprice = substr($total,27);
         
        
               }

}//end of controller
