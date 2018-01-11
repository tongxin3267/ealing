<?php

use think\migration\Seeder;

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
        echo Base64Encrypt('zhourui', 'YunshangEaling');exit;
    }
}