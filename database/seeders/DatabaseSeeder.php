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
                'image' => 'https://www.macworld.com/wp-content/uploads/2023/01/iphone-14-pro-max-back-1.jpg?quality=50&strip=all',
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'description' => 'Flagship Samsung smartphone with S Pen, 200MP camera, and Snapdragon 8 Gen 2.',
                'price' => 1199.99,
                'stock' => 40,
                'category_id' => 1,
                'image' => 'https://www.digitaltrends.com/wp-content/uploads/2023/02/Galaxy-S23-Ultra-Charge-Port-S-Pen.jpg?fit=3000%2C2000&p=1',
            ],
            [
                'name' => 'Google Pixel 7 Pro',
                'description' => 'Google\'s premium smartphone with Tensor G2 chip and advanced camera features.',
                'price' => 899.99,
                'stock' => 30,
                'category_id' => 1,
                'image' => 'https://static1.pocketnowimages.com/wordpress/wp-content/uploads/2022/10/Pixel-7-Pro-Family.jpg',
            ],
            [
                'name' => 'MacBook Pro 16',
                'description' => 'Powerful laptop with M2 Pro/Max chip, Liquid Retina XDR display, and up to 96GB RAM.',
                'price' => 2499.99,
                'stock' => 20,
                'category_id' => 2,
                'image' => 'https://bgr.com/wp-content/uploads/2021/12/16-macbook-pro-8.jpg?quality=82&strip=all',
            ],
            [
                'name' => 'Dell XPS 15',
                'description' => 'Premium Windows laptop with Intel Core i9, NVIDIA RTX graphics, and 4K OLED display.',
                'price' => 1999.99,
                'stock' => 25,
                'category_id' => 2,
                'image' => 'https://www.techspot.com/images/products/2023/laptops/org/2023-05-08-product.jpg',
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'description' => 'Compact gaming laptop with AMD Ryzen 9, NVIDIA RTX graphics, and 14" QHD display.',
                'price' => 1699.99,
                'stock' => 15,
                'category_id' => 2,
                'image' => 'https://th.bing.com/th/id/OIP.MlQBMIuZqD73z13R71kGSQHaEK?cb=iwc1&rs=1&pid=ImgDetMain',
            ],
            [
                'name' => 'iPad Pro 12.9',
                'description' => 'Apple\'s most powerful tablet with M2 chip, Liquid Retina XDR display, and Thunderbolt.',
                'price' => 1099.99,
                'stock' => 35,
                'category_id' => 3,
                'image' => 'https://s.yimg.com/os/creatr-uploaded-images/2020-03/f8a51d60-6ee8-11ea-afc7-e1112c0319e3',
            ],
            [
                'name' => 'Samsung Galaxy Tab S8 Ultra',
                'description' => 'Premium Android tablet with 14.6" AMOLED display, S Pen, and Snapdragon 8 Gen 1.',
                'price' => 899.99,
                'stock' => 30,
                'category_id' => 3,
                'image' => 'https://th.bing.com/th/id/OIP.l2SDmXHQhaMl6ul0kuMm0QHaE9?cb=iwc1&rs=1&pid=ImgDetMain',
            ],
            [
                'name' => 'AirPods Pro 2',
                'description' => 'Wireless earbuds with active noise cancellation, spatial audio, and adaptive transparency.',
                'price' => 249.99,
                'stock' => 100,
                'category_id' => 4,
                'image' => 'https://media.cnn.com/api/v1/images/stellar/prod/220921163441-airpods-pro-2-review-1.jpg?c=original',
            ],
            [
                'name' => 'Samsung Galaxy Watch 5 Pro',
                'description' => 'Advanced smartwatch with sapphire crystal display, titanium case, and health tracking.',
                'price' => 449.99,
                'stock' => 60,
                'category_id' => 4,
                'image' => 'https://r.testifier.nl/Acbs8526SDKI/resizing_type:fill/width:1200/height:800/crop:0.999:0.99/dpr:1/el:1/plain/https://s3-newsifier.ams3.digitaloceanspaces.com/androidworld.nl/images/2022-08/samsung-galaxy-watch-5-en-galaxy-watch-5-pro-62f39b239a29e.jpg',
            ],
            [
                'name' => 'Anker 737 Power Bank',
                'description' => '24,000mAh power bank with 140W output, digital display, and multiple ports.',
                'price' => 149.99,
                'stock' => 80,
                'category_id' => 4,
                'image' => 'https://cdn.shopify.com/s/files/1/0493/9834/9974/files/anker-737-power-bank_1aef9ab8-c995-4435-a808-cbd4b5104c21_480x480.jpg?v=1689299556',
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Premium wireless headphones with industry-leading noise cancellation and 30-hour battery life.',
                'price' => 399.99,
                'stock' => 45,
                'category_id' => 4,
                'image' => 'https://th.bing.com/th/id/OIP.l_C7FcJ-u_Rj2dxwm1gVhgHaE8?cb=iwc1&rs=1&pid=ImgDetMain',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
