<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@shopx.com',
            'password' => Hash::make('password'),
            'phone' => '123-456-7890',
            'address' => '123 Admin Street, Admin City, AC 12345',
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Smartphones',
                'description' => 'Latest smartphones from top brands',
            ],
            [
                'name' => 'Laptops',
                'description' => 'High-performance laptops for work and gaming',
            ],
            [
                'name' => 'Tablets',
                'description' => 'Portable tablets for productivity and entertainment',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Essential accessories for your electronic devices',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            [
                'name' => 'iPhone 14 Pro',
                'description' => 'The latest iPhone with A16 Bionic chip, 48MP camera, and Dynamic Island.',
                'price' => 999.99,
                'stock' => 50,
                'category_id' => 1,
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'description' => 'Flagship Samsung smartphone with S Pen, 200MP camera, and Snapdragon 8 Gen 2.',
                'price' => 1199.99,
                'stock' => 40,
                'category_id' => 1,
            ],
            [
                'name' => 'Google Pixel 7 Pro',
                'description' => 'Google\'s premium smartphone with Tensor G2 chip and advanced camera features.',
                'price' => 899.99,
                'stock' => 30,
                'category_id' => 1,
            ],
            [
                'name' => 'MacBook Pro 16"',
                'description' => 'Powerful laptop with M2 Pro/Max chip, Liquid Retina XDR display, and up to 96GB RAM.',
                'price' => 2499.99,
                'stock' => 20,
                'category_id' => 2,
            ],
            [
                'name' => 'Dell XPS 15',
                'description' => 'Premium Windows laptop with Intel Core i9, NVIDIA RTX graphics, and 4K OLED display.',
                'price' => 1999.99,
                'stock' => 25,
                'category_id' => 2,
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'description' => 'Compact gaming laptop with AMD Ryzen 9, NVIDIA RTX graphics, and 14" QHD display.',
                'price' => 1699.99,
                'stock' => 15,
                'category_id' => 2,
            ],
            [
                'name' => 'iPad Pro 12.9"',
                'description' => 'Apple\'s most powerful tablet with M2 chip, Liquid Retina XDR display, and Thunderbolt.',
                'price' => 1099.99,
                'stock' => 35,
                'category_id' => 3,
            ],
            [
                'name' => 'Samsung Galaxy Tab S8 Ultra',
                'description' => 'Premium Android tablet with 14.6" AMOLED display, S Pen, and Snapdragon 8 Gen 1.',
                'price' => 899.99,
                'stock' => 30,
                'category_id' => 3,
            ],
            [
                'name' => 'AirPods Pro 2',
                'description' => 'Wireless earbuds with active noise cancellation, spatial audio, and adaptive transparency.',
                'price' => 249.99,
                'stock' => 100,
                'category_id' => 4,
            ],
            [
                'name' => 'Samsung Galaxy Watch 5 Pro',
                'description' => 'Advanced smartwatch with sapphire crystal display, titanium case, and health tracking.',
                'price' => 449.99,
                'stock' => 60,
                'category_id' => 4,
            ],
            [
                'name' => 'Anker 737 Power Bank',
                'description' => '24,000mAh power bank with 140W output, digital display, and multiple ports.',
                'price' => 149.99,
                'stock' => 80,
                'category_id' => 4,
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Premium wireless headphones with industry-leading noise cancellation and 30-hour battery life.',
                'price' => 399.99,
                'stock' => 45,
                'category_id' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
