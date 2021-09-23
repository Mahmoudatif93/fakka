<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\ContactsEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ContactsinfoController extends Controller
{
    public function index(Request $request)
    {
        $categories = ContactsEmail::when($request->search, function ($q) use ($request) {

            return $q->where('email', 'like', '%' . $request->search . '%');

    })->latest()->paginate(8);
   /* $key = ContactsEmail::first();
    $email=$key->email;
    $path = base_path('.env');
//dd( env("MAIL_USERNAME"));

if (file_exists($path)) {
    file_put_contents($path, str_replace(
        'MAIL_USERNAME='.$this->laravel['config']['mail.MAIL_USERNAME'], 'MAIL_USERNAME='.$email, file_get_contents($path)
    ));
}*/
$key = ContactsEmail::first();
$password=$key->password;
    $email=$key->email;
    /*
$env_update = $this->changeEnv([
   // 'MAIL_FROM_NAME' => $input['MAIL_FROM_NAME'],
    //'MAIL_FROM_ADDRESS' => $input['MAIL_FROM_ADDRESS'],
   // 'MAIL_DRIVER' => $input['MAIL_DRIVER'],
    //'MAIL_HOST' => $input['MAIL_HOST'],
    //'MAIL_PORT' => $input['MAIL_PORT'],
    'MAIL_USERNAME'=> $email,
    'MAIL_PASSWORD'=>  $password,
    //'MAIL_ENCRYPTION'=> $input['MAIL_ENCRYPTION']
  ]);*/


  /*$_ENV['MAIL_USERNAME'] =  'theleagand';
  $_ENV['Mahmoudatif93*'] =  'mm@m.com';
  dd( env("MAIL_USERNAME"));*/
  $key = ContactsEmail::first();
  $password=$key->password;
      $email=$key->email;
  $env_update = $this->changeEnv([
    'MAIL_FROM_NAME' => $email,
    'MAIL_FROM_ADDRESS' =>  $email,
    'MAIL_USERNAME'=> $email,
    'MAIL_PASSWORD'=> $password,
  ]);

  if($env_update)
  {
    return back()->with('updated', 'Mail settings has been saved');
  }
  else
  {
    return back()->with('deleted', 'Mail settings could not be saved');
  }
     //   return view('dashboard.contacts_info.index', compact('categories'));
    } //end of index
  


    protected function changeEnv($data = array())
        {
            if ( count($data) > 0 ) {
    
                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');
    
                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);;
    
                // Loop through given data
                foreach((array)$data as $key => $value){
                  // Loop through .env-data
                  foreach($env as $env_key => $env_value){
                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);
    
                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                  }
                }
    
                // Turn the array back to an String
                $env = implode("\n\n", $env);
    
                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);
    
                return true;
    
            } else {
    
              return false;
            }
        }












    public function create()
    {
        return view('dashboard.contacts_info.create');
    } //end of create




    public function store(Request $request)
    {
        $rules = [
            'mobile' =>'required|numeric',
            'email' => 'required',
            'password' => 'required',
        ];
        $request->validate($rules);

        $request_data = $request->all();
        

        ContactsEmail::create($request_data );
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.contacts_info.index');
    } //end of store

    public function edit($id)
    {
        $category=ContactsEmail::where('id',$id)->first();

        return view('dashboard.contacts_info.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'mobile' =>'required|numeric',
            'email' => 'required',
            'password' => 'required',
        ];
        $request->validate($rules);


        $data['mobile']=$request->mobile;
        $data['email']=$request->email;
        $data['password']=$request->password;
        ContactsEmail::where('id',$id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.contacts_info.index');
    } //end of update

    public function destroy($id)
    {
        ContactsEmail::where('id',$id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.contacts_info.index');
    } //end of destroy

}//end of controller
