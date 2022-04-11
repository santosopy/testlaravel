<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Vendor;
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
            $imageName = "";
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
    public function updateVendorDetails($slug, Request $request){
        if( $slug=="personal" ){
            if( $request->isMethod("post") ){
                $rules = [
                    "vendor_name" => "required|regex:/^[\pL\s\-]+$/u",
                    "vendor_mobile" => "required|numeric",
                ];
                $customMessages = [
                    "vendor_name.required" => "name is required",
                    "vendor_name.regex" => "name is not valid",
                    "vendor_mobile.required" => "mobile is required",
                    "vendor_mobile.numeric" => "mobile is not valid",
                ];
                $this->validate($request, $rules, $customMessages);
    
                $data = $request->all();
    
                // composer require intervention/image
                $imageName = "";
                if( $request->hasFile("vendor_image") ){
                    $image_tmp = $request->file("vendor_image");
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
                        "name" => $data["vendor_name"],
                        "mobile" => $data["vendor_mobile"],
                        "image" => $imageName,
                    ]);
                Vendor::where("id", Auth::guard("admin")->user()->vendor_id)
                    ->update([
                        "name" => $data["vendor_name"],
                        "adress" => $data["vendor_address"],
                        "city" => $data["vendor_city"],
                        "state country" => $data["vendor_state_country"],
                        "pincode" => $data["vendor_pincode"],
                        "mobile" => $data["vendor_mobile"],
                    ]);
                return redirect()->back()->with("success_message", "detail updated");
                
            }
            $vendorDetails = Vendor::where("id", Auth::guard("admin")->user()->vendor_id)->first()->toArray();
        }
        else if( $slug=="business" ){
            
        }
        else if( $slug=="bank" ){
            
        }
        return view("admin.settings.update_vendor_details")
                ->with(compact("slug", "vendorDetails"));
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
    public function admins($type=null){
        $admins = Admin::query();

        if( !empty($type) ){
            $admins = $admins->where("type", $type);
            $title = ucfirst($type)."s";
        }
        else{
            $title = "All Admin Vendor";
        }
        $admins = $admins->get()->toArray();
        // echo "<pre>";
        // var_dump($admins); die;
        return view("admin.admins.admins")->with(compact("admins","title"));
    }
    public function adminsVendorDetails($id){
        $vendorDetails = Admin::with("vendorPersonal", "BusinessPersonal", "BankPersonal")->where("id", $id)->first();
        $vendorDetails = json_decode($vendorDetails,true);
        // dump($vendorDetails);
        return view("admin.admins.vendorDetails")->with(compact("vendorDetails"));
    }
    public function updateAdminStatus(Request $request){
        $status = ($request->status ==1) ? 0 : 1;
        Admin::where("id", $request->id)
            ->update([
                "status"=> $status
            ]);
    }
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect("admin/login");
    }
    public function dashboard(){
        return view("admin.dashboard");
    }
}
