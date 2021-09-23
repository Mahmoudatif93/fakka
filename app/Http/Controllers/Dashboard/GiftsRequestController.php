<?php

namespace App\Http\Controllers\Dashboard;

use App\Contacts;
use App\clients_payments;
use App\OrderPayment;
use App\VirtualDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;
use App\ClientGifts;
use App\clientsPoints;


class GiftsRequestController extends Controller
{
    public function index(Request $request)
    {
        $clients = ClientGifts::when($request->search, function ($q) use ($request) {

            return $q->where('gift_id', 'like', '%' . $request->search . '%');
      
        })->latest()->paginate(8);

        $orderpayment =  ClientGifts::where('approved',0)->with('Gifts')->get();
       //dd($orderpayment);
        return view('dashboard.giftsrequest.index', compact('clients', 'orderpayment'));
    } //end of index

    public function destroy(Request $request)
    {
    
  
        ClientGifts::where('id', $request->id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.giftsrequest.index');
    } //end of destroy


    public function approve(Request $request)
    {
       
       $email =ClientGifts::where(array('id'=>$request->id,'approved'=>0))->with('Gifts')->first();
  
      $points=  clientsPoints::orderBy('id', 'DESC')->where(array('client_email' =>$email->client_email))->first();

      $data2['totalpoints']= $points->totalpoints - $email->Gifts->gift_points ;
      clientsPoints::where(array('client_email' =>$email->client_email))->update($data2);
      $data['approved'] = 1;
      ClientGifts::where('id', $request->id)->update($data);
        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.giftsrequest.index');
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
