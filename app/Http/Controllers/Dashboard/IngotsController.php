<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Ingots;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class IngotsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Ingots::when($request->search, function ($q) use ($request) {

            return $q->where('ingots', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);

        return view('dashboard.ingots.index', compact('categories'));
    } //end of index

    public function create()
    {
        return view('dashboard.ingots.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [
            'ingots' => 'required|numeric',

        ];
        $request->validate($rules);

        Ingots::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.ingots.index');
    } //end of store

    public function edit($id)
    {
        $category=Ingots::where('id',$id)->first();

        return view('dashboard.ingots.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'ingots' => 'required|numeric',
        ];

        $request->validate($rules);
        $data['ingots']=$request->ingots;
        Ingots::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.ingots.index');
    } //end of update

    public function destroy($id)
    {
        Ingots::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.ingots.index');
    } //end of destroy

}//end of controller
