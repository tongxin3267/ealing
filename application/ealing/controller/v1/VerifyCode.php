<?php
/**
* 验证码控制器
* @date: 2017年12月4日 上午9:34:27
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;
use app\ealing\model\VerificationCode;

class VerifyCode extends BaseApi
{
    /**
     * 对应get请求的更新API
     * @date: 2017年12月4日 下午4:32:03
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return:
     */
    public function store()
    {
        return $this->sendFromRequest($this->request);
    }
    
    /**
    * 对应post请求的获取API
    * @date: 2017年12月4日 下午4:31:00
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function storeByRegister()
	{
	    return $this->sendFromRequest($this->request);
	}
	
	/**
	* 发送验证码通过请求
	* @date: 2017年12月4日 下午4:33:09
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	protected function sendFromRequest()
	{
	    $map = [
	        'mail' => 'email',
	        'sms' => 'phone',
	    ];

	    $user_id = $this->request->param('user_id') ?? null;
	
	    foreach ($map as $channel => $input) {
	        if (!($account = $this->request->param($input))) {
	            continue;
	        }
	
	        $this->send($account, $channel, [
	            'user_id' => $user_id,
	        ]);
	        break;
	    }

	    return $this->sendSuccess(['message' => ['获取成功']], 'success', 202);
	}

    /**
    * 发送验证码 短信   or 邮件
    * @date: 2017年12月6日 上午9:19:03
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    protected function send($account, $channel = '', $data = [])
    {
        $this->validateSent($account);

        $data['account'] = $account;
        $data['channel'] = $channel;
        $model = VerificationCode::create($data);
        
        //DOTO:   这里要加入发送验证码的逻辑    短信   OR 邮件
        $model->notify($model);
    }

    /**
    * 验证发送
    * @date: 2017年12月6日 上午9:18:37
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    protected function validateSent($account)
    {
        $vaildSecond = config('app.env') == 'production' ? 60 : 6;
        
        $verify = VerificationCode::get(function($query) use($vaildSecond, $account){
            $query->where('account', $account);
            Factory::getInstance(VerificationCode::class)->scopeByValid($query, $vaildSecond);
            $query->order('id', 'desc');
        });

        if ($verify) {
            return $this->sendError(403, 'error', 403, [sprintf('还需要%d秒后才能获取', $verifyModel->makeSurplusSecond($vaildSecond, $verify['created_at']))]);
        }
    }
}