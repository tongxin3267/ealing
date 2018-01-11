<?php

use think\migration\Seeder;
use app\ealing\model\GoldType;

class GoldTypeSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $count = GoldType::where('name', '积分')->count();
        if (! $count) {
            GoldType::create(['name' => '积分', 'unit' => '点', 'status' => 1]);
        }
    }
}