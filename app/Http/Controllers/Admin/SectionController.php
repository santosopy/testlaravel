<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function sections(){
        $sections = Section::get()->toArray();

        return view("admin.sections.sections")->with(compact("sections"));
    }

    public function updateSectionStatus(Request $request){
        if( $request->ajax() ){
            $data = $request->all();
            $status = ( $data["status"] == 1 ) ? 0 : 1;
            Section::where("id", $data["id"])
                ->update(["status"=> $status]);
            return response()->json([
                "status" => $status,
                "id" => $data["id"]
            ]);
        }
    }
}
