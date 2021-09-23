<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UsersTableSeeder::class);
       // $this->call(CategoryTableSeeder::class);
        //$this->call(ProductTableSeeder::class);
        DB::table('categories')->insert([
            'id' =>-1 , 
        ]);

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
