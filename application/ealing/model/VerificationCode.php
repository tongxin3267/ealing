<?php
/**
* 验证码模型
* @date: 2017年12月6日 下午1:53:55
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class VerificationCode extends BaseModel
{
    /**
    * 设置复用的创建时间范围查询，单位秒.
    * @date: 2017年12月6日 下午1:54:45
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByValid($query, $second = 300)
    {
        $now = time();
        return $query->where('created_at', 'between', [date('Y-m-d H:i:s', $now-300), date('Y-m-d H:i:s',$now)]);
    }
    
    /**
    * 计算距离验证码过期时间.
    * @date: 2017年12月6日 下午1:55:36
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function makeSurplusSecond($vaildSecond = 60, $sendTime)
    {
        return $vaildSecond - ceil((time()-strtotime($sendTime))/60);
    }
    
    /**
    * 设置时间点
    * @date: 2017年12月6日 下午3:16:27
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function updateTime()
    {
        $this->nowTime = time();
    }
    
    /**
    * 发送验证码逻辑
    * @date: 2017年12月6日 下午3:28:06
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function notify($data)
    {
        #发送验证码
    }
}