<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
               ["product_name" => "Pepsi", "price" => 2.5, "qty" => "100", "discount" => "20"],
               ["product_name" => "Coca",  "price" => 19,  "qty" => "150", "discount" => "5"],
               ["product_name" => "Sting", "price" => 10,  "qty" => "200", "discount" => "10"],
        ];
        
        foreach ($products as $product){
            Product::create($product);
        }

    }
}
