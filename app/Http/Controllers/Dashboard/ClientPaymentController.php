<?php

namespace App\Http\Controllers\Dashboard;

use App\Contacts;
use App\clients_payments;
use App\OrderPayment;
use App\Orderheader;
use App\Orderdetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;
use App\ClientWallet;

class ClientPaymentController extends Controller
{
    public function index(Request $request)
    {
       /* $clients = clients_payments::where(array('status'=>0,'deleted'=>0))->when($request->search, function($q) use ($request){

            return $q->where('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('client_email', 'like', '%' . $request->search . '%')
                ->orWhere('total_price', 'like', '%' . $request->search . '%');*/

        $clients = Orderheader::with('client')->where(array('deleted'=>0,'type'=>'Sell'))->when($request->search, function($q) use ($request){
                return $q->where('total_grams', 'like', '%' . $request->search . '%')
                        ->orWhere('type', 'like', '%' . $request->search . '%')
                        ->orWhere('total_price', 'like', '%' . $request->search . '%');

        })->latest()->paginate(8);

//dd($clients);
       $orderpayment = OrderPayment::where(array('status'=>0,'deleted'=>0))->get();
        return view('dashboard.clientPayment.index', compact('clients','orderpayment'));

    }//end of index

    public function destroy(Request $request)
    {
        $deleted['deleted']=1;
        
       OrderPayment::where('id',$request->id)->update($deleted);
       clients_payments::where('orderpayment_id',$request->id)->update($deleted);
/////new
       Orderheader::where('id',$request->id)->update($deleted);
        Orderdetails::where('orderheaders_id',$request->id)->update($deleted);

        ///
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.confirmpayment.index');

    }//end of destroy


    public function approve(Request $request)
    {
        $data['status']=1;
       
        
      // OrderPayment::where('id',$request->id)->update($data);
       //clients_payments::where('orderpayment_id',$request->id)->update($data);
     /*  $post= clients_payments::where('orderpayment_id', $request->id)->first();
      
       $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' =>$post->client_email, 'status' => 1))->first();

       $Final['amount'] = ($total_amount->amount -   $post->total_price);
        ClientWallet::orderBy('id', 'DESC')->where(array('client_email' =>$post['client_email'], 'status' => 1))->update($Final);*/

//////////////new/////////////////
Orderheader::where('id',$request->id)->update($data);
//Orderdetails::where('orderheaders_id',$request->id)->update($data);
$post= Orderheader::where('id', $request->id)->first();
$total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post->client_id, 'status' => 1))->first();
$Final['amount'] = ($total_amount->amount -   $post->total_price);
ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post['client_id'], 'status' => 1))->update($Final);




//////
        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.confirmpayment.index');

    }


    
    public function disapprove(Request $request)
    {
        $data['status']=2;
       OrderPayment::where('id',$request->id)->update($data);

       clients_payments::where('orderpayment_id',$request->id)->update($data);
     /*  $post= clients_payments::where('orderpayment_id', $request->id)->first();
      
       $total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_email' =>$post->client_email, 'status' => 1))->first();

       $Final['amount'] = ($total_amount->amount -   $post->total_price);
        ClientWallet::orderBy('id', 'DESC')->where(array('client_email' =>$post['client_email'], 'status' => 1))->update($Final);*/

//////////////new/////////////////
Orderheader::where('id',$request->id)->update($data);
//Orderdetails::where('orderheaders_id',$request->id)->update($data);
$post= Orderheader::where('id', $request->id)->first();
$total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post->client_id, 'status' => 1))->first();
$Final['amount'] = ($total_amount->amount +   $post->total_price);
ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post['client_id'], 'status' => 1))->update($Final);

//////
        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.confirmpayment.index');

    }


    public function contact_mail(Request $request)
    {
        if ($this->sendResetEmail($request->email, $request->content,$request->subject) == null) {
                $error="Email has been sent to your email address.";
             return $error;
           } else {
               $error="A Network Error occurred. Please try again..";
            return $error;
            }
    }





        public function sendResetEmail($user,$content,$subject){
         $send =   Mail::send(
                'dashboard.Contacts.content',
                ['user'=>$user,'content'=>$content,'subject'=>$subject],
                function($message) use ($user,$subject){
                    $message->to($user);
                    $message->subject("$subject");

                }
            );
        }

        public function get_datiles(Request $request)
        {
            $id = $request->get('id');
           // $client_orders = clients_payments::where('orderpayment_id','=', $id)->get();
            $client_orders = Orderdetails::with('Orderheader')->where('orderheaders_id','=', $id)->get();
         //  dd($client_orders );
            
            return view('dashboard.clientPayment.loadproduct', compact('client_orders'));
        }

















}//end of controller
