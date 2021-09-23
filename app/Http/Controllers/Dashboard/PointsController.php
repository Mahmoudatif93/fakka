<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\PointsPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PointsController extends Controller
{
    public function index(Request $request)
    {
        $categories = PointsPrice::when($request->search, function ($q) use ($request) {

            return $q->where('point_added', 'like', '%' . $request->search . '%')
                   ->orWhere('point_dedicated', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);

        return view('dashboard.points.index', compact('categories'));
    } //end of index

    public function create()
    {
        return view('dashboard.points.create');
    } //end of create




    public function store(Request $request)
    {
        $rules = [
            'point_added' =>'required|numeric',
            'point_dedicated' => 'required|numeric',

        ];
        $request->validate($rules);

        PointsPrice::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.points.index');
    } //end of store

    public function edit($id)
    {
        $category=PointsPrice::where('id',$id)->first();

        return view('dashboard.points.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'point_added' =>'required|numeric',
            'point_dedicated' => 'required|numeric',
        ];

        $request->validate($rules);
        $data['point_added']=$request->point_added;
        $data['point_dedicated']=$request->point_dedicated;
        PointsPrice::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.points.index');
    } //end of update

    public function destroy($id)
    {
        PointsPrice::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.points.index');
    } //end of destroy

}//end of controller
