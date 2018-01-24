<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin\builder;

use app\ealing\controller\admin\Backstage;

class BackstageBuilder extends Backstage{
    public function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        //获取模版的名称
        $template = '/default/builder/'.$templateFile;
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