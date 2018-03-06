<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin\builder;

class BackstageListBuilder extends BackstageBuilder{

    private $_title;//标题
    private $_buttonList = [];//按钮列表   默认、新增、编辑、禁用、启用等等
    private $_actionList = ['head'=>'操作', 'width'=>150, 'align'=>'center', 'actions'=>[]];//操作组件
    private $_columns = [];//head 表头
    private $_data = [];//数据
    private $_pagination = [];//分页
    
    private $_setStatusUrl;
    private $_searchPostUrl;


    /**设置页面标题
     * @param $title 标题文本
     * @return $this
     */
    public function title($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**加入一个按钮
     * @param $title
     * @param $attr
     * @return $this
     */
    public function button($title, $attr)
    {
        $this->_buttonList[] = ['title' => $title, 'attr' => $attr];
        return $this;
    }

    /**加入新增按钮
     * @param        $link
     * @param string $title
     * @param array $attr
     * @return BackstageListBuilder
     */
    public function buttonNew($link, $title = '新增', $attr = [])
    {
        $attr['link-path'] = $link;
        $attr['class'] = 'ivu-btn ivu-btn-info';
        $attr['icon'] = 'plus';
        return $this->button($title, $attr);
    }

    /**
    * 设置状态的按钮
    * @date: 2018年1月26日 上午10:21:32
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function buttonSetStatus($url, $status, $title, $attr)
    {

        $attr['class'] = isset($attr['class']) ? $attr['class'] : 'ivu-btn ivu-btn-primary ajax-post';
        $attr['url'] = $this->addUrlParam($url, ['status' => $status]);
        $attr['target-form'] = 'ids';
        return $this->button($title, $attr);
    }

    /**
    * 禁用按钮
    * @date: 2018年1月26日 上午10:21:48
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function buttonDisable($url = null, $title = '禁用', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        $attr['class'] = 'ivu-btn ivu-btn-warning ajax-post';
        $attr['icon'] = 'minus';
        $attr['click'] = 'modalDisable = true';
        return $this->buttonSetStatus($url, 0, $title, $attr);
    }

    /**
    * 启用按钮
    * @date: 2018年1月26日 上午10:21:58
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function buttonEnable($url = null, $title = '启用', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        $attr['class']='ivu-btn ivu-btn-success ajax-post';
        $attr['icon'] = 'checkmark';
        $attr['click'] = 'modalEnable = true';
        return $this->buttonSetStatus($url, 1, $title, $attr);
    }
    /**
     * 删除到回收站
     */
    public function buttonDelete($url = null, $title = '删除', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        $attr['class']='ivu-btn ivu-btn-error ajax-post';
        $attr['icon'] = 'android-delete';
        return $this->buttonSetStatus($url, -1, $title, $attr);
    }

    /**
    * 还原按钮
    * @date: 2018年1月26日 上午10:31:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function buttonRestore($url = null, $title = '还原', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        $attr['class']='ivu-btn ivu-btn-restore ajax-post';
        $attr['type'] = 'ghost';
        $attr['icon'] = 'social-designernews';
        return $this->buttonSetStatus($url, 1, $title, $attr);
    }
    
    /**
    * 开启选择框
    * @date: 2018年1月29日 下午4:58:15
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keySelection()
    {
        return $this->key('', '', 'selection', 60, ['align'=>'center']);
    }
    
    /**
    * 开启行数记录
    * @date: 2018年1月29日 下午6:19:32
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyIndex()
    {
        return $this->key('', '', 'index', 60, ['align'=>'center']);
    }

    /**
     * 显示纯文本
     * @param $name 键名
     * @param $title 标题
     * * @param $opt 选项
     * @return BackstageListBuilder
     */
    public function keyText($name, $title, $opt = null)
    {
        return $this->key($name, text($title), 'text' , '', $opt);
    }

    /**
    * 替换数据 用于状态等数字转文字的操作
    * @date: 2018年1月29日 下午5:10:04
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyMap($name, $title, $map)
    {
        return $this->key($name, $title, 'map', '', $map);
    }

    /**
     * keyLinkByFlag  带替换表示的链接
     * @param        $name
     * @param        $title
     * @param        $getUrl
     * @param string $flag
     * @return $this
     */
    public function keyLinkByFlag($name, $title, $getUrl, $flag = 'id')
    {
        return $this->key($name, $title, 'link', '', ['link' => $getUrl, 'pk' => $flag]);
    }
    
    /**
    * 时间转换
    * @date: 2018年1月30日 下午2:28:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyTime($name, $title, $opt = null)
    {
        return $this->key($name, $title, 'time', '', $opt);
    }
    
    /**
    * 编辑操作
    * @date: 2018年1月30日 上午10:13:48
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyEditAction($getUrl, $text = '编辑', $title = '操作')
    {
        $render = ['props' => ['type' => 'primary', 'size' => 'small'], 'style' => ['marginRight' => '5px']];
        
        return $this->keyDoAction($getUrl, $text, $title, $render);
    }
    
    /**
    * 删除操作
    * @date: 2018年1月30日 上午10:28:40
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyDelAction($getUrl, $text = '删除', $title = '操作')
    {
        $render = ['props' => ['type' => 'error', 'size' => 'small'], 'style' => ['marginRight' => '5px']];
        
        return $this->keyDoAction($getUrl, $text, $title, $render);
    }

    /**
    * 操作基础函数
    * @date: 2018年1月29日 下午5:10:45
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function keyDoAction($getUrl, $text, $title = '操作', $render = ['props' => ['size' => 'small'], 'style' => ['marginRight' => '5px']])
    {
        $this->_actionList['head'] = $title;
        $this->_actionList['actions'][] = ['text' => $text, 'get_url' => $getUrl, 'props' => json_encode($render['props']), 'style' => json_encode($render['style'])];
        return $this;
    }

    /**
     * 不要给listRows默认值，因为开发人员很可能忘记填写listRows导致翻页不正确
     * @param $totalCount
     * @param $listRows
     * @return $this
     */
    public function pagination($totalCount, $listRows)
    {
        $this->_pagination = ['totalCount' => $totalCount, 'listRows' => $listRows];
        return $this;
    }

    public function data($list)
    {
        $this->_data = $list;
        return $this;
    }

    public function show()
    {
        //map转换成text
        $this->convertKey('map', 'text', function ($value, $key) {
            return $key['opt'][$value];
        });

        //time转换成text
        $this->convertKey('time', 'text', function ($value, $key) {
            $format = !empty($key['opt']['format']) ? $key['opt']['format'] : 'Y-m-d H:i';
            if ($value != 0) {
                return time_format($value, $format);
            } else {
                return '-';
            }
        });

        //text转换成html
        $this->convertKey('text', 'html', function ($value) {
            return $value;
        });
        
        //link转换为html
        $this->convertKey('link', 'html', function ($value, $key, $item) {
            $value = htmlspecialchars($value);
            $url = $key['opt']['link']. '?' . $key['opt']['pk'] . '=' . $item[$key['opt']['pk']];
            
            //允许字段为空，如果字段名为空将标题名填充到A变现里
            if (!$value) {
                return "<a href=\"$url\">" . $key['title'] . "</a>";
            } else {
                return "<a href=\"$url\">$value</a>";
            }
        });

        //显示页面
        $this->assign('title', $this->_title);
        $this->assign('columns', json_encode($this->_columns));
        $this->assign('buttonList', json_encode($this->_buttonList));
        $this->assign('actionList', json_encode($this->_actionList));
        $this->assign('list', json_encode($this->_data));
        $this->assign('searchPostUrl', $this->_searchPostUrl);
        return $this->fetch(parent::display('admin_list'));
    }

    /**
    * 基础设置
    * @date: 2018年1月29日 下午4:36:59
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function key($name, $title, $type, $width = 150, $opt = [])
    {
        $key = [];
        
        if (!empty($name)) $key['key'] = $name;
        if (!empty($title)) $key['title'] = $title;
        if (!empty($type)) $key['type'] = $type;
        if (!empty($width)) $key['width'] = $width;
        
        if(sizeof($opt) > 0) {
            foreach ($opt as $kk=>$kv) {
                switch ($kk) {
                    case 'align':
                    case 'className':
                    case 'fixed':
                    case 'ellipsis':
                    case 'render':
                    case 'renderHeader':
                    case 'sortable':
                    case 'sortMethod':
                    case 'sortType':
                    case 'filters':
                    case 'filterMethod':
                    case 'filterMultiple':
                    case 'filteredValue':
                    case 'filterRemote':
                        $key[$kk] = $kv;
                    break;
                }
            }
        }
        
        $key['opt'] = $opt;
        
        $this->_columns[] = $key;
        return $this;
    }

    /**
    * 转义基础函数
    * @date: 2018年1月29日 下午5:39:34
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function convertKey($from, $to, $convertFunction)
    {
        foreach ($this->_columns as &$key) {
            if (isset($key['type']) && $key['type'] == $from) {
                $key['type'] = $to;
                foreach ($this->_data as &$data) {
                    $value = &$data[$key['key']];
                    $value = $convertFunction($value, $key, $data);
                    unset($value);
                }
                unset($data);
            }
        }
        unset($key);
    }

    /**
    * 处理url地址的函数
    * @date: 2018年1月29日 下午5:40:03
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function addUrlParam($url, $params)
    {
        if (strpos($url, '?') === false) {
            $seperator = '?';
        } else {
            $seperator = '&';
        }
        $params = http_build_query($params);
        return $url . $seperator . $params;
    }

    /**解析Url
     * @param $pattern URL文本
     * @param $flag
     * @return callable
     */
    private function ParseUrl($pattern, $flag)
    {
        return function ($item) use ($pattern, $flag) {

            $pattern = str_replace('###', $item[$flag], $pattern);
            //调用ThinkPHP中的解析引擎解析变量
            $view = new \think\View();
            $view->assign($item);
            $pattern = $view->fetch('', $pattern);
            return url($pattern);
        };
    }
}