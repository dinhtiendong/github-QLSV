<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Gọi ClassModel
use App\Models\ClassModel;
class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0; $i < 10; $i++)
        	ClassModel::create([
        		'name' => "CNTT K0$i",
        		'description' => "Lớp CNTT khóa $i"
        	]);
    }
}
