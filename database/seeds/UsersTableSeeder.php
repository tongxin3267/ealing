<?php

use think\migration\Seeder;
use app\ealing\model\User;
use think\Env;

class UsersTableSeeder extends Seeder
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
        $this->createFounderUser();
    }
    
    protected function createFounderUser()
    {
        $user = User::create(['name' => 'root', 'password' => EalingEncrypt('root', Env::get('APP_KEY'))]);
    }
}