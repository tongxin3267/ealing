<?php
/**
* 好友模型相关可复用类
* @date: 2017年12月13日 下午4:38:48
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model\relations;

use app\ealing\model\User;

trait UserHasFollow
{
    /**
    * 关注的关系
    * @date: 2017年12月13日 下午4:54:53
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function followers()
    {
        return $this->belongsToMany('User', 'user_follow', 'target', 'user_id');
    }    
    
    /**
    * 验证是否关注了自己
    * @date: 2017年12月13日 下午4:42:01
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function hasFollwing($user)
    {
        if ($user instanceof User) {
            $user = $user->id;
        }

        if (! $user) {
            return false;
        }
        
        return $this->followers()->value('target') === $user;
    }
    
    /**
    * 验证是否被该用户关注
    * @date: 2017年12月13日 下午5:06:56
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function hasFollower($user)
    {
        if ($user instanceof User) {
            $user = $user->id;
        }
    
        if (! $user) {
            return false;
        }
    
        return $this->followers()->value('user_id') === $user;
    }    
}