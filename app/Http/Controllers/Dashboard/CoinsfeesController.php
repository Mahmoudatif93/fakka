<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Coins;
use App\FeesCoins;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CoinsfeesController extends Controller
{
    public function index(Request $request)
    {
        $categories = FeesCoins::with('Coins')->when($request->search, function ($q) use ($request) {

            return $q->where('fees', 'like', '%' . $request->search . '%')
            ->orWhere('cache_back', 'like', '%' . $request->search . '%');
            

    })->latest()->paginate(8);
    $feesCaches = FeesCoins::with('Coins')->get();
   
        return view('dashboard.fees_coins.index', compact('categories','feesCaches'));
    } //end of index

    public function create()
    {
     
       $feesCaches = FeesCoins::get();
        foreach ($feesCaches as $fee) {
                    $data[] = $fee->coins_id;
                }
                if(!empty( $data)){
                    $ingots = Coins::whereNotIn('id', $data)->get();
                }else{
                    $ingots = Coins::get();
                }
    
   
        return view('dashboard.fees_coins.create', compact('ingots'));
    } //end of create

    public function store(Request $request)
    {
        $rules = [
            'coins_id' => 'required',
            'fees' => 'required',
            'cache_back' => 'required',

        ];
        $request->validate($rules);

        FeesCoins::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.coins_fees.index');
    } //end of store

    public function edit($id)
    {
        $category=FeesCoins::where('id',$id)->first();
       
        $ingots = Coins::where('id',$category->coins_id)->get();

        return view('dashboard.fees_coins.edit', compact('category','ingots'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'coins_id' => 'required',
            'fees' => 'required|numeric',
            'cache_back' => 'required|numeric',
        ];

        $request->validate($rules);
        $data['coins_id']=$request->coins_id;
        $data['fees']=$request->fees;
        $data['cache_back']=$request->cache_back;
        FeesCoins::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.coins_fees.index');
    } //end of update

    public function destroy($id)
    {
        FeesCoins::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.coins_fees.index');
    } //end of destroy

}//end of controller
