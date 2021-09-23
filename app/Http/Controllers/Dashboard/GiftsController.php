<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Gifts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GiftsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Gifts::when($request->search, function ($q) use ($request) {

            return $q->where('gift_name', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);

        return view('dashboard.gifts.index', compact('categories'));
    } //end of index

    public function create()
    {
        return view('dashboard.gifts.create');
    } //end of create




    public function store(Request $request)
    {
        $rules = [
            'gift_points' =>'required|numeric',
            'gift_name' => 'required',

        ];
        $request->validate($rules);

        $request_data = $request->all();
        if ($request->gift_image) {

            Image::make($request->gift_image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/gifts/' . $request->gift_image->hashName()));

            $request_data['gift_image'] = $request->gift_image->hashName();
        } //end of if


        Gifts::create($request_data );
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.gifts.index');
    } //end of store

    public function edit($id)
    {
        $category=Gifts::where('id',$id)->first();

        return view('dashboard.gifts.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'gift_points' =>'required|numeric',
            'gift_name' => 'required',
        ];
        $request->validate($rules);

        if ($request->gift_image) {

            Image::make($request->gift_image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/gifts/' . $request->gift_image->hashName()));

            $data['gift_image'] = $request->gift_image->hashName();
        } //end of if



        $data['gift_points']=$request->gift_points;
        $data['gift_name']=$request->gift_name;
        Gifts::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.gifts.index');
    } //end of update

    public function destroy($id)
    {
        Gifts::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.gifts.index');
    } //end of destroy

}//end of controller
