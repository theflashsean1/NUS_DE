<?php

use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            'name' => 'High Voltage Supply',
            'description' =>'For supplying voltage from 0 to 60kv'
        ]);
        DB::table('equipment')->insert([
            'name' => 'Arduino',
            'description' =>'Control and apply cyclic voltage to the high voltage supply'
        ]);
        DB::table('equipment')->insert([
            'name' => 'UTM',
            'description' =>'Measures the structural properties of material'
        ]);

    }
}
