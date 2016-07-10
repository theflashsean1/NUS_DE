<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'name' => 'Loud-Speaker',
            'description' => 'Biaxial pre stretch required, there is a inner circle and outer circle, the inner circle is
             pulled to stretch the membrane and thus act as actuator'
        ]);
        DB::table('configurations')->insert([
            'name' => 'Lateral',
            'description' => 'One side fixed while the other side is stretched'
        ]);
        DB::table('configurations')->insert([
            'name' => 'Uniaxial',
            'description' => 'One side stretches while the other side necks based on poisson\'ratio '
        ]);
        
    }
}
