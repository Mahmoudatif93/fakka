<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use App\GoldPrice;
use App\clients_payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {


        //dd('dashboared');
        //dd(auth()->user()->first_name.' '.auth()->user()->last_name);
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();
        //extract(month from "created_at") as month
        $latestclients = Client::orderBy('id', 'DESC')->take(5)->get();

        /*$sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();*/


        $sales_data = Order::select(

            DB::raw('extract(YEAR from "created_at") as year'),
            DB::raw('extract(month from "created_at") as month'),
            DB::raw('SUM((total_price)) as sum')
        )->groupBy('created_at')->get();

       

       /* $goldprices = GoldPrice::select('price_eg','id',

         
           DB::raw('extract(month from "created_at") as month')
        )->latest('month')->distinct('month')->get();

        */
        //$revenueMonth =  GoldPrice::select('created_at','price_eg')->max('price_eg')->min('price_eg')->orderBy('created_at')->whereMonth('created_at', Carbon::now()->month)->distinct('day');
        //$revenueMonth = DB::table('gold_prices')->max('price_eg')->all();
        
     
       
      /* $revenueMonth = GoldPrice::select('created_at','price_eg')->max('price_eg')->min('price_eg')
        
        ->groupBy('created_at')->get();*/

      //$revenueMonth =DB::select('select created_at::Date ,MAX(price_eg) as mx, MIN(price_eg) as mn , from gold_prices   GROUP BY created_at::Date order by created_at::Date');


      $revenueMonth =DB::select(' select created_at::Date,
        MAX(price_eg) as mx, MIN(price_eg) as mn,
        (select price_eg from public.gold_prices where created_at::Date = created_at::Date order by created_at limit 1) as opn,
        (select price_eg from public.gold_prices where created_at::Date = created_at::Date order by created_at desc limit 1) as cls
        from
        public.gold_prices
        GROUP BY created_at::Date
        order by created_at::Date');
      /*

        $revenueMonth = \DB::table('gold_prices')
        ->select('gold_prices.created_at', \DB::raw("MAX(gold_prices.price_eg) AS max_price"), \DB::raw("MIN(gold_prices.price_eg) AS min_price"))
    
        ->distinct('created_at')
        ->groupBy('gold_prices.created_at')
        
        ->get();*/
     // dd($revenueMonth);

     //json_encode($revenueMonth);
   // dd( json_encode($revenueMonth));
        $client_orders = clients_payments::orderBy('id', 'DESC')->take(5)->get();

        return view('dashboard.welcome', compact('categories_count', 'products_count', 'clients_count', 'users_count', 'sales_data','latestclients','client_orders','revenueMonth'));
    } //end of index



    public function chart(){
       

        $revenueMonth =DB::select('select created_at::Date,
        MAX(price_eg) as mx, MIN(price_eg) as mn,
        (select price_eg from public.gold_prices where created_at::Date = created_at::Date order by created_at limit 1) as opn,
        (select price_eg from public.gold_prices where created_at::Date = created_at::Date order by created_at desc limit 1) as cls,
        created_at::Date
        from
        public.gold_prices
        GROUP BY created_at::Date
        order by created_at::Date');
        
       


        
        return  json_encode(array_values($revenueMonth));


    }

}//end of controller
