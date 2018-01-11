<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin\builder;

use app\ealing\controller\admin\Backstage;

class BackstageBuilder extends Backstage{

    public function _initializeView()
    {
        $root = think_get_root();
        $viewReplaceStr = [
            '__PUBLIC__' => $root.'/',
            '__STATIC__' =>$root.'/static',
            '__B_IMG__' =>$root.'/backstage/images',
            '__B_CSS__' =>$root.'/backstage/css',
            '__B_JS__' =>$root.'/backstage/js',
            '__ROOT__'=>$root,
            '__ZUI__' => $root . '/static/zui',
            '__UPLOAD__' => $root,

        ];
        config('view_replace_str', $viewReplaceStr);
    }

    public function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        //获取模版的名称
        $template = '/builder/'.$templateFile;
        //显示页面
        return parent::display($template);
    }

    protected function compileHtmlAttr($attr) {
        $result = [];
        foreach($attr as $key=>$value) {
            $value = htmlspecialchars($value);
            $result[] = "$key=\"$value\"";
        }
        $result = implode(' ', $result);
        return $result;
    }
}