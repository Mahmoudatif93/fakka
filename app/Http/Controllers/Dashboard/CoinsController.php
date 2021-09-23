<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Coins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CoinsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Coins::when($request->search, function ($q) use ($request) {

            return $q->where('coins', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);

        return view('dashboard.coins.index', compact('categories'));
    } //end of index

    public function create()
    {
        return view('dashboard.coins.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [
            'coins' => 'required|numeric',

        ];
        $request->validate($rules);

        Coins::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.coins.index');
    } //end of store

    public function edit($id)
    {
        $category=Coins::where('id',$id)->first();

        return view('dashboard.coins.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'coins' => 'required|numeric',
        ];

        $request->validate($rules);
        $data['coins']=$request->coins;
        Coins::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.coins.index');
    } //end of update

    public function destroy($id)
    {
        Coins::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.coins.index');
    } //end of destroy

}//end of controller
