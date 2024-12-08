<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CMSPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPagesRecords = [
            ['id'=>1, 'title'=>'About Us', 'description'=>'Content Coming Soon.', 'url'=>'about-us', 'meta_title'=>'About Us', 'meta_description'=>'About Us Content', 'meta_keywords'=>'about us, about', 'status'=>1],
            ['id'=>2, 'title'=>'Terms and Conditions', 'description'=>'Content Coming Soon.', 'url'=>'terms-conditions', 'meta_title'=>'Terms and Conditions', 'meta_description'=>'Terms and Conditions Content', 'meta_keywords'=>'terms, conditions', 'status'=>1],
            ['id'=>3, 'title'=>'Privacy Policies', 'description'=>'Content Coming Soon.', 'url'=>'privacy-policies', 'meta_title'=>'Privacy Policies', 'meta_description'=>'Privacy Policies Content', 'meta_keywords'=>'privacy, privacy policies', 'status'=>1],
        ];
        CMSPage::insert($cmsPagesRecords);
    }
}
