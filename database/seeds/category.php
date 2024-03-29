<?php

use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->delete();
        DB::table('category')->insert([
            ['id'=>1,'name'=>'Nam','slug'=>'nam','parent'=>0],
            ['id'=>2,'name'=>'Áo Nam','slug'=>'ao-nam','parent'=>1],
            ['id'=>3,'name'=>'Quần Nam','slug'=>'quan-nam','parent'=>1],
            ['id'=>4,'name'=>'Nữ','slug'=>'nu','parent'=>0],
            ['id'=>5,'name'=>'Áo Nữ','slug'=>'ao-nu','parent'=>4],
            ['id'=>6,'name'=>'Quần Nữ','slug'=>'quan-nu','parent'=>4]
        ]);
    }
}
