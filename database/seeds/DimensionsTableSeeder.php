<?php

use Illuminate\Database\Seeder;

class DimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dimensions')->insert([
            'name' => 'One sided stacked',
            'description' =>'Frame is attached to only one side of each DEA to reduce the weight'
        ]);
    }
}
