<?php
/**
* 助手函数
* @date: 2018年1月8日 下午5:15:41
* @author: onep2p <324834500@qq.com>
*/

use think\Request;

if (!function_exists('EalingEncrypt')) {
    /**
     * 加密字符串
     * @param string $str 字符串
     * @param string $key 加密key
     * @param integer $expire 有效期（秒）
     * @return string
     */
    function EalingEncrypt($data,$key,$expire=0)
    {
        $expire = sprintf('%010d', $expire ? $expire + time():0);
        $key  = md5($key);
        $data = base64_encode($expire.$data);
        $x    = 0;
        $len  = strlen($data);
        $l    = strlen($key);
        $char = $str    =   '';
        
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
        }
        return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
    }
}

if (!function_exists('EalingDecrypt')) {
    /**
     * 解密字符串
     * @param string $str 字符串
     * @param string $key 加密key
     * @return string
     */
    function EalingDecrypt($data,$key) {
        $key    = md5($key);
        $data   = str_replace(array('-','_'),array('+','/'),$data);
        $mod4   = strlen($data) % 4;
        if ($mod4) {
           $data .= substr('====', $mod4);
        }
        $data   = base64_decode($data);

        $x      = 0;
        $len    = strlen($data);
        $l      = strlen($key);
        $char   = $str = '';

        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }

        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }else{
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        $data   = base64_decode($str);
        $expire = substr($data,0,10);
        if($expire > 0 && $expire < time()) {
            return '';
        }
        $data   = substr($data,10);
        return $data;
    }
}

if (!function_exists('msubstr')) {
    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
            elseif (function_exists('iconv_substr')) {
                $slice = iconv_substr($str, $start, $length, $charset);
                if (false === $slice) {
                    $slice = '';
                }
            } else {
                $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
                $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
                $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
                $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
                preg_match_all($re[$charset], $str, $match);
                $slice = join("", array_slice($match[0], $start, $length));
            }
            return $suffix ? $slice . '...' : $slice;
    }
}

if(!function_exists('msubstr')){
    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     */
    function is_login()
    {

        $user = session('user_auth');
        if (empty($user)) {
            return 0;
        } else {
            return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
        }
    }
}

if(!function_exists('data_auth_sign')){
    /**
     * 数据签名认证
     * @param  array $data 被认证的数据
     * @return string       签名
     */
    function data_auth_sign($data)
    {
        //数据类型检测
        if (!is_array($data)) {
            $data = (array)$data;
        }
        ksort($data); //排序
        $code = http_build_query($data); //url编码并生成query字符串
        $sign = sha1($code); //生成签名
        return $sign;
    }
}

if(!function_exists('think_get_root')){
    /**
     * 获取网站根目录
     * @return string 网站根目录
     */
    function think_get_root()
    {
        $request = Request::instance();
        $root    = $request->root();
        $root    = str_replace('/index.php', '', $root);
        return $root;
    }
}

if(!function_exists('real_strip_tags')){
    function real_strip_tags($str, $allowable_tags = "")
    {
        return strip_tags($str, $allowable_tags);
    }
}

if(!function_exists('op_t')){
    /**
     * t函数用于过滤标签，输出没有html的干净的文本
     * @param string text 文本内容
     * @return string 处理后内容
     */
    function op_t($text, $addslanshes = false)
    {
        $text = nl2br($text);
        $text = real_strip_tags($text);
        if ($addslanshes)
            $text = addslashes($text);
        $text = trim($text);
        return $text;
    }
}

if(!function_exists('op_h')){
    /**
     * h函数用于过滤不安全的html标签，输出安全的html
     * @param string $text 待过滤的字符串
     * @param string $type 保留的标签格式
     * @return string 处理后内容
     */
    function op_h($text, $type = 'html')
    {
        // 无标签格式
        $text_tags = '';
        //只保留链接
        $link_tags = '<a>';
        //只保留图片
        $image_tags = '<img>';
        //只存在字体样式
        $font_tags = '<i><b><u><s><em><strong><font><big><small><sup><sub><bdo><h1><h2><h3><h4><h5><h6>';
        //标题摘要基本格式
        $base_tags = $font_tags . '<p><br><hr><a><img><map><area><pre><code><q><blockquote><acronym><cite><ins><del><center><strike>';
        //兼容Form格式
        $form_tags = $base_tags . '<form><input><textarea><button><select><optgroup><option><label><fieldset><legend>';
        //内容等允许HTML的格式
        $html_tags = $base_tags . '<ul><ol><li><dl><dd><dt><table><caption><td><th><tr><thead><tbody><tfoot><col><colgroup><div><span><object><embed><param>';
        //专题等全HTML格式
        $all_tags = $form_tags . $html_tags . '<!DOCTYPE><meta><html><head><title><body><base><basefont><script><noscript><applet><object><param><style><frame><frameset><noframes><iframe>';
        //过滤标签
        $text = real_strip_tags($text, ${$type . '_tags'});
        // 过滤攻击代码
        if ($type != 'all') {
            // 过滤危险的属性，如：过滤on事件lang js
            while (preg_match('/(<[^><]+)(ondblclick|onclick|onload|onerror|unload|onmouseover|onmouseup|onmouseout|onmousedown|onkeydown|onkeypress|onkeyup|onblur|onchange|onfocus|action|background[^-]|codebase|dynsrc|lowsrc)([^><]*)/i', $text, $mat)) {
                $text = str_ireplace($mat[0], $mat[1] . $mat[3], $text);
            }
            while (preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat)) {
                $text = str_ireplace($mat[0], $mat[1] . $mat[3], $text);
            }
        }
        return $text;
    }
}

if(!function_exists('text')){
    /**
     * 过滤函数，别名函数，op_t的别名
     * @param $text
     * @param bool|false $addslanshes
     * @return string
     */
    function text($text, $addslanshes = false)
    {
        return op_t($text, $addslanshes);
    }
}

if(!function_exists('html')){
    /**
     * 过滤函数，别名函数，op_h的别名
     * @param $text
     * @return string
     */
    function html($text)
    {
        return op_h($text);
    }
}

if(!function_exists('query_user')){
    /**
     * 支持的字段有
     * member表中的所有字段，ucenter_member表中的所有字段
     * 等级：title
     * 头像：avatar32 avatar64 avatar128 avatar256 avatar512
     * 个人中心地址：space_url
     *
     * @param      $fields array|string 如果是数组，则返回数组。如果不是数组，则返回对应的值
     * @param null $uid
     * @return array|null
     */
    function query_user($fields = null, $uid = null)
    {
        $uid = $uid == null ? is_login():$uid;
//    $user = new UserModel();
//    $info = $user->query_user($fields, $uid);
        $info = [];
        return $info;
    }
}

if(!function_exists('time_format')){
    /**
     * 时间戳格式化
     * @param null $time
     * @param string $format
     * @return bool|string
     */
    function time_format($time = NULL, $format = 'Y-m-d H:i')
    {
        $time = $time === NULL ? time() : intval($time);
        return date($format, $time);
    }
}

if(!function_exists('get_cover')){
    /**
     * 获取文档封面图片
     * @param int $cover_id
     * @param string $field
     * @return 完整的数据  或者  指定的$field字段值
     */
    function get_cover($cover_id, $field = null)
    {

        if (empty($cover_id)) {
            return false;
        }
        $tag = 'picture_' . $cover_id;
        $picture = cache($tag);
        if ($picture === false) {
            $picture = db("Picture")->where(['status' => 1,'id'=>$cover_id])->find();
            cache($tag, $picture);
        }
        $picture['path'] = get_pic_src($picture['path']);
        return empty($field) ? $picture : $picture[$field];
    }
}

if(!function_exists('get_pic_src')){
    /**
     * get_pic_src   渲染图片链接
     * @param $path
     * @return mixed
     */
    function get_pic_src($path)
    {
        //不存在http://
        $not_http_remote = (strpos($path, 'http://') === false);
        //不存在https://
        $not_https_remote = (strpos($path, 'https://') === false);
        if ($not_http_remote && $not_https_remote) {
            //本地url
            return str_replace('//', '/', getRootUrl() . $path); //防止双斜杠的出现
        } else {
            //远端url
            return $path;
        }
    }
}

if(!function_exists('getRootUrl')){
    /**获取网站的根Url
     * @return string
     */
    function getRootUrl()
    {

        $root = think_get_root();
        if ($root != '') {
            return $root.'/';
        }
        return $root;
    }
}

if(!function_exists('getThumbImageById')){
    /**通过ID获取到图片的缩略图
     * @param        $cover_id 图片的ID
     * @param int $width 需要取得的宽
     * @param string $height 需要取得的高
     * @param int $type 图片的类型，qiniu 七牛，local 本地, sae SAE
     * @param bool $replace 是否强制替换
     * @return string
     */
    function getThumbImageById($cover_id, $width = 100, $height = 'auto', $type = 0, $replace = false)
    {
        $picture = cache('picture_' . $cover_id);
        if (empty($picture)) {
            $picture = db("Picture")->where(['status' => 1,'id'=>$cover_id])->find();
            cache('picture_' . $cover_id, $picture);
        }
        if (empty($picture)) {
            return get_pic_src('static/images/nopic.png');
        }

        if ($picture['type'] == 'local') {
            $attach = getThumbImage($picture['path'], $width, $height, $type, $replace);
            return get_pic_src($attach['src']);
        }

    }
}

if(!function_exists('getThumbImage')){
    /** 不兼容sae 只兼容本地
     * @param        $filename
     * @param int $width
     * @param string $height
     * @param int $type
     * @param bool $replace
     * @return mixed|string
     */
    function getThumbImage($filename, $width = 100, $height = 'auto', $type = 0, $replace = false)
    {
        $UPLOAD_URL = '';
        $UPLOAD_PATH = '';
        $filename = str_ireplace($UPLOAD_URL, '', $filename); //将URL转化为本地地址
        $info = pathinfo($filename);
        $oldFile = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '.' . $info['extension'];
        $thumbFile = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '_' . $width . '_' . $height . '.' . $info['extension'];

        $oldFile = str_replace('\\', '/', $oldFile);
        $thumbFile = str_replace('\\', '/', $thumbFile);

        $filename = ltrim($filename, '/');
        $oldFile = ltrim($oldFile, '/');
        $thumbFile = ltrim($thumbFile, '/');

        if (!file_exists($UPLOAD_PATH . $oldFile)) {
            //原图不存在直接返回
            @unlink($UPLOAD_PATH . $thumbFile);
            $info['src'] = $oldFile;
            $info['width'] = intval($width);
            $info['height'] = intval($height);
            return $info;
        } elseif (file_exists($UPLOAD_PATH . $thumbFile) && !$replace) {
            //缩图已存在并且  replace替换为false
            $imageinfo = getimagesize($UPLOAD_PATH . $thumbFile);
            $info['src'] = $thumbFile;
            $info['width'] = intval($imageinfo[0]);
            $info['height'] = intval($imageinfo[1]);
            return $info;
        } else {
            //执行缩图操作
            $oldimageinfo = getimagesize($UPLOAD_PATH . $oldFile);
            $old_image_width = intval($oldimageinfo[0]);
            $old_image_height = intval($oldimageinfo[1]);
            if ($old_image_width <= $width && $old_image_height <= $height) {
                @unlink($UPLOAD_PATH . $thumbFile);
                @copy($UPLOAD_PATH . $oldFile, $UPLOAD_PATH . $thumbFile);
                $info['src'] = $thumbFile;
                $info['width'] = $old_image_width;
                $info['height'] = $old_image_height;
                return $info;
            } else {
                if ($height == "auto") $height = $old_image_height * $width / $old_image_width;
                if ($width == "auto") $width = $old_image_width * $width / $old_image_height;
                if (intval($height) == 0 || intval($width) == 0) {
                    return 0;
                }
                vendor("phpthumb.PhpThumbFactory");
                $thumb = PhpThumbFactory::create($UPLOAD_PATH . $filename);

                if ($type == 0) {
                    $thumb->adaptiveResize($width, $height);
                } else {
                    $thumb->resize($width, $height);
                }
                $res = $thumb->save($UPLOAD_PATH . $thumbFile);
                $info['src'] = $UPLOAD_PATH . $thumbFile;
                $info['width'] = $old_image_width;
                $info['height'] = $old_image_height;
                return $info;

            }
        }
    }
}

if(!function_exists('get_table_field')){
    /**
     * 根据条件字段获取指定表的数据
     * @param null $value 条件，可用常量或者数组
     * @param string $condition 条件字段
     * @param null $field 需要返回的字段，不传则返回整个数据
     * @param null $table 需要查询的表
     * @return bool
     */
    function get_table_field($value = null, $condition = 'id', $field = null, $table = null)
    {
        if (empty($value) || empty($table)) {
            return false;
        }

        //拼接参数
        $map[$condition] = $value;
        $info = db(ucfirst($table))->where($map);
        if (empty($field)) {
            $info = $info->field(true)->find();
        } else {
            $info = $info->value($field);
        }
        return $info;
    }
}

if(!function_exists("getSubByKey")){
    /**
     * 取一个二维数组中的每个数组的固定的键知道的值来形成一个新的一维数组
     * @param $pArray 一个二维数组
     * @param string $pKey 数组的键的名称
     * @param string $pCondition
     * @return array|bool 返回新的一维数组
     */
    function getSubByKey($pArray, $pKey = "", $pCondition = "")
    {
        $result = [];
        if (is_array($pArray)) {
            foreach ($pArray as $temp_array) {
                if (is_object($temp_array)) {
                    $temp_array = (array)$temp_array;
                }
                if (("" != $pCondition && $temp_array[$pCondition[0]] == $pCondition[1]) || "" == $pCondition) {
                    $result[] = ("" == $pKey) ? $temp_array : isset($temp_array[$pKey]) ? $temp_array[$pKey] : "";
                }
            }
            return $result;
        } else {
            return false;
        }
    }
}