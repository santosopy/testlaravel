<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class AdminController extends Controller
{
    public function login(Request $request){
        // echo $password = Hash::make("123456");
        if($request->isMethod("post")){
            $data = $request->all();

            // echo "<pre>";
            // var_dump($data);
            // die();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                "email.required" => "email is required",
                "password.required" => "password is required!!"
            ];
            
            $this->validate($request,$rules,$customMessages);

            if(Auth::guard("admin")->attempt(
                [
                    "email" => $data["email"],
                    "password" => $data["password"],
                    "status" => 1
                ]
            )){
                return redirect("admin/dashboard");
            }
            else{
                return redirect()->back()->with("error_message", "wrong email and password");
            }
        }
        return view("admin.login");
    }
    public function updateAdminPassword(){
        $adminDetails = Admin::where("email", Auth::guard("admin")->user()->email)->first()->toArray();
        // echo "<pre>";
        // var_dump(Auth::guard("admin")->user()->email); die();
        return view("admin.settings.update-admin-password", compact("adminDetails"));
    }
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect("admin/login");
    }
    public function dashboard(){
        return view("admin.dashboard");
    }
}
