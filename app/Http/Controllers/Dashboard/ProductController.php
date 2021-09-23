<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use App\Ingots;
use App\Coins;
use App\FeesCaches;
use App\FeesCoins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(8);

        // dd();

        return view('dashboard.products.index', compact('categories', 'products'));
    } //end of index

    public function create()
    {
        $ingots = Ingots::get();
        $coins= Coins::get();
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories','ingots','coins'));
    } //end of create

    public function store(Request $request)
    {

    

        $rules = [
            'category_id' => 'required',
            'number_grams' => 'required',
            'thickness' => 'required',
            'karat' => 'required',
            'weight' => 'required',
            'manufacturer' => 'required',
            'design' => 'required',
            'diameter' => '',
            'fees'=>'required',
            'cashs'=>'required',
            'height' => 'required',
            'width'=>'required',
            'depth'=>'required',



        ];

        foreach (config('translatable.locales') as $locale) {

            // $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.description' => 'required'];
        } //end of  for each

        /* $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];*/

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of if

        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of store

    public function edit($id)
    {
        $ingots = Ingots::get();
        $coins= Coins::get();
        $categories = Category::all();
         $product=Product::where('id',$id)->with('ProductTranslation')->first();
   //   dd($product);
        return view('dashboard.products.edit', compact('categories', 'product','ingots','coins'));
    } //end of edit

    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required',
            'number_grams' => 'required',
            'thickness' => 'required',
            'karat' => 'required',
            'weight' => 'required',
            'manufacturer' => 'required',
            'design' => 'required',
            'diameter' => '',
            'fees'=>'required',
            'cashs'=>'required',
            'height' => 'required',
            'width'=>'required',
            'depth'=>'required',
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => 'required'];
        } //end of  for each

        /* $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];*/

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            } //end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of if

        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of update

    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        } //end of if

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of destroy


    public function getfeeschach(Request $request){

        
        foreach($request->results as $ingot){
            $fees=FeesCaches::where('ingots_id',$ingot)->first();
        
            if(!empty($fees)){
                return($fees);
            }else{
                echo('false');
            }
        }
    }


    public function getfeescoins(Request $request){

        
        foreach($request->results as $ingot){
            $fees=FeesCoins::where('coins_id',$ingot)->first();
        
            if(!empty($fees)){
                return($fees);
            }else{
                echo('false');
            }
        }
    }
}//end of controller
