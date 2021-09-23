<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' =>-1 ,
            'category_id' => -1,
            'number_grams' =>0,
            'thickness' =>0,
            'karat' =>0,
            'weight' =>0,
            'manufacturer' =>0,
            'design' =>0,
            'height' =>0,
            'width' =>0,
            'depth' =>0,
        ]);
    }
}
