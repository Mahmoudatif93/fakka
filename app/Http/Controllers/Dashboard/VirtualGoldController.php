<?php

namespace App\Http\Controllers\Dashboard;

use App\Contacts;
use App\clients_payments;
use App\OrderPayment;
use App\VirtualDetails;
use App\ClientWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;
use App\Orderheader;
use App\Orderdetails;
class VirtualGoldController extends Controller
{
    public function index(Request $request)
    {
       /* $clients = VirtualDetails::where(array('paid' => 1, 'status' => 0,'deleted'=>0))->when($request->search, function ($q) use ($request) {

            return $q->where('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('Phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);*/

        $clients = Orderheader::with('client')->where(array('deleted'=>0,'type'=>'virtual'))->when($request->search, function($q) use ($request){
            return $q->where('total_grams', 'like', '%' . $request->search . '%')
                    ->orWhere('type', 'like', '%' . $request->search . '%')
                    ->orWhere('total_price', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);


        $orderpayment = Orderheader::with('client')->with('Orderdetails')->where(array('deleted'=>0,'type'=>'virtual'))->get();
      // dd($orderpayment);
        return view('dashboard.virtual gold.index', compact('clients', 'orderpayment'));
    } //end of index

    public function destroy(Request $request)
    {
        $deleted['deleted']=1;

        VirtualDetails::where('id', $request->id)->update($deleted);

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.virtual_gold.index');
    } //end of destroy


    public function approve(Request $request)
    {
        $data['status']=1;
       /* VirtualDetails::where('id', $request->id)->update($data);
       $post= VirtualDetails::where('id', $request->id)->first();
*/

Orderheader::where('id',$request->id)->update($data);
//Orderdetails::where('orderheaders_id',$request->id)->update($data);
$post= Orderheader::where('id', $request->id)->first();
$total_amount = ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post->client_id, 'status' => 1))->first();
$Final['amount'] = ($total_amount->amount -   $post->total_price);
ClientWallet::orderBy('id', 'DESC')->where(array('client_id' =>$post['client_id'], 'status' => 1))->update($Final);

        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.virtual_gold.index');
    } //end of destroy

    public function contact_mail(Request $request)
    {
        if ($this->sendResetEmail($request->email, $request->content, $request->subject) == null) {
            $error = "Email has been sent to your email address.";
            return $error;
        } else {
            $error = "A Network Error occurred. Please try again..";
            return $error;
        }
    }





    public function sendResetEmail($user, $content, $subject)
    {
        $send =   Mail::send(
            'dashboard.Contacts.content',
            ['user' => $user, 'content' => $content, 'subject' => $subject],
            function ($message) use ($user, $subject) {
                $message->to($user);
                $message->subject("$subject");
            }
        );
    }
}//end of controller
