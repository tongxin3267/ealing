<?php

namespace app\ealing\controller\admin;
use app\ealing\controller\admin\BaseController;
use app\ealing\controller\admin\builder\BackstageListBuilder;

class Config extends BaseController{
    public function configs(){
        $builder = new BackstageListBuilder();
        
        $builder->title('配置列表')->keySelection()->keyIndex();
        $builder->buttonNew(url(Config::class.'@add'));
        
        return $builder->show();
    }
    
    public function add(){
        echo 1;
    }
}