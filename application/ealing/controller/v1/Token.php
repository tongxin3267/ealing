<?php
/**
* 获取accesstoken
* @date: 2017年12月1日 下午1:44:40
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use think\Request;
use app\ealing\controller\Factory;
use app\ealing\controller\Oauth as Oauth2;
use app\ealing\model\Oauth as Oauth;
use app\ealing\controller\OpenApi;
use app\ealing\model\CachesToken as CachesToken;

class Token extends OpenApi
{	
	//客户端请求验证规则
	public static $rule_validate = [
        'app_key'     =>  'require',
        'app_secret' =>  'require',
    ];
	
	/**
	 * 当前资源类型
	 * @var string
	 */
	protected $type;
	
	/**
	 * 商户信息
	 * @var array
	 */
	protected $clientInfo;
    
    /**
     * 构造函数
     * 初始化检测请求时间，签名等
     */
    public function __construct()
    {
        $this->request = Request::instance();
        $this->init();

        if ($this->request->has('signature') && $this->checkTime()) $this->checkSign();
    } 

    /**
     * 初始化方法
     * 检测请求类型，数据格式等操作
     */
    public function init()
    {
    	// 资源类型检测
        $ext = $this->request->ext();
        if ('' == $ext) {
            // 自动检测资源类型
            $this->type = $this->request->type();
        } elseif (!preg_match('/\(' . $this->restTypeList . '\)$/i', $ext)) {
            // 资源类型非法 则用默认资源类型访问
            $this->type = $this->restDefaultType;
        } else {
            $this->type = $ext;
        }

        $this->setType($this->type);//设置反馈类型   根据mimeType判断
    }

	/**
	* 创建一个令牌
	* @date: 2017年11月28日 下午3:00:15
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function store()
	{
		$checkMsg = $this->checkAppkey(self::$rule_validate);
		if(!empty($checkMsg)) return $checkMsg;

		try {
		    $accessTokenInfo = $this->setAccessToken();
		    return $this->sendSuccess($accessTokenInfo,'success',200);
		} catch (\Exception $e) {
		    $this->sendError(500, 'server error!!', 500);
		}
	}
	
	/**
	* 刷新用户令牌
	* @date: 2017年12月13日 上午11:05:12
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function refresh(CachesToken $model)
	{
	    /**
	     * 如果是之前认证了的令牌在访问则刷新令牌并返回最新的令牌
	     * 如果授权码错误则提示
	     */
	    $token = $this->request->param('token');
	    $ttl_expires = time() + Oauth2::$expires;
	    
	    if($model->save(['expires_time' => $ttl_expires],['status'=>1,'access_token'=>$token]) === 0){
	        return $this->sendError(500, 'error', 500, ['message' => ['Failed to refresh token.']]);
	    }
	    
	    //返回新的有效期时间，前端可以直接覆盖重写
	    return $this->sendSuccess([
	        'access_token' => $token,
	        'expires_time' => $ttl_expires,//过期时间时间戳
	    ], 'success', 200);
	}

	/**
	 * 检测时间+_300秒内请求会异常
	 */
	public function checkTime()
	{
		$time = $this->request->param('timestamp');
		if($time > time()+300  || $time < time()-300){
			return $this->sendError(401,'The requested time is incorrect', 401);
		}
		
		return true;
	}

	/**
	* 检测appkey的有效性
	* @date: 2017年11月28日 下午3:17:40
	* @author: onep2p <324834500@qq.com>
	* @param: $rule  验证规则
	* @return:
	*/
	public function checkAppkey($rule)
	{
		$result = $this->validate($this->request->param(),$rule);
		
		if(true !== $result) return $this->sendError(405,$result, 405);

        //====调用模型验证app_key是否正确，同时判断商户可用性======
        $app_secret = input('app_secret');
		$result = Oauth::get(function($query){
		    $query->field('id,app_secret,expires_in');
			$query->where('app_key', $this->request->param('app_key'));
			$query->where('expires_in','>' ,time());
		});
		
		if($app_secret !== $result['app_secret']) return $this->sendError(401,'App_secret does not exist or has expired. Please contact management', 401);
		
		if(empty($result)) return $this->sendError(401,'App_key does not exist or has expired. Please contact management', 401);
		
		unset($result['app_secret']);
		$this->clientInfo = $result;
	}

	/**
	 * 检查签名
	 */
	public function checkSign()
	{	
		$baseAuth = Factory::getInstance(\app\ealing\controller\Oauth::class);
		$app_secret = Oauth::get(['app_key' => $this->request->param('app_key')]);
    	$sign = $baseAuth->makesign($this->request->param(),$app_secret['app_secret']);//生成签名
    	if($sign !== $this->request->param['signature']){
    		return self::sendError(401,'Signature error',401);
    	}
	}

	/**
     * 设置AccessToken
     * @param $clientInfo
     * @return int
     */
    protected function setAccessToken()
    {
        $accessToken = self::buildAccessToken(64);
        $accessTokenInfo = [
            'access_token' => $accessToken,//访问令牌
            'expires_time' => time() + Oauth2::$expires,//过期时间时间戳
            'client' => $this->clientInfo,//用户信息
            'user' => []
        ];
        
        self::saveAccessToken($accessTokenInfo);
        return $accessTokenInfo;
    }

    /**
     * 生成AccessToken
     * @return string
     */
    protected static function buildAccessToken($lenght = 32)
    {
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
		return substr(str_shuffle($str_pol), 0, $lenght);

    }

    /**
     * 存储
     * @param $accessToken
     * @param $accessTokenInfo
     */
    protected static function saveAccessToken($accessTokenInfo)
    {
        $accessTokenInfo['status'] = 1;
        $accessTokenInfo['client'] = json_encode($accessTokenInfo['client']);
        $accessTokenInfo['user'] = json_encode($accessTokenInfo['user']);
        
        $cachesTokenModel = new CachesToken();
        $cachesTokenModel->save($accessTokenInfo);
    }
}