<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PossessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('possessions')->insert([
            [
                'user_id' => '1',
                'item_id' => '1',
                'number' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '1',
                'item_id' => '2',
                'number' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
