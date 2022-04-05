<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            "id"=> 1,
            "vendor_id"=> 1,
            "account_holder_name"=> "john",
            "bank_name"=> "ICICIC",
            "account_number"=> "0234345",
            "bank_ifsc_code"=> "24353535"
        ];

        VendorsBankDetail::insert($vendorRecords);
    }
}
