<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Ingots;
use App\FeesCaches;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class FeesCachesController extends Controller
{
    public function index(Request $request)
    {
        $categories = FeesCaches::with('Ingots')->when($request->search, function ($q) use ($request) {

            return $q->where('fees', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);
    
    //$feesCaches = FeesCaches::with('Ingots')->get();
   
        return view('dashboard.fees_caches.index', compact('categories'));
    } //end of index

    public function create()
    {
     
       $feesCaches = FeesCaches::get();
        foreach ($feesCaches as $fee) {
                    $data[] = $fee->ingots_id;
                }
                if(!empty( $data)){
                    $ingots = Ingots::whereNotIn('id', $data)->get();
                }else{
                    $ingots = Ingots::get();
                }
    
   
        return view('dashboard.fees_caches.create', compact('ingots'));
    } //end of create

    public function store(Request $request)
    {
        $rules = [
            'ingots_id' => 'required',
            'fees' => 'required',
            'cache_back' => 'required',

        ];
        $request->validate($rules);

        FeesCaches::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.fees_caches.index');
    } //end of store

    public function edit($id)
    {
        $category=FeesCaches::where('id',$id)->first();
       
        $ingots = Ingots::where('id',$category->ingots_id)->get();

        return view('dashboard.fees_caches.edit', compact('category','ingots'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'ingots_id' => 'required',
            'fees' => 'required|numeric',
            'cache_back' => 'required|numeric',
        ];

        $request->validate($rules);
        $data['ingots_id']=$request->ingots_id;
        $data['fees']=$request->fees;
        $data['cache_back']=$request->cache_back;
        FeesCaches::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.fees_caches.index');
    } //end of update

    public function destroy($id)
    {
        FeesCaches::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.fees_caches.index');
    } //end of destroy

}//end of controller
