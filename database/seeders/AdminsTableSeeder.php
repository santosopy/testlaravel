<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
                'id'=> 1,
                'name'=> 'Super Admin',
                'type'=> 'superadmin',
                'vendor_id'=> 0,
                'mobile'=> '0123456',
                'email'=> 'admin@admin.com',
                'password'=> '2a$12$I.TsdldV4MDhOEEwuUadq.0DCf5UQzNuBg2WOpUM6kj3GaEq6zxSW',
                'image'=> '',
                'status'=> 1,
            ]
        ];
        Admin::insert($adminRecords);
    }
}
