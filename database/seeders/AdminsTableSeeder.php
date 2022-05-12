<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

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
                'name'=> 'admin',
                'type'=> 'admin',
                'vendor_id'=> 0,
                'mobile'=> '970000000',
                'email'=> 'admin@admin.com',
                'password'=> Hash::make("123456"),
                'image'=> '',
                'status'=> 1,
            ],
            [
                'id'=> 2,
                'name'=> 'john',
                'type'=> 'vendor',
                'vendor_id'=> 1,
                'mobile'=> '970000000',
                'email'=> 'john@admin.com',
                'password'=> Hash::make("123456"),
                'image'=> '',
                'status'=> 1,
            ]
        ];
        foreach ($adminRecords as $key => $value) {
            Admin::insert($value);
        }
    }
}
