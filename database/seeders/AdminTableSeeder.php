<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            ['id'=>2, 'name'=>'Zein', 'type'=>'subadmin', 'mobile'=>'09916189152', 'email'=>'zein.reyes2005@gmail.com', 'password'=>$password, 'image'=>'', 'status'=>1],
            ['id'=>3, 'name'=>'Iara', 'type'=>'subadmin', 'mobile'=>'09398678182', 'email'=>'ayrareateran@gmail.com', 'password'=>$password, 'image'=>'', 'status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
