<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\GoldPrice;
class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'terms and conditions';
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        $anotherproducts=[];
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.termscondtions', compact('title','anotherproducts','goldPrice','egy','us'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function policy()
    {
        $title = 'Privacy policy';

        $anotherproducts=[];
        $goldPrice =GoldPrice::orderBy('id', 'DESC')->first();
        if(empty($goldPrice)){
            $egy=1;
            $us=1;
     
            }else{
             $egy= $goldPrice->price_eg;
             $us=$goldPrice->price_us;
            }
        return view('web.privacy_policy', compact('title','anotherproducts','egy','us'));
    }
}
