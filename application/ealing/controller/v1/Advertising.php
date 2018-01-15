<?php
/**
* 广告相关控制器
* @date: 2017年12月7日 下午3:36:33
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;
use app\ealing\model\AdvertisingSpace;
use app\ealing\model\Advertising as AdvModel;

class Advertising extends BaseApi
{
    /**
    * 获得广告空间
    * @date: 2017年12月7日 下午3:37:06
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function index(AdvertisingSpace $spaceModel)
    {
        $space = $spaceModel::all(function($query){
            $query->field('id,channel,space,alias,allow_type,format,created_at,updated_at');
        });

        foreach($space as &$item) {
            $item['format'] = json_decode($item['format'], true);
        }
        
        return $this->sendSuccess($space, 'success', 200);
    }
    
    /**
    * 查询某一广告位的广告列表
    * @date: 2017年12月7日 下午3:37:47
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function advertising(AdvModel $advModel)
    {
        $space_id = $this->request->param('space');
        
        $advertising = $advModel::all(function($query) use($advModel, $space_id){
            $advModel->scopeBySpace($query, $space_id);
        });
        
        return $this->sendSuccess($advertising, 'success', 200);
    }
    
    /**
    * 批量获取广告列表
    * @date: 2017年12月7日 下午3:38:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function batch(AdvModel $advModel)
    {
        $space = explode(',', $this->request->param('space'));
        
        $advertising = $advModel::all(function($query) use($advModel, $space){
            $advModel->scopeInSpace($query, $space);
        });

        return $this->sendSuccess($advertising, 'success', 200);
    }
}