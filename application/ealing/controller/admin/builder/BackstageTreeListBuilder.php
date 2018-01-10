<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/9
 */
namespace app\ealing\controller\admin\builder;

class BackstageTreeListBuilder extends BackstageBuilder
{
    private $_title;
    private $_suggest;
    private $_keyList = [];
    private $_buttonList = [];
    private $_pagination = [];
    private $_data = [];
    private $_setStatusUrl;
    private $_level = 2;
    private $_model = '';

    private $_move=false;
    private $_merge=false;

    public function title($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * suggest  ҳ�������ϵ���ʾ��Ϣ
     * @param $suggest
     * @return $this
     */
    public function suggest($suggest){
        $this->_suggest = $suggest;
        return $this;
    }
    /**
     * @param $url string �ѱ�U���������ĵ�ַ
     * @return $this
     */
    public function setStatusUrl($url)
    {
        $this->_setStatusUrl = $url;
        return $this;
    }

    public function button($title, $attr)
    {
        $this->_buttonList[] = ['title' => $title, 'attr' => $attr];
        return $this;
    }

    public function buttonNew($href, $title = '����', $attr =[])
    {
        $attr['href'] = $href;
        $attr['class'] = 'layui-btn';
        return $this->button($title, $attr);
    }

    public function buttonSetStatus($url, $status, $title, $attr)
    {
        $attr['class'] = 'layui-btn layui-btn-primary ajax-post';
        $attr['url'] = $this->addUrlParam($url, ['status' => $status]);
        $attr['target-form'] = 'ids';
        return $this->button($title, $attr);
    }

    public function buttonDisable($url = null, $title = '����', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        return $this->buttonSetStatus($url, 0, $title, $attr);
    }

    public function buttonEnable($url = null, $title = '����', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        return $this->buttonSetStatus($url, 1, $title, $attr);
    }

    /**
     * ɾ��������վ
     */
    public function buttonDelete($url = null, $title = 'ɾ��', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        return $this->buttonSetStatus($url, -1, $title, $attr);
    }

    public function buttonRestore($url = null, $title = '��ԭ', $attr = [])
    {
        if (!$url) $url = $this->_setStatusUrl;
        return $this->buttonSetStatus($url, 1, $title, $attr);
    }

    public function buttonSort($href, $title = '����', $attr = [])
    {
        $attr['href'] = $href;
        return $this->button($title, $attr);
    }

    public function key($name, $title, $type, $opt = null)
    {
        $key = ['name' => $name, 'title' => $title, 'type' => $type, 'opt' => $opt];
        $this->_keyList[] = $key;
        return $this;
    }

    public function keyText($name, $title)
    {
        return $this->key($name, $title, 'text');
    }

    public function keyHtml($name, $title)
    {
        return $this->key($name, $title, 'html');
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
     * @param $name
     * @param $title
     * @param $getUrl Closure|string
     * �����Ǻ�����U�����������ַ�����������ַ������ú���������һ��id����
     *
     * @return $this
     */
    public function keyLink($name, $title, $getUrl)
    {
        //���getUrl��һ���ַ��������ʾgetUrl��һ��U�����������ַ���
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }

        //���key
        return $this->key($name, $title, 'link', $getUrl);
    }

    public function keyStatus($name = 'status', $title = '״̬')
    {
        $map = [-1 => "ɾ��", 0 => "����", 1 => "����", 2 => 'δ���'];
        return $this->key($name, $title, 'status', $map);
    }

    public function keyYesNo($name, $title)
    {
        $map = [0 => "��", 1 => "��"];
        return $this->keymap($name, $title, $map);
    }

    public function keyBool($name, $title)
    {
        return $this->keyYesNo($name, $title);
    }

    public function keyTime($name, $title)
    {
        return $this->key($name, $title, 'time');
    }

    public function keyCreateTime($name = 'create_time', $title = '����ʱ��')
    {
        return $this->keyTime($name, $title);
    }

    public function keyUpdateTime($name = 'update_time', $title = '����ʱ��')
    {
        return $this->keyTime($name, $title);
    }

    public function keyUid($name = 'uid', $title = '�û�')
    {
        return $this->key($name, $title, 'uid');
    }

    public function keyTitle($name = 'title', $title = '����')
    {
        return $this->keyText($name, $title);
    }

    public function keyDoAction($getUrl, $text, $title = '����')
    {
        //��ȡĬ��getUrl����
        if (is_string($getUrl)) {
            $getUrl = $this->createDefaultGetUrlFunction($getUrl);
        }

        //ȷ���Ѿ�������DOACTIONS�ֶ�
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

        //�ҳ���һ��DOACTIONS�ֶ�
        $doActionKey = null;
        foreach ($this->_keyList as &$key) {
            if ($key['name'] == 'DOACTIONS') {
                $doActionKey = &$key;
                break;
            }
        }

        //��DOACTIONS������action
        $doActionKey['opt']['actions'][] = ['text' => $text, 'get_url' => $getUrl];
        return $this;
    }

    public function keyDoActionEdit($getUrl, $text = '�༭')
    {
        return $this->keyDoAction($getUrl, $text);
    }

    public function keyDoActionRestore($text = '��ԭ')
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
     * ��Ҫ��listRowsĬ��ֵ����Ϊ������Ա�ܿ���������дlistRows���·�ҳ����ȷ
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
        //key���͵ĵȼ�ת��
        //mapת����text
        $this->convertKey('map', 'text', function ($value, $key) {
            return $key['opt'][$value];
        });

        //uidת����text
        $this->convertKey('uid', 'text', function ($value) {
            $value = query_user(['username', 'uid'], $value);
            return "[{$value[uid]}]" . $value['username'];
        });

        //timeת����text
        $this->convertKey('time', 'text', function ($value) {
            return time_format($value);
        });

        //trunctextת����text
        $this->convertKey('trunktext', 'text', function ($value, $key) {
            $length = $key['opt'];
            return msubstr($value, 0, $length);
        });

        //textת����html
        $this->convertKey('text', 'html', function ($value) {
            return htmlspecialchars($value);
        });

        //linkת��Ϊhtml
        $this->convertKey('link', 'html', function ($value, $key, $item) {
            $value = htmlspecialchars($value);
            $getUrl = $key['opt'];
            $url = $getUrl($item);
            return "<a href=\"$url\">$value</a>";
        });

        //doactionת��Ϊhtml
        $this->convertKey('doaction', 'html', function ($value, $key, $item) {
            $actions = $key['opt']['actions'];
            $result = [];
            foreach ($actions as $action) {
                $getUrl = $action['get_url'];
                $linkText = $action['text'];
                $url = $getUrl($item);
                $result[] = "<a href=\"$url\">$linkText</a>";
            }
            return implode(' ', $result);
        });

        //statusת��Ϊhtml
        $setStatusUrl = $this->_setStatusUrl;
        $that = &$this;
        $this->convertKey('status', 'html', function ($value, $key, $item) use ($setStatusUrl, $that) {
            //���û�������޸�״̬��URL����ֱ�ӷ�������
            $map = $key['opt'];
            $text = $map[$value];
            if (!$setStatusUrl) {
                return $text;
            }

            //���ش����ӵ�����
            $switchStatus = $value == 1 ? 0 : 1;
            $url = $that->addUrlParam($setStatusUrl, ['status' => $switchStatus, 'ids' => $item['id']]);
            return "<a href=\"{$url}\" class=\"ajax-get\">$text</a>";
        });

        //���htmlΪ��
        $this->convertKey('html', 'html', function ($value) {
            if ($value === '') {
                return '<span style="color:#bbb;">���գ�</span>';
            }
            return $value;
        });

        //����buttonList�е�����
        foreach ($this->_buttonList as &$button) {
            $button['tag'] = isset($button['attr']['href']) ? 'a' : 'button';
            $this->addDefaultCssClass($button);
            $button['attr'] = $this->compileHtmlAttr($button['attr']);
        }

        //���ɷ�ҳHTML����
        config('VAR_PAGE', 'page');
        $pager = new \think\PageBack($this->_pagination['totalCount'], $this->_pagination['listRows'], $_REQUEST);
        $pager->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $paginationHtml = $pager->show();

        //��ʾҳ��
        $this->assign('title', $this->_title);
        $this->assign('suggest', $this->_suggest);
        $this->assign('keyList', $this->_keyList);
        $this->assign('buttonList', $this->_buttonList);
        $this->assign('pagination', $paginationHtml);
        $this->assign('level', $this->_level);
        $this->assign('model', $this->_model);
        $this->assign('tree', $this->_data);
        $this->assign('canMove',$this->_move);
        $this->assign('canMerge',$this->_merge);
        return $this->fetch(parent::display('admin_tree'));
    }

    /**
     * ��ʾ����������֧���ڲ���
     * @param null  $tree ������  array
     * @return mixed|void
     */
    public function tree($tree = null)
    {
        if (empty($tree)) {
            echo '';
            return;
        };
        $this->_level--;
        $this->assign('level', $this->_level);
        $this->assign('tree', $tree);
        return $this->fetch(parent::display('tree'));
    }

    public function doSetStatus($model, $ids, $status)
    {
        $ids = is_array($ids) ? $ids : explode(',', $ids);
        db($model)->where(['id' => ['in', $ids]])->update(['status' => $status]);
        $this->success("���óɹ�");
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
     * @param $pattern url����������URL�ַ��������� Backstage/Test/index?test_id=###
     * ###����id�滻
     * @return callable
     */
    private function createDefaultGetUrlFunction($pattern)
    {
        return function ($item) use ($pattern) {
            $pattern = str_replace('###', $item['id'], $pattern);
            return url($pattern);
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

    /**���ò㼶
     */
    public function setLevel($level = 2)
    {
        $this->_level = $level;
        return $this;
    }

    /**���õ�ǰҳ���ģ��
     * @param string $model
     * @return $this
     */
    public function setModel($model = '')
    {
        $this->_model = $model;
        return $this;
    }

    public function showMove()
    {
        $this->_move = true;
        return $this;
    }

    public function showMerge()
    {
        $this->_merge = true;
        return $this;
    }
}