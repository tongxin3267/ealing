<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin\builder;

class BackstageListBuilder extends  BackstageBuilder{

    private $_title;
    private $_suggest;
    private $_tips;
    private $_keyList = [];
    private $_buttonList = [];
    private $_pagination = [];
    private $_data = [];
    private $_setStatusUrl;
    private $_searchPostUrl;
    private $_setDeleteTrueUrl;

    private  $_searchSelect = [];
    private  $_searchText = [];
    private  $_datetime = [];
    private $_form=[];

    /**设置页面标题
     * @param $title 标题文本
     * @return $this
     */
    public function title($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * suggest  页面标题边上的提示信息
     * @param $suggest
     * @return $this
     */
    public function suggest($suggest)
    {
        $this->_suggest = $suggest;
        return $this;
    }

    public function tips($content)
    {
        $this->_tips = $content;
        return $this;
    }

    /**
     * @param $url string 已被url函数解析的地址
     * @return $this
     */
    public function setStatusUrl($url)
    {
        $this->_setStatusUrl = $url;
        return $this;
    }

    /**设置回收站根据ids彻底删除的URL
     * @param $url
     * @return $this
     */
    public function setDeleteTrueUrl($url)
    {
        $this->_setDeleteTrueUrl = $url;
        return $this;
    }

    /**
     * 筛选搜索功能 提交地址
     * @param $url  提交的getURL
     * @return $this
     */
    public function setSearchPostUrl($url)
    {
        $this->_searchPostUrl = $url;
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
     * attr中设置（'hide-data' => 'true'）表示，不必须要勾选对象，即不必须ids有值
     * @param $url
     * @param $params
     * @param $title
     * @param array $attr
     * @return $this
     */
    public function ajaxButton($url, $params, $title, $attr = [])
    {
        $attr['class'] = 'ivu-btn ajax-post';
        $attr['link-path'] = $this->addUrlParam($url, $params);
        $attr['target-form'] = 'ids';
        $attr[':loading'] = 'loading';
        $attr['@click'] = '';
        return $this->button($title, $attr);
    }

    /**加入模态弹窗按钮
     * @param $url
     * @param $params
     * @param $title
     * @param array $attr
     * @return $this
     */
    public function buttonModalPopup($url, $params, $title, $attr = [])
    {
        //$attr中可选参数，data-title：模态框标题，target-form：要传输的数据
        $attr['modal-url'] = $this->addUrlParam($url, $params);
        $attr['data-role'] = 'modal_popup';
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

    public function buttonRestore($url = null, $title = '还原', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        return $this->buttonSetStatus($url, 1, $title, $attr);
    }

    /**清空回收站
     * @param null $model
     * @return $this
     */
    public function buttonClear($model = null)
    {
        return $this->button('清空', ['class' => 'layui-btn layui-btn-primary ajax-post tox-confirm', 'data-confirm' => '您确实要清空回收站吗？（清空后不可恢复）', 'url' => url('', ['model' => $model]), 'target-form' => 'ids', 'hide-data' => 'true']);
    }

    /**彻底删除
     * @param null $url
     * @return $this
     */
    public function buttonDeleteTrue($url = null)
    {
        if (!$url) $url = $this->_setDeleteTrueUrl;
        $attr['class'] = 'layui-btn layui-btn-primary ajax-post tox-confirm';
        $attr['data-confirm'] = "您确实要彻底删除吗？（彻底删除后不可恢复）";
        $attr['url'] = $url;
        $attr['target-form'] = 'ids';
        return $this->button("彻底删除", $attr);
    }

    public function buttonSort($href, $title = '排序', $attr = [])
    {
        $attr['class'] = 'layui-btn layui-btn-warm';
        $attr['href'] = $href;
        return $this->button($title, $attr);
    }

    /**
     * 添加筛选功能 下拉框
     * @param string $title 标题
     * @param string $name 键名
     * @param string $type 类型，默认文本
     * @param string $des 描述
     * @param        $attr  标签文本
     * @param string $arrvalue 筛选数据（包含ID 和value的数组:array(array('id'=>1,'value'=>'系统'),array('id'=>2,'value'=>'项目'),array('id'=>3,'value'=>'机构'));）
     * @return $this
     */
    public function searchSelect($title = '筛选', $name = 'key', $type = 'select', $des = '', $attr='',  $arrvalue = null)
    {
        $this->_searchSelect[] = ['title' => $title, 'name' => $name, 'type' => $type, 'des' => $des, 'attr' => $attr, 'arrvalue' => $arrvalue];
        return $this;
    }

    /**
     * 添加筛选功能  文本框
     * @param string $title
     * @param string $name
     * @param string $type
     * @param string $des
     * @param $attr
     * @return $this
     */
    public function searchText($title = '关键词', $name = 'key', $type = 'text', $des = '', $attr='')
    {
        $this->_searchText[] = ['title' => $title, 'name' => $name, 'type' => $type, 'des' => $des, 'attr' => $attr];
        return $this;
    }

    /**
     * 添加筛选功能   选择日期
     * @param string $title
     * @param string $name
     * @param string $type
     * @param string $des
     * @param $attr
     * @return $this
     */
    public function searchDateTime($title = '日期', $name = 'key', $type = 'datetime', $des = '', $attr='')
    {
        $this->_datetime[] = ['title' => $title, 'name' => $name, 'type' => $type, 'des' => $des, 'attr' => $attr];
        return $this;
    }

    public function selectPlateForm($id,$method,$action)
    {
        $this->_form[]=['id'=>$id,'method'=>$method,'action'=>$action];
        return $this;
    }

    public function key($name, $title, $type, $opt = null, $width = '150px')
    {
        $key = ['name' => $name, 'title' => $title, 'type' => $type, 'opt' => $opt, 'width' => $width];
        $this->_keyList[] = $key;
        return $this;
    }

    /**显示纯文本
     * @param $name 键名
     * @param $title 标题
     * * @param $opt 选项
     * @return BackstageListBuilder
     */
    public function keyText($name, $title ,$opt = null)
    {
        return $this->key($name, text($title), 'text' , $opt);
    }

    /**显示html
     * @param $name 键名
     * @param $title 标题
     * @return BackstageListBuilder
     */
    public function keyHtml($name, $title, $width = '150px')
    {
        return $this->key($name, op_h($title), 'html', null, $width);
    }

    public function keyMap($name, $title, $map)
    {
        return $this->key($name, $title, 'map', $map);
    }

    public function keyId($name = 'id', $title = 'ID')
    {
        return $this->keyText($name, $title);
    }

    /**
     * 图标展示
     * @param string $name
     * @param string $title
     * @return $this
     */
    public function keyIcon($name = 'icon', $title = '图标')
    {
        return $this->key($name, $title, 'icon');
    }

    /**
     * @param $name
     * @param $title
     * @param $getUrl Closure|string
     * 可以是函数或U函数解析的字符串。如果是字符串，该函数将附带一个id参数
     *
     * @return $this
     */
    public function keyLink($name, $title, $getUrl)
    {
        //如果getUrl是一个字符串，则表示getUrl是一个U函数解析的字符串
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }

        //修整添加多个空字段时显示不正常的BUG@mingyangliu
        if (empty($name)) {
            $name = $title;
        }

        //添加key
        return $this->key($name, $title, 'link', $getUrl);
    }

    public function keyStatus($name = 'status', $title = '状态')
    {
        $map = [-1 => '删除', 0 => '禁用', 1 => '启用', 2 => '未审核'];
        return $this->key($name, $title, 'status', $map);
    }

    public function keyYesNo($name, $title)
    {
        $map = [0 => "否", 1 => "是"];
        return $this->keymap($name, $title, $map);
    }

    public function keyBool($name, $title)
    {
        return $this->keyYesNo($name, $title);
    }

    public function keyImage($name, $title)
    {
        return $this->key($name, $title, 'image');
    }

    public function keyMultiImage($name, $title)
    {
        return $this->key($name, $title, 'multiImage');
    }

    public function keyTime($name, $title)
    {
        return $this->key($name, $title, 'time');
    }

    public function keyCreateTime($name = 'create_time', $title = '创建时间')
    {
        return $this->keyTime($name, $title);
    }

    public function keyUpdateTime($name = 'update_time', $title = '更新时间')
    {
        return $this->keyTime($name, $title);
    }

    public function keyUid($name = 'uid', $title = '用户')
    {
        return $this->key($name, $title, 'uid');
    }

    public function keyNickname($name = 'uid', $title, $subtitle = null)
    {
        return $this->key($name, $title, $subtitle, 'nickname');
    }

    public function keyTitle($name = 'title', $title = '标题')
    {
        return $this->keyText($name, $title);
    }

    //关联表字段显示+URL连接
    public function keyJoin($name, $title, $mate, $return, $model, $url = '')
    {
        $map = array('mate' => $mate, 'return' => $return, 'model' => $model, 'url' => $url);
        return $this->key($name, $title, 'Join', $map);
    }

    /**
     * 模态弹窗
     * @param $getUrl
     * @param $text
     * @param $title
     * @param array $attr
     * @return $this
     */
    public function keyDoActionModalPopup($getUrl, $text, $title, $attr = [])
    {
        //attr中需要设置data-title，用于设置模态弹窗标题
        $attr['data-role'] = 'modal_popup';
        //获取默认getUrl函数
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }
        //确认已经创建了DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as $key) {
            if ($key['name'] === 'DOACTIONS') {
                $doActionKey = $key;
                break;
            }
        }
        if (!$doActionKey) {
            $this->key('DOACTIONS', $title, 'doaction', $attr);
        }

        //找出第一个DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as &$key) {
            if ($key['name'] == 'DOACTIONS') {
                $doActionKey = &$key;
                break;
            }
        }

        //在DOACTIONS中增加action
        $doActionKey['opt']['actions'][] = ['text' => $text, 'get_url' => $getUrl, 'opt' => $attr];
        return $this;
    }

    public function keyDoActionAjax($getUrl, $text,$attr = [] ,$title = '操作'){
        //获取默认getUrl函数
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }

        //确认已经创建了DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as $key) {
            if ($key['name'] === 'DOACTIONS') {
                $doActionKey = $key;
                break;
            }
        }

        if (!$doActionKey) {
            $this->key('DOACTIONS', $title, 'doaction', []);
        }

        //找出第一个DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as &$key) {
            if ($key['name'] == 'DOACTIONS') {
                $doActionKey = &$key;
                break;
            }
        }

        //在DOACTIONS中增加action
        $doActionKey['opt']['actions'][] = ['text' => $text, 'get_url' => $getUrl,'opt' => $attr];
        return $this;
    }


    public function keyDoAction($getUrl, $text, $title = '操作')
    {
        //获取默认getUrl函数
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }

        //确认已经创建了DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as $key) {
            if ($key['name'] === 'DOACTIONS') {
                $doActionKey = $key;
                break;
            }
        }

        if (!$doActionKey) {
            $this->key('DOACTIONS', $title, 'doaction', []);
        }

        //找出第一个DOACTIONS字段
        $doActionKey = null;
        foreach ($this->_keyList as &$key) {
            if ($key['name'] == 'DOACTIONS') {
                $doActionKey = &$key;
                break;
            }
        }

        //在DOACTIONS中增加action
        $doActionKey['opt']['actions'][] = ['text' => $text, 'get_url' => $getUrl];
        return $this;
    }

    public function keyDoActionEdit($getUrl, $text = '编辑')
    {
        return $this->keyDoAction($getUrl, $text);
    }

    public function keyDoActionRestore($text = '还原')
    {
        $that = $this;
        $setStatusUrl = $this->_setStatusUrl;
        $getUrl = function () use ($that, $setStatusUrl) {
            return $that->addUrlParam($setStatusUrl, ['status' => 1]);
        };
        return $this->keyDoAction($getUrl, $text, ['class' => 'ajax-get']);
    }

    public function keyTruncText($name, $title, $length)
    {
        return $this->key($name, $title, 'trunktext', $length);
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
        //key类型的等价转换
        //map转换成text
        $this->convertKey('map', 'text', function ($value, $key) {
            return $key['opt'][$value];
        });

        //uid转换成text
        $this->convertKey('uid', 'text', function ($value) {
            $value = query_user(['nickname', 'uid', 'space_url'], $value);
            return "<a href='" . $value['space_url'] . "' target='_blank'>[{$value[uid]}]" . $value['nickname'] . '</a>';
        });

        //nickname转换成text
        $this->convertKey('nickname', 'text', function ($value) {
            $value = query_user(['nickname', 'uid', 'space_url'], $value);
            return "<a href='" . $value['space_url'] . "' target='_blank'>[{$value[uid]}]" . $value['nickname'] . '</a>';
        });

        //time转换成text
        $this->convertKey('time', 'text', function ($value) {
            if ($value != 0) {
                return time_format($value);
            } else {
                return '-';
            }
        });

        //trunctext转换成text
        $this->convertKey('trunktext', 'text', function ($value, $key) {
            $length = $key['opt'];
            return msubstr($value, 0, $length);
        });

        //text转换成html
        $this->convertKey('text', 'html', function ($value) {
            return $value;
        });

        //link转换为html
        $this->convertKey('link', 'html', function ($value, $key, $item) {
            $value = htmlspecialchars($value);
            $getUrl = $key['opt'];
            $url = $getUrl($item);
            //允许字段为空，如果字段名为空将标题名填充到A变现里
            if (!$value) {
                return "<a href=\"$url\">" . $key['title'] . "</a>";
            } else {
                return "<a href=\"$url\">$value</a>";
            }
        });

        //如果icon为空
        $this->convertKey('icon', 'html', function ($value, $key, $item) {
            $value = htmlspecialchars($value);
            if ($value == '') {
                $html = '无';
            } else {
                $html = "<i class=\"$value\"></i> $value";
            }
            return $html;
        });

        //image转换为图片

        $this->convertKey('image', 'html', function ($value, $key, $item) {
            if (intval($value)) { //value是图片id
                $value = htmlspecialchars($value);
                $sc_src = get_cover($value, 'path');

                $src = getThumbImageById($value, 80, 80);
                $sc_src = $sc_src == '' ? $src : $sc_src;
                $html = "<div class='popup-gallery'><a title=\"" . '查看大图' . "\" href=\"$sc_src\"><img src=\"$sc_src\"/ style=\"width:80px;height:80px\"></a></div>";
            } else {//value是图片路径
                $sc_src = $value;
                $html = "<div class='popup-gallery'><a title=\"" . '查看大图' . "\" href=\"$sc_src\"><img src=\"$sc_src\"/ style=\"border-radius:100%;\"></a></div>";
            }
            return $html;
        });

        $this->convertKey('multiImage', 'html', function ($value, $key, $item) {
            $html="<div class='popup-gallery'>";
            if($value){
                $value=explode(',',$value);
                foreach($value as $val){
                    $val = htmlspecialchars($val);
                    $sc_src = get_cover($val, 'path');

                    $src = getThumbImageById($val, 80, 80);
                    $sc_src = $sc_src == '' ? $src : $sc_src;
                    $html .= "<a title=\"" . '查看大图' . "\" href=\"$sc_src\" style='margin-right:5px;'><img src=\"$sc_src\"/ style=\"width:80px;height:80px\"></a>";
                }
            }
            $html.="</div>";
            return $html;
        });

        //doaction转换为html
        $this->convertKey('doaction', 'html', function ($value, $key, $item) {
            $actions = $key['opt']['actions'];
            $result = [];
            foreach ($actions as $action) {
                $getUrl = $action['get_url'];
                $linkText = $action['text'];
                $url = $getUrl($item);
                if (isset($action['opt'])) {
                    $content = [];
                    foreach ($action['opt'] as $key => $value) {
                        $value = htmlspecialchars($value);
                        $content[] = "$key=\"$value\"";
                    }
                    $content = implode(' ', $content);
                    if (isset($action['opt']['data-role']) && $action['opt']['data-role'] == "modal_popup") {//模态弹窗
                        $result[] = "<a href=\" javascript:void(0);\" modal-url=\"$url\" " . $content . ">$linkText</a>";
                    } else {
                        $result[] = "<a href=\"$url\" " . $content . ">$linkText</a>";
                    }
                } else {
                    $result[] = "<a href=\"$url\">$linkText</a>";
                }
            }
            return implode(' ', $result);
        });
        //Join转换为html
        $this->convertKey('Join', 'html', function ($value, $key) {
            if ($value != 0) {
                $val = get_table_field($value, $key['opt']['mate'], $key['opt']['return'], $key['opt']['model']);
                if (!$key['opt']['url']) {
                    return $val;
                } else {
                    $urld = url($key['opt']['url'], [$key['opt']['return'] => $value]);
                    return "<a href=\"$urld\">$val</a>";
                }
            } else {
                return '-';
            }
        });

        //status转换为html
        $setStatusUrl = $this->_setStatusUrl;
        $that = &$this;
        $this->convertKey('status', 'html', function ($value, $key, $item) use ($setStatusUrl, $that) {
            //如果没有设置修改状态的URL，则直接返回文字
            $map = $key['opt'];
            $text = $map[$value];
            if (!$setStatusUrl) {
                return $text;
            }

            //返回带链接的文字
            $switchStatus = $value == 1 ? 0 : 1;
            $url = $that->addUrlParam($setStatusUrl, ['status' => $switchStatus, 'ids' => $item['id']]);
            return "<a href=\"{$url}\" class=\"ajax-get\">$text</a>";
        });

        //如果html为空
        $this->convertKey('html', 'html', function ($value) {
            if ($value === '') {
                return '<span style="color:#bbb;">（空）</span>';
            }
            return $value;
        });


        //编译buttonList中的属性
        foreach ($this->_buttonList as &$button) {
            $button['tag'] = 'i-button';
            $button['attr'] = $this->compileHtmlAttr($button['attr']);
        }

        //生成翻页HTML代码
        config('VAR_PAGE', 'page');
        if(!empty($this->_pagination['totalCount'])){
            $pager = new \think\PageBack($this->_pagination['totalCount'], $this->_pagination['listRows'], $_REQUEST);
            $pager->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $paginationHtml = $pager->show();
        }else{
            $paginationHtml = '';
        }

        //显示页面
        $this->assign('title', $this->_title);
        $this->assign('meta_title', $this->_title);
        $this->assign('suggest', $this->_suggest);
        $this->assign('tips', $this->_tips);
        $this->assign('keyList', $this->_keyList);
        $this->assign('buttonList', $this->_buttonList);
        $this->assign('pagination', $paginationHtml);
        $this->assign('list', $this->_data);
        $this->assign('searchPostUrl', $this->_searchPostUrl);
        $this->assign('selects', $this->_searchSelect);
        $this->assign('texts', $this->_searchText);
        $this->assign('datetime', $this->_datetime);
        return $this->fetch(parent::display('admin_list'));
    }

    public function doSetStatus($model, $ids, $status = 1)
    {

        $id = array_unique((array)$ids);
        $rs = db($model)->where(['id' => ['in', $id]])->update(['status' => $status]);
        if ($rs === false) {
            $this->error("设置失败。");
        }
        $this->success("设置成功");
    }


    private function convertKey($from, $to, $convertFunction)
    {
        foreach ($this->_keyList as &$key) {
            if ($key['type'] == $from) {
                $key['type'] = $to;
                foreach ($this->_data as &$data) {
                    $value = &$data[$key['name']];
                    $value = $convertFunction($value, $key, $data);
                    unset($value);
                }
                unset($data);
            }
        }
        unset($key);
    }

    private function addDefaultCssClass(&$button)
    {
        if (!isset($button['attr']['class'])) {
            $button['attr']['class'] = 'layui-btn layui-btn-primary';
        }
    }

    /**
     * @param $pattern url函数解析的URL字符串
     * Backstage/Test/index?test_id={other_id}
     * ###将被id替换
     * {other_id}将被替换
     * @return callable
     */
    private function createDefaultGetUrlFunction($pattern)
    {
        $explode = explode('|', $pattern);
        $pattern = $explode[0];
        $fun = empty($explode[1]) ? 'url' : $explode[1];
        return function ($item) use ($pattern, $fun) {
            $pattern = str_replace('###', $item['id'], $pattern);

            //调用ThinkPHP中的解析引擎解析变量
            $view = new \think\View();
            $view->assign($item);
            $pattern = $view->display($pattern);
            return $fun($pattern);
        };
    }

    public function addUrlParam($url, $params)
    {
        if (strpos($url, '?') === false) {
            $seperator = '?';
        } else {
            $seperator = '&';
        }
        $params = http_build_query($params);
        return $url . $seperator . $params;
    }

    /**自动处理清空回收站
     * @param string $model 要清空的模型
     */
    public function clearTrash($model = '')
    {
        if (Request()->isPost()) {
            if ($model != '') {
                $aIds = input('post.ids', []);
                if (!empty($aIds)) {
                    $map['id'] = ['in', $aIds];
                } else {
                    $map['status'] = -1;
                }

                $result = db($model)->where($map)->delete();
                if ($result) {
                    $this->success("成功清空回收站，共删除  {$result}   条记录。");
                }
                $this->error("回收站是空的，未能删除任何东西。");
            } else {
                $this->error("请选择要清空的模型。");
            }
        }
    }

    /**执行彻底删除数据，只适用于无关联的数据表
     * @param $model
     * @param $ids
     */
    public function doDeleteTrue($model, $ids)
    {
        $ids = is_array($ids) ? $ids : explode(',', $ids);
        db($model)->where(['id' => ['in', $ids]])->delete();
        $this->success("彻底删除成功");
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

        //如果getUrl是一个字符串，则表示getUrl是一个U函数解析的字符串
        if (is_string($getUrl)) {
            $getUrl = $this->ParseUrl($getUrl, $flag);
        }

        //添加key
        return $this->key($name, $title, 'link', $getUrl);
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