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

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $clients = ClientWallet::where(array('status' => 0,'deleted'=>0))->when($request->search, function ($q) use ($request) {

            return $q->where('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('client_phone', 'like', '%' . $request->search . '%')
                ->orWhere('client_email', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);

        $orderpayment = ClientWallet::where(array('status' => 0,'deleted'=>0))->get();
       // dd($orderpayment);
        return view('dashboard.wallet.index', compact('clients', 'orderpayment'));
    } //end of index

    public function destroy(Request $request)
    {
        $deleted['deleted']=1;
        ClientWallet::where('id', $request->id)->update($deleted);

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.wallet.index');
    } //end of destroy


    public function approve(Request $request)
    {
        $data['status'] = 1;
        ClientWallet::where('id', $request->id)->update($data);

        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.wallet.index');
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
