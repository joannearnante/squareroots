<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Vegetables',
                'isActive' => 'true',
                'created_at' => '2019-04-09 19:20:00',
                'updated_at' => '2019-04-10 04:45:24',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Fruits',
                'isActive' => 'true',
                'created_at' => '2019-04-09 12:05:09',
                'updated_at' => '2019-04-10 04:45:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Others',
                'isActive' => 'false',
                'created_at' => '2019-04-09 12:52:33',
                'updated_at' => '2019-04-10 04:57:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mushrooms',
                'isActive' => 'true',
                'created_at' => '2019-04-10 04:56:33',
                'updated_at' => '2019-04-10 04:57:50',
            ),
        ));
        
        
    }
}