<?php

namespace Database\Seeders;

use App\Models\Real;
use App\Models\House;
use App\Models\Other;
use App\Models\RealImage;
use App\Models\Commercial;
use Illuminate\Database\Seeder;

class RealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $reals = [
        [
            'user_id' => 1,
            'country' => 'syria',
            'city' => 'damascus',
            'street' => 'malki',
            'zip_code' => 'adnan almalki 10001',
            'price' => 95000000,
            'real_type' => 1, // Residential
            'size' => 150.00,
            'status' => 'Sale',
            'description' => 'A beautiful family home in the heart of the city.',
            'pay' => false,
            'image' => 'first/1.jpg',
            'real_image' => [
                'first/2.jpg',
                'first/4.jpg',
                'first/5.jpg',
                'first/6.jpg',
                'first/7.jpg',
                'first/8.jpg',
                'first/9.jpg',
                'first/10.jpg',
            ],
            'house' => [
                'rooms' => 6,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'garage' => 0,
            ],
            'commercial' => null,
            'other' => null,
        ],

        [
            'user_id' => 1,
            'country' => 'syria',
            'city' => 'damascus',
            'street' => 'meezah',
            'zip_code' => 'astrad al galla 5',
            'price' => 1800000000,
            'real_type' => 1, // Residential
            'size' => 120.00,
            'status' => 'Sale',
            'description' => 'A beautiful family home in the heart of the city.',
            'pay' => false,
            'image' => 'sec/1.jpg',
            'real_image' => [
                'sec/2.jpg',
                'sec/4.jpg',
                'sec/5.jpg',
                'sec/6.jpg',

            ],
            'house' => [
                'rooms' => 4,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'garage' => 0,
            ],
            'commercial' => null,
            'other' => null,
        ],
        [
            'user_id' => 1,
            'country' => 'syria',
            'city' => 'damas',
            'street' => 'abo remanah',
            'zip_code' => 'khbaz 12',
            'price' => 5000000,
            'real_type' => 1, // Residential
            'size' => 150.00,
            'status' => 'Rent',
            'description' => 'A beautiful family home in the heart of the city.',
            'pay' => false,
            'image' => 'thired/1.jpg',
            'real_image' => [
                'thired/2.jpg',
                'thired/4.jpg',
                'thired/5.jpg',
                'thired/6.jpg',
                'thired/7.jpg',
                'thired/8.jpg',
                'thired/9.jpg',
                'thired/10.jpg',

            ],
            'house' => [
                'rooms' => 5,
                'bedrooms' => 3,
                'bathrooms' => 1,
                'garage' => 1,
            ],
            'commercial' => null,
            'other' => null,
        ],
        [
            'user_id' => 1,
            'country' => 'syria',
            'city' => 'damasacus superb',
            'street' => 'zabadani',
            'zip_code' => 'sec grade',
            'price' => 900000000,
            'real_type' => 1, // Residential
            'size' => 160.00,
            'status' => 'Sale',
            'description' => 'A beautiful family home in the heart of the city.',
            'pay' => false,
            'image' => 'fourth/1.jpg',
            'real_image' => [
                'fourth/2.jpg',
                'fourth/4.jpg',
                'fourth/5.jpg',
                'fourth/6.jpg',
                'fourth/7.jpg',
                'fourth/8.jpg',
                'fourth/9.jpg',
                'fourth/10.jpg',
                'fourth/11.jpg',
                'fourth/12.jpg',

            ],
            'house' => [
                'rooms' => 5,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'garage' => 1,
            ],
            'commercial' => null,
            'other' => null,
        ],
        [
            'user_id' => 1,
            'country' => 'syria',
            'city' => 'damasacus superb',
            'street' => 'zabadani',
            'zip_code' => 'third grade',
            'price' => 900000,
            'real_type' => 2, 
            'size' => 160.00,
            'status' => 'Rent',
            'description' => 'A beautiful family home in the heart of the city.',
            'pay' => false,
            'image' => 'fifth/1.jpg',
            'real_image' => [
                'fifth/2.jpg',
                'fifth/4.jpg',



            ],
            'house'=> null,
            'commercial' => [
                        'commercial_kind' => 'Commercial store for all type of use',
                        'parking_spot' => 2,
                    ],
            'other' => null,
        ],

        // [
        //     'user_id' => 1,
        //     'country' => 'USA',
        //     'city' => 'New York',
        //     'street' => '123 Main St',
        //     'zip_code' => '10001',
        //     'price' => 150000.00,
        //     'real_type' => 2, // Commercial Land
        //     'size' => 150.00,
        //     'status' => 'Sale',
        //     'description' => 'A beautiful family home in the heart of the city.',
        //     'pay' => false,
        //     'image' => '664516cebedd1.jpg',
        //     'real_image' => [
        //         '664516cebedd1.jpg',
        //     ],
        //     'house' => null,
        //     'commercial' => [
        //         'commercial_kind' => 'Commercial store for all type of use',
        //         'parking_spot' => 20,
        //     ],
        //     'other' => null,
        // ],
    ];
    // ];
    public function run(): void
    {
        foreach ($this->reals as $realData) {
            $real = Real::create([
                'user_id' => $realData['user_id'],
                'country' => $realData['country'],
                'city' => $realData['city'],
                'street' => $realData['street'],
                'zip_code' => $realData['zip_code'],
                'price' => $realData['price'],
                'real_type' => $realData['real_type'],
                'size' => $realData['size'],
                'status' => $realData['status'],
                'description' => $realData['description'],
                'pay' => $realData['pay'],
                'image' => $realData['image'],
            ]);

            foreach ($realData['real_image'] as $image) {
                RealImage::create([
                    'real_id' => $real->id,
                    'real_image' => $image,
                ]);
            }

            if ($real->real_type == 1 && $realData['house']) {
                House::create(array_merge($realData['house'], ['real_id' => $real->id]));
            } elseif ($real->real_type == 2 && $realData['commercial']) {
                Commercial::create(array_merge($realData['commercial'], ['real_id' => $real->id]));
            } elseif ($real->real_type == 3 && $realData['other']) {
                Other::create(array_merge($realData['other'], ['real_id' => $real->id]));
            }
        }
    }
}
