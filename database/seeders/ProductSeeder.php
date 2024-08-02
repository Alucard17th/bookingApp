<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            [
                'stripe_product_id' => 'prod_PwfEsFgolHyugQ',
                'bookings' => 500,
                'features' => json_encode([
                    'id' => 1,
                    'name' => 'Standard',
                    'admin_dashboard' => 1,
                    'white_label' => 0,
                    'list_in_booked_directory' => 1,
                ]),
                'name' => 'Standard',
                'price' => '25',
                'stripe_price_id' => 'price_1P6ltyA7dIeuDMDjdAjiUlJi',
                'paddle_price_id' => 'pri_01hxdccwxkaygqtvkqkq94j8z5',
            ],
            [
                'stripe_product_id' => 'prod_PwLVuR0iFzD1lx',
                'bookings' => 50,
                'features' => json_encode([
                    'id' => 2,
                    'name' => 'Free',
                    'admin_dashboard' => 1,
                    'white_label' => 0,
                    'list_in_booked_directory' => 0,
                    'widget' => 1,
                    'services_and_events_providers' => 1,
                ]),
                'name' => 'Free',
                'price' => '0',
                'stripe_price_id' => 'price_1P6So1A7dIeuDMDjG4mA8UJx',
                'paddle_price_id' => 'pri_01hxghbv7zm3wc3kjmhwx8s0b3',
            ],
            [
                'stripe_product_id' => 'prod_PwKvIbw6knJHkp',
                'bookings' => 100,
                'features' => json_encode([
                    'id' => 3,
                    'name' => 'Basic',
                    'admin_dashboard' => 1,
                    'white_label' => 0,
                    'list_in_booked_directory' => 0,
                ]),
                'name' => 'Basic',
                'price' => '9',
                'stripe_price_id' => 'price_1P6SFtA7dIeuDMDjaYRSyVNS',
                'paddle_price_id' => 'pri_01hxcvfyfza8sa9pm96jx8d055',
            ],
            [
                'stripe_product_id' => 'prod_PwKw5wPSmF3XK1',
                'bookings' => 2000,
                'features' => json_encode([
                    'id' => 4,
                    'name' => 'Premium',
                    'admin_dashboard' => 1,
                    'white_label' => 1,
                    'list_in_booked_directory' => 1,
                ]),
                'name' => 'Premium',
                'price' => '49',
                'stripe_price_id' => 'price_1P6SGpA7dIeuDMDj7yxYyEzq',
                'paddle_price_id' => 'pri_01hxdce6xdcvx0jhczq1adekc3',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        
        }

    }

}