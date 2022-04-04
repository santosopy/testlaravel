<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class AdminController extends Controller
{
    public function login(Request $request){
        // echo $password = Hash::make("123456");
        if($request->isMethod("post")){
            $data = $request->all();

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
    public function updateAdminPassword(Request $request){
        if( $request->isMethod("post") ){
            $data = $request->all();
          
            if( Hash::check($data["current_password"], Auth::guard("admin")->user()->password) ){
                if( $data["new_password"] == $data["confirm_password"] ){
                    Admin::where("id", Auth::guard("admin")->user()->id)
                        ->update(
                            [
                                "password" => bcrypt($data["new_password"])
                            ]
                        );
                    return redirect()->back()->with("success_message", "change success");
                }
                else{
                    return redirect()->back()->with("error_message", "new password incorrect");
                }
            }
            else{
                return redirect()->back()->with("error_message", "current password incorrect");
            }
        }

        // echo "<pre>";
        // var_dump(); die();

        $adminDetails = Admin::where("email", Auth::guard("admin")->user()->email)->first()->toArray();
        return view("admin.settings.update-admin-password", compact("adminDetails"));
    }
    public function checkAdminPassword(Request $request){
        $data = $request->all();
        if( Hash::check($data["current_password"], Auth::guard("admin")->user()->password) ){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect("admin/login");
    }
    public function dashboard(){
        return view("admin.dashboard");
    }
}
