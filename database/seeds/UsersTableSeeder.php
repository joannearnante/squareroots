<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@squareroots.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$KN6SoH.vi3S3nJh.hNq51.T0QCgoQVeS6Qrq9T/dtIMkBqr/nFnkW',
                'remember_token' => NULL,
                'created_at' => '2019-03-28 09:56:19',
                'updated_at' => '2019-03-28 09:56:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'notadmin',
                'email' => 'notadmin@squareroots.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$9rwPTMfSACX8G2ayo9/J7OKXmAXI8/Gzjw3OouPl6PeMlfjS19/oO',
                'remember_token' => NULL,
                'created_at' => '2019-03-28 10:16:48',
                'updated_at' => '2019-03-28 10:16:48',
            ),
        ));
        
        
    }
}