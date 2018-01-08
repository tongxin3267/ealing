<?php

use think\migration\Seeder;

class AdvertisingSpaceTableSeeder extends Seeder
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
        $seedTime = date('Y-m-d H:i:s');
        $data = [
            'channel' => 'boot',
            'space' => 'boot',
            'alias' => 'App 启动广告',
            'allow_type' => 'image',
            'format' => json_encode([
                'image' => [
                    'image' => '图片|string|必填，启动图广告尺寸为 375pt*538pt',
                    'link' => '链接|string|必填，广告位链接',
                    'duration' => '时长|integer|必填， 广告显示时间',
                ],
            ]),
            'rule' => json_encode([
                'image' => [
                    'image' => 'required|url',
                    'link' => 'required|url',
                    'duration' => 'required',
                ],
            ]),
            'message' => json_encode([
                'image' => [
                    'image.required' => '广告位图片不能为空',
                    'image.url' => '广告位图片地址有误',
                    'link.required' => '广告位链接不能为空',
                    'link.url' => '广告位链接格式错误',
                    'duration' => '启动图广告时长不能为空',
                ],
            ]),
            'created_at' => $seedTime,
            'updated_at' => $seedTime
        ];
        
        $AdvertisingSpace = $this->table('advertising_space');
        $AdvertisingSpace->insert($data)->save();
    }
}