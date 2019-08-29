<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace app\ctrl\index;

use ginkgo\Ctrl;
use ginkgo\Loader;

//不能非法包含或直接执行
defined('IN_GINKGO') or exit('Access denied');

class Index extends Ctrl {

    function index() {
        $_arr_tplData = array(
            'test' => 'index',
        );

        $this->assign($_arr_tplData);

        return $this->fetch();
    }

    public function test($id = 3) {
        return $id;
    }
}
