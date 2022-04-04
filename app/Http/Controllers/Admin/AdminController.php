<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Image;
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

        $adminDetails = Admin::where("email", Auth::guard("admin")->user()->email)->first()->toArray();
        return view("admin.settings.update_admin_password", compact("adminDetails"));
    }
    public function updateAdminDetails(Request $request){
        if( $request->isMethod("post") ){
            $rules = [
                "admin_name" => "required|regex:/^[\pL\s\-]+$/u",
                "admin_mobile" => "required|numeric",
            ];
            $customMessages = [
                "admin_name.required" => "name is required",
                "admin_name.regex" => "name is not valid",
                "admin_mobile.required" => "mobile is required",
                "admin_mobile.numeric" => "mobile is not valid",
            ];
            $this->validate($request, $rules, $customMessages);

            $data = $request->all();

            // composer require intervention/image
            if( $request->hasFile("admin_image") ){
                $image_tmp = $request->file("admin_image");
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).".".$extension;
                    $imagePath = "admin/images/photos/".$imageName;
                    Image::make($image_tmp)->save($imagePath);
                    // echo "<pre>";
                    // var_dump($image_tmp); die(); 
                }
            }

            Admin::where("id", Auth::guard("admin")->user()->id)
                ->update([
                    "name" => $data["admin_name"],
                    "mobile" => $data["admin_mobile"],
                    "image" => $imageName,
                ]);
            return redirect()->back()->with("success_message", "detail updated");
            
        }
        return view("admin.settings.update_admin_details");
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
