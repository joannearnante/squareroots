<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
            'name' => 'Squash (3 kg)',
                'description' => 'Squash helps process fats and carbohydrates, manages diabetes, improves vision, regulates blood circulation. It contains high amounts of Vitamin C and K,
is rich in Vitamins A, B6, and C, and
contains Magnesium, Potassium, and Phosphorus.',
                'price' => '183.00',
                'img_path' => '/images/squash.jpg',
                'status' => 'active',
                'category_id' => 1,
                'created_at' => '2019-04-09 19:20:00',
                'updated_at' => '2019-04-09 14:20:00',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'Broccoli (700 g)',
                'description' => 'Broccoli can lower risk of cancer, improve bone and heart health, reduces cholesterol, and has anti – ageing properties. It is rich in vitamin C, K, A, fiber and protein, and contains antioxidants.',
                'price' => '162.00',
                'img_path' => '/images/1554817742.jpg',
                'status' => 'active',
                'category_id' => 1,
                'created_at' => '2019-04-09 13:49:02',
                'updated_at' => '2019-04-09 13:49:02',
            ),
            2 => 
            array (
                'id' => 3,
            'name' => 'Squash (3 kg)',
                'description' => 'Squash helps process fats and carbohydrates, manages diabetes, improves vision, regulates blood circulation. It contains high amounts of Vitamin C and K, is rich in Vitamins A, B6, and C, and contains Magnesium, Potassium, and Phosphorus.',
                'price' => '183.00',
                'img_path' => '/images/1554818028.jpg',
                'status' => 'active',
                'category_id' => 1,
                'created_at' => '2019-04-09 13:53:48',
                'updated_at' => '2019-04-09 13:53:48',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Lakatan',
                'description' => 'Lakatan reduces risk of kidney stones, helps moderate blood sugar, regulates digestion and supports heart health. It\'s an excellent source of Potassium, is rich in fiber, and contains powerful antioxidants.',
                'price' => '110.00',
                'img_path' => '/images/1554822692.jpg',
                'status' => 'active',
                'category_id' => 2,
                'created_at' => '2019-04-09 15:11:32',
                'updated_at' => '2019-04-09 15:11:32',
            ),
        ));
        
        
    }
}