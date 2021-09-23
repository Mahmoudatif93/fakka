<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Shippingcost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ShippingcostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Shippingcost::when($request->search, function ($q) use ($request) {

            return $q->where('shippingcost', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);

        return view('dashboard.shippingcost.index', compact('categories'));
    } //end of index

    public function create()
    {
        return view('dashboard.shippingcost.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [
            'shippingcost' => 'required',

        ];
        $request->validate($rules);

        Shippingcost::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.shippingcost.index');
    } //end of store

    public function edit($id)
    {
        $category=Shippingcost::where('id',$id)->first();

        return view('dashboard.shippingcost.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'shippingcost' => 'required',
        ];

        $request->validate($rules);
        $data['shippingcost']=$request->shippingcost;
        Shippingcost::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.shippingcost.index');
    } //end of update

    public function destroy($id)
    {
         Shippingcost::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.shippingcost.index');
    } //end of destroy

}//end of controller
