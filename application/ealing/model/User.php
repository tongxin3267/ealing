<?php 
/**
* 用户模型
* @date: 2017年12月13日 下午2:30:35
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class User extends BaseModel
{
    //关系数据相关
    use relations\UserHasFollow;
    
    protected $hidden = ['password', 'remember_token', 'phone', 'email', 'deleted_at', 'pivot'];
    
    protected $append = ['avatar', 'bg', 'verified'];
    
    protected $with = ['extra'];
    
    /**
    * 追加获取用户头像
    * @date: 2017年12月13日 下午3:45:17
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function getAvatarAttr()
    {
        return 'avatar';
    }
    
    /**
    * 追加获取用户背景图片
    * @date: 2017年12月13日 下午3:45:33
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function getBgAttr()
    {
        return 'bg';
    }
    
    /**
    * 追加获取用户认证信息
    * @date: 2017年12月13日 下午3:48:29
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function getVerifiedAttr()
    {
        return 'verified';
    }
    
    /**
     * 关联用户附加统计模型
     */
    public function extra()
    {
        return $this->hasOne('UserExtras', 'user_id', 'id');
    }
}