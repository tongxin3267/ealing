<?php
/**
* 启动信息控制器
* @date: 2017年12月4日 上午9:34:27
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;
use app\ealing\model\AdvertisingSpace;
use app\ealing\model\GoldType;
use app\ealing\model\CommonConfigs;

class Bootstrappers extends BaseApi
{   
    /**
    * 对应get请求的获取API
    * @date: 2017年12月4日 上午9:43:27
    * @author: onep2p <324834500@qq.com>
    */
	public function show(CommonConfigs $configMModel)
	{
		$bootstrappers = [];
		
		foreach ($configMModel::all(function($query) use($configMModel){$configMModel->scopeByNamespace($query, 'common');}) as $bootstrapper) {
		    $bootstrappers[$bootstrapper->name] = $this->formatValue($bootstrapper->value);
		}
		
		//广告相关
		$spaceModel = new AdvertisingSpace();
		$bootstrappers['ad'] = $spaceModel->where('space', 'boot')->with(['advertising' => function ($query) {
		    $query->order('sort', 'asc');
		}])->find()->advertising ?? [];
		
		$bootstrappers['site'] = config('site', null);
		$bootstrappers['registerSettings'] = config('registerSettings') ?? null;
		
		$bootstrappers['walletCash'] = ['open' => config('walletCash.status') ?? true];//钱包提现的开关选项
		$bootstrappers['walletRecharge'] = ['open' => config('walletRecharge.status') ?? true];//钱包充值的开关选项
		
		$goldTypeModel = new GoldType();
		$goldSetting = $goldTypeModel->where('status', 1)->field(['name', 'unit'])->find() ?? ['name' => '金币', 'unit' => '个'];
		$bootstrappers['site']['gold_name'] = $goldSetting;
		
		return $this->sendSuccess($bootstrappers, 'success', 200);
	}
	
	/**
	* 对应put请求的更新API
	* @date: 2017年12月4日 上午10:03:25
	* @author: onep2p <324834500@qq.com>
	*/
	public function update()
	{
	    return 'update';
	}
	
	/**
	* 格式化数据
	* @date: 2017年12月4日 上午11:42:30
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	protected function formatValue($value)
	{
	    if (($data = json_decode($value, true)) === null) {
	        return $value;
	    }
	
	    return $data;
	}	
}