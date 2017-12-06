<?php
namespace app\ealing\controller;

use think\Request;

class Error
{
    use Send;
    
    public function index()
    {
        $request = Request::instance();
        $ext = $request->ext();
        if ('' == $ext) {
            // 自动检测资源类型
            $type = $request->type();
        } elseif (!preg_match('/\(json\)$/i', $ext)) {
            // 资源类型非法 则用默认资源类型访问
            $type = $this->restDefaultType;
        } else {
            $type = $ext;
        }
        
        $this->setType($type);//设置反馈类型   根据mimeType判断
        return $this->sendError(405, 'No routing path can be found for the request.');
    }
}