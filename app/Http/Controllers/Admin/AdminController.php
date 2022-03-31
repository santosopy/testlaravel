<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function login(Request $request){
        // echo $password = Hash::make("123456");
        if($request->isMethod("post")){
            $data = $request->all();

            // echo "<pre>";
            // var_dump($data);
            // die();
           
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
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect("admin/login");
    }
    public function dashboard(){
        return view("admin.dashboard");
    }
}
