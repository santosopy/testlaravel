<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords =[
            "id"=> 1,
            "vendor_id"=> 1,
            "shop_name"=> "john eletrics store",
            "shop_address"=> "1234-scf",
            "shop_city"=> "new delhi",
            "shop_state"=> "delhi",
            "shop_country"=> "india",
            "shop_pincode"=> "110001",
            "shop_mobile"=> "97000",
            "shop_website"=> "sitemakers.in",
            "shop_email"=> "john@admin.com",
            "address_proof"=> "passport",
            "address_proof_image"=> "test.jpg",
            "business_license_number"=> "12345612",
            "gst_number"=> "443644464",
            "pan_number"=> "2422453"
        ];
        
        VendorsBusinessDetail::insert($vendorRecords);
    }
}
