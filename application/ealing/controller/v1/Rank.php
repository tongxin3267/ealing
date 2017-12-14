<?php
/**
* 排行相关控制器
* @date: 2017年12月7日 下午3:48:45
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;
use app\ealing\model\User;

class Rank extends OpenApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 获取粉丝排行
    * @date: 2017年12月7日 下午3:49:21
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function followers(User $userModel)
	{
	    $auth = $this->request->param('api') ?? 0;//这里后面要加入一个专门获取授权用户的通用方法【通过token来获取】
	    $limit = $this->request->param('limit', 10);
	    $offset = $this->request->param('offset', 0);
	    
	    $users = $userModel::all(function($query) use($limit, $offset){
	        $query->alias('us');
	        $query->field('us.*,ue.followers_count');
	        $query->join('user_extras ue', 'us.id = ue.user_id');
	        $query->order('ue.followers_count desc, us.id asc');
	        $query->limit($offset, $limit);
	    });
	    
	    foreach ($users as $key=>$user) {
	        $user->extra->count = $user->followers_count;
	        $user->extra->rank = $key + $offset + 1;

	        $user->following = $user->hasFollwing($auth);
	        $user->follower = $user->hasFollower($auth);
	        
	        unset($user->followers_count);
	    }
	    
		return $this->sendSuccess($users, 'success', 200);
	}
	
	/**
	* 获取财富排行
	* @date: 2017年12月7日 下午3:49:55
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function balance(User $userModel)
	{
	    $auth = $this->request->param('api')->id ?? 0;
	    $limit = $this->request->param('limit', 10);
	    $offset = $this->request->param('offset', 0);
	    
	    $users = $userModel::all(function($query) use($limit, $offset){
	        $query->alias('us');
	        $query->field('us.*');
	        $query->join('wallets w', 'us.id = w.user_id');
	        $query->order('w.balance desc,us.id asc');
	        $query->limit($offset, $limit);
	    });
	    
	    foreach ($users as $key=>$user) {
	        $user->following = $user->hasFollwing($auth);
	        $user->follower = $user->hasFollower($auth);
	        
	        $user->extra->rank = $key + $offset + 1;
	    }
	    
	    return $this->sendSuccess($users, 'success', 200);
	}
	
	/**
	* 获取收入排行
	* @date: 2017年12月7日 下午3:50:32
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function income()
	{
	    return $this->sendSuccess(['income'], 'success', 200);
	}
}