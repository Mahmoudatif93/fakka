<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Product;
use App\Cart;
use App\UserShopingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Session;
use App\GoldPrice;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index(Request $request)
    {

        ////////get gold price
        $client = new Client();
        //  $page = $client->request('GET', 'https://www.xe.com/currencytables/?from=XAU&date=2020-12-29');
        $page = $client->request('GET', 'http://goldpricez.com/eg/gram');

        $total=$page->filter('.display_rates')->text();
        $percentage = .2;
      $coldeprice = substr($total,27);
      $new_total = ($percentage / 100) * $coldeprice;
      $last_total=$coldeprice + $new_total;

      $request->session()->put('priceproduct',$last_total );

        //////////
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->get();

        $title = 'Our Products';
        if(isset(Auth::guard('website')->user()->id)){
            $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
          
        }else{
            $anotherproducts =[];
        }
        $total_price2=0;
        $total_price=0;

        $Featuredproducts = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->take(8)->get();;
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.products.ourproducts', compact('egy','us','goldPrice','categories', 'products', 'title','anotherproducts','total_price2','total_price','Featuredproducts','last_total'));
    } //end of index


    public function postDate(Request $request)
    {


        $lists = $request->get('id');
        

        $categories = Category::all();

        

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->id, function ($q) use ($request) {

            return $q->whereIn('category_id', $request->id);
        })->latest()->paginate(5);

        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.products.loadproduct', compact('categories', 'products','egy','us'));
        



    }



    ////////////cart

    public function  getAddToCart(Request $request)
    {
        //dd();
        $product = Product::find($request->id);
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        $request->session()->put('cart',$cart);
        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
      // dd();
        //return redirect()->route('fakka.product.index');
    }
    public function  getReduceByOne($id,Request $request)
    {
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        session()->put('cart',$cart);
        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
        return redirect()->route('fakka.product.shoppingCart');

    }

    public function  getAddByOne($id,Request $request)
    {
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addByOne($id);
        session()->put('cart',$cart);
        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
        //return redirect()->route('fakka.product.shoppingCart');

    }




    public function  getRemoveItem($id,Request $request)
    {

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) >0){
            session()->put('cart',$cart);
        }else{
            session()->forget('cart',$cart);
        }
        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
       // return redirect()->route('fakka.product.shoppingCart');

    }

    public function  getRemoveallItem()
    {

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
       dd( $cart->removeallItem());
        if(count($cart->items) >0){
            session()->put('cart',$cart);
        }else{
            session()->forget('cart',$cart);
        }

       // return redirect()->route('fakka.product.shoppingCart');

    }



    /////////////////////////add, reduce and delete in database when make login///

    public function  addsaveone($id,Request $request)
    {
        $savedcart = UserShopingCart::find($id);

        $data['qty']=$savedcart->qty +  1;
            UserShopingCart::where('id',$id)->update($data);
        return response([
            'sessionData' => "updated"
        ]);
        //return redirect()->route('fakka.product.shoppingCart');

    }

    public function  removeonesave($id,Request $request)
    {
        $savedcart = UserShopingCart::find($id);

        $data['qty']=$savedcart->qty -  1;
            UserShopingCart::where('id',$id)->update($data);
        return response([
            'sessionData' => "updated"
        ]);
        //return redirect()->route('fakka.product.shoppingCart');

    }
    public function  removeallsave($id,Request $request)
    {

            UserShopingCart::where('id',$id)->delete();
        return response([
            'sessionData' => "deleted"
        ]);
        //return redirect()->route('fakka.product.shoppingCart');

    }

    /////////////////////////end//////////////////////

    public function  getCart()
    {
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
    $title = 'Shopping Cart';
$priceswithoutfees2=0;
$priceswithoutfees=0;
$fees2=0;
$fees=0;
        if(isset(Auth::guard('website')->user()->id)){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $cat_id=[];
            $title = 'Shopping Cart';
            $newqty=0;
           // dd($oldCart );

    if(!empty($cart->items )){


        foreach ($oldCart->items as $row) {



            $savedcart = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id,'category_id'=>$row['item']->category_id))->with('client')->with('category')->with('product')->first();


          if(!empty($savedcart)){
            $data['qty']=$savedcart->qty +  $row['qty'];
            $data['created_at']=date("Y-m-d H:i:s");
            $data['updated_at']=date("Y-m-d H:i:s");
            UserShopingCart::where('id',$savedcart->id)->update($data);
          }else{
            $request_data['client_id'] = Auth::guard('website')->user()->id ;
            $request_data['category_id'] = $row['item']->category_id ;
            $request_data['product_id'] = $row['item']->id ;
            $request_data['totalPrice'] = $cart->totalPrice ;
            $request_data['totalQty'] =$cart->totalQty ;
            $request_data['qty'] =$row['qty'] ;
            UserShopingCart::create($request_data);

          }
         // $this->getRemoveItem($row['item']->id);



        }

            foreach($cart->items as $index=>$item){
                $Qty[$index]=$item['qty'];

                $cat_id[$index]=$item['item']['category_id'];
                $savedcart = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id,'category_id'=>$item['item']['category_id']))->with('client')->with('category')->with('product')->with('ProductTranslation')->first();
                if(!empty($savedcart )){

                    $cart->items[$index]['qty']+= $savedcart->qty;

                }

            }

            $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->whereNotIn('category_id',$cat_id)->with('client')->with('category')->with('product')->with('ProductTranslation')->get();

            Session::forget('cart');
            return redirect()->route('fakka.product.shoppingCart');
            return view('web.products.shopping-cart',['title'=>$title,'products'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty,'price'=>$cart->Price,'anotherproducts'=>$anotherproducts,'totalq'=>$totalq ,'goldPrice'=>$goldPrice,
            
            'egy'=>$egy,'us'=>$us,'priceswithoutfees'=>$priceswithoutfees,'priceswithoutfees2'=>$priceswithoutfees2,'fees2'=>$fees2,'fees'=>$fees]);

        }else{

            Session::forget('cart');
            $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->whereNotIn('category_id',$cat_id)->with('client')->with('category')->with('product')->with('ProductTranslation')->get();

            $totalq=0;
           

            return view('web.products.shopping-cart',['title'=>$title,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty,'price'=>$cart->Price,'anotherproducts'=>$anotherproducts ,'totalq'=>$totalq,'goldPrice'=>$goldPrice,'egy'=>$egy,'us'=>$us
            ,'priceswithoutfees'=>$priceswithoutfees,'priceswithoutfees2'=>$priceswithoutfees2,'fees2'=>$fees2,'fees'=>$fees]);
        }





    }else{
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalq=0;
        $anotherproducts=[];
        return view('web.products.shopping-cart',['title'=>$title,'products'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty,'price'=>$cart->Price,'totalq'=>$totalq,'anotherproducts'=>$anotherproducts,'goldPrice'=>$goldPrice,'egy'=>$egy,'us'=>$us,'priceswithoutfees'=>$priceswithoutfees,
        'priceswithoutfees2'=>$priceswithoutfees2,'fees2'=>$fees2,'fees'=>$fees]);
    }

}



public function  productdetails($id,Request $request)
{

    $title="Product details";


    $product = Product::where('id',$id)->when($request->search, function ($q) use ($request) {

        return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->when($request->category_id, function ($q) use ($request) {

        return $q->where('category_id', $request->category_id);
    })->latest()->first();

    if(isset(Auth::guard('website')->user()->id)){
        $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
    }else{
        $anotherproducts =[];
    }


    $related_products=Product::where('category_id',$product->category_id)->when($request->search, function ($q) use ($request) {

        return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->when($request->category_id, function ($q) use ($request) {

        return $q->where('category_id', $request->category_id);
    })->latest()->get();


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
    return view('web.products.productsdetails',['egy'=>$egy,'us'=>$us,'title'=>$title,'product'=>$product,'anotherproducts'=>$anotherproducts,'related_products'=>$related_products,'total_price'=>$total_price,'total_price2'=>$total_price2,'goldPrice'=>$goldPrice,'egy'=>$egy,'us'=>$us]);


}




public function  getAddToCartdetails(Request $request, $id)
    {
        $product = Product::find($id);
        $quantity=$request->quantity;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->adddetails($product, $product->id,$quantity);
        $request->session()->put('cart', $cart);



        return response([
            'sessionData' => $request->session()->get('cart')
        ]);
        // return redirect()->route('fakka.index');
    }



}//end of controller
