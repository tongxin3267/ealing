<?php
/**
* 位置控制器
* @date: 2017年12月7日 上午10:19:54
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;
use app\ealing\model\Area as AreaModel;

class Location extends OpenApi
{
    public $restMethodList = 'get';

    /**
    * get请求的城市搜索
    * @date: 2017年12月7日 上午10:20:51
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function search(AreaModel $model)
    {
        $name = $this->request->param('name');
        if(empty($name) || !isset($name)) return $this->sendError(422, 'error', 422, ['name' => ['必须输入搜索关键词']]);
        
        $areas = $model->with('parent', 'items')
            ->where('name', 'like', sprintf('%%%s%%', $name))
            ->limit(5)
            ->select();
        
        $parentTreeCall = function(callable $call, $area, $tree = []) use($model){
            if ($area->parent) {
                $tree[] = $area->parent;
            
                return $call($call, $model->with('parent')->where('id', $area->parent['id'])->find(), $tree);
            }
            
            return $tree;
        };
        
        $data = [];
        foreach($areas as $area) {
            $tree = collection($parentTreeCall($parentTreeCall, $area, [$area]))->toArray();
            
            $treeData = [];
            foreach (array_reverse($tree) as $item){
                if(!empty($treeData)) {
                    $old = $treeData;
                    $treeData = $item;
                    $treeData['parent'] = $old;
                }else{
                    $treeData = $item;
                }
            }
            
            $dataItem['tree'] = $treeData;
            $dataItem['items'] = count($tree) < 3 ? collection($area->items)->toArray() : null;
            
            $data[] = $dataItem;
        }
        
        
        return $this->sendSuccess($data, 'success', 200);
    }
    
    /**
    * get请求的热门城市
    * @date: 2017年12月7日 上午10:21:10
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function hots()
    {
        return $this->sendSuccess(['hots'], 'success', 200);
    }
}