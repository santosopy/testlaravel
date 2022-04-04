<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id'=> 1,
                'name'=> 'john',
                'adress'=> 'cp-112',
                'city'=> "new delhi",
                'state country'=> 'delhi india',
                'pincode'=> '101111',
                'mobile'=> '9700000',
                'email'=> 'john@admin.com',
                'status'=> 0,
            ]
        ];
        Vendor::insert($vendorRecords);
    }
}
