<?php
/**
 * 向客户端发送相应基类
 */
namespace app\ealing\controller;

use think\Response;
use think\response\Redirect;

trait Send
{

    /**
     * 默认返回资源类型
     * @var string
     */
    protected $restDefaultType = 'json';
    
    protected $type;

    /**
     * 设置响应类型
     * @param null $type
     * @return $this
     */
    public function setType($type = null)
    {
        $this->type = (string)(!empty($type)) ? $type : $this->restDefaultType;
        return $this;
    }
    
    /**
    * 获取当前响应类型
    * @date: 2017年12月5日 下午2:27:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 失败响应
     * @param int $error
     * @param string $message
     * @param int $code
     * @param array $data
     * @param array $headers
     * @param array $options
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Xml
     */
    public function sendError($error = 400, $message = 'error', $code = 400, $data = [], $headers = [], $options = [])
    {
        $responseData['error'] = (int)$error;
        $responseData['message'] = (string)$message;
        if (!empty($data)) $responseData['data'] = $data;
        $responseData = array_merge($responseData, $options);
        return $this->response($responseData, $code, $headers);
    }

    /**
     * 成功响应
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param array $options
     * @return Response|\think\response\Json|\think\response\Jsonp|Redirect|\think\response\Xml
     */
    public function sendSuccess($data = [], $message = 'success', $code = 200, $headers = [], $options = [])
    {
        $responseData['error'] = 0;
        $responseData['message'] = (string)$message;
        if (!empty($data)) $responseData['data'] = $data;
        $responseData = array_merge($responseData, $options);
        return $this->response($responseData, $code, $headers);
    }

    /**
     * 重定向
     * @param $url
     * @param array $params
     * @param int $code
     * @param array $with
     * @return Redirect
     */
    public function sendRedirect($url, $params = [], $code = 302, $with = [])
    {
        $response = new Redirect($url);
        if (is_integer($params)) {
            $code = $params;
            $params = [];
        }
        $response->code($code)->params($params)->with($with);
        return $response;
    }

    /**
     * 响应
     * @param $responseData
     * @param $code
     * @param $headers
     * @return Response|\think\response\Json|\think\response\Jsonp|Redirect|\think\response\View|\think\response\Xml
     */
    public function response($responseData, $code, $headers)
    {
        if (!isset($this->type) || empty($this->type)) $this->setType();
        return Response::create($responseData, $this->type, $code, $headers);
    }

    /**
     * 如果需要允许跨域请求，请在记录处理跨域options请求问题，并且返回200，以便后续请求，这里需要返回几个头部。。
     * @param code 状态码
     * @param message 返回信息
     * @param data 返回信息
     * @param header 返回头部信息
     */
    public function returnmsg($code = '400', $message = '',$data = [],$header = [])
    {	
    	http_response_code($code);    //设置返回头部
    	$return['error'] = $code;
    	$return['message'] = $message;
    	if (!empty($data)) $return['data'] = $data;
    	
    	// 发送头部信息
        foreach ($header as $name => $val) {
            if (is_null($val)) {
                header($name);
            } else {
                header($name . ':' . $val);
            }
        }
        
        //返回不同类型的API数据格式
        switch ($this->type)
        {
            case 'json':
                exit(json_encode($return,JSON_UNESCAPED_UNICODE));
            break;
            case 'xml':
                exit($this->arr2xml($return));
            break;
            default:
                exit(json_encode($return,JSON_UNESCAPED_UNICODE));
        }
    	
    }
    
    /**
     *  将数组转换为xml
     *  @param array $data  要转换的数组
     *  @param bool $root   是否要根节点
     *  @return string     xml字符串
     *  @author Dragondean
     *  @url  http://www.cnblogs.com/dragondean
     */
    private function arr2xml($data, $root = true){
        $str="";
        if($root) $str .= '<?xml version="1.0" encoding="utf-8"?><think>';
        foreach($data as $key => $val){
            if(is_array($val)){
                $child = arr2xml($val, false);
                $str .= "<$key>$child</$key>";
            }else{
                $str.= "<$key>$val</$key>";
            }
        }
        if($root)$str .= "</think>";
        return $str;
    }   
}