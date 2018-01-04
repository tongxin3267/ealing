<?php
/**
* 新闻控制器
* @date: 2017年12月20日 上午10:13:50
* @author: onep2p <324834500@qq.com>
*/
namespace app\news\controller\v1;

use app\ealing\controller\AuthApi;

class News extends AuthApi
{
    protected $openListAction = ['store', 'show'];
    
    /**
    * 获取新闻，用于主页   包含推荐新闻、热门新闻、最新新闻
    * @date: 2017年12月20日 上午10:16:05
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function store()
    {
        return 1;
    }
    
    /**
    * 获取某一篇新闻数据
    * @date: 2017年12月27日 上午9:06:56
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function show()
    {
        return 2;
    }
    
    /**
    * 获取新闻分类
    * @date: 2017年12月20日 上午10:15:52
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function category()
    {
        
    }
}