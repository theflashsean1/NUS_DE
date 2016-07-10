<?php

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'name' => 'VHB4910',
            'description' =>'Thicker membrane (mm) without electric breakdown till around 5-6kv'
        ]);
        DB::table('materials')->insert([
            'name' => 'VHB4905',
            'description' =>'Thinner membrane (mm)'
        ]);
    }
}
