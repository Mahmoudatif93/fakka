<?php

namespace App\Http\Controllers\Dashboard;

use App\Contacts;
use App\clients_payments;
use App\OrderPayment;
use App\VirtualDetails;
use App\ClientWallet;
use App\ClientsWithdrowHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\ShippingIngots;
use App\virtualBalancesGold;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;

class ShippingApprovalController extends Controller
{
    public function index(Request $request)
    {
        $clients = ShippingIngots::where(array('status' => 0))->when($request->search, function ($q) use ($request) {

            return $q->where('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('client_phone', 'like', '%' . $request->search . '%')
                ->orWhere('client_email', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);

        $orderpayment = ShippingIngots::where(array('status' => 0))->get();
       // dd($orderpayment);
        return view('dashboard.shippingingots.index', compact('clients', 'orderpayment'));
    } //end of index

    public function destroy(Request $request)
    {

        ShippingIngots::where('id', $request->id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.shippingingots.index');
    } //end of destroy


    public function approve(Request $request)
    {
       $data['status'] = 1;
       ShippingIngots::where('id', $request->id)->update($data);
        $shippingdata=ShippingIngots::where('id', $request->id)->first();
    $total_amount=virtualBalancesGold::where(array('id'=>$shippingdata->amount_id))->delete();
        session()->flash('success', __('site.confirmed_successfully'));
        return redirect()->route('dashboard.shippingingots.index');
    }

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
