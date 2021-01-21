<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo\response;

use ginkgo\Response;
use ginkgo\Debug;
use ginkgo\Func;
use ginkgo\Arrays;

// 不能非法包含或直接执行
defined('IN_GINKGO') or exit('Access denied');

// jsonp 响应类
class Jsonp extends Response {

    const CALLBACK_PARAM = 'callback';
    const CALLBACK       = 'callback';

    protected function output($data) {
        $this->contentType('application/javascript');
        $_param    = CALLBACK_PARAM;
        $_callback = CALLBACK;

        if (isset($this->config['jsonp_callback_param']) && !Func::isEmpty($this->config['jsonp_callback_param'])) {
            $_param = $this->config['jsonp_callback_param'];
        }

        $_callback_request = $this->obj_request->request($_param);

        if (!Func::isEmpty($_callback_request)) {
            $_callback = $_callback_request;
        } else if (isset($this->config['jsonp_callback']) && !Func::isEmpty($this->config['jsonp_callback'])) {
            $_callback = $this->config['jsonp_callback'];
        }

        if (is_array($data)) {
            $_str_return = Debug::inject($data, 'arr');
            $_str_return = Arrays::toJson($_str_return);
        } else if (is_string($data)) {
            $_str_return = Debug::inject($data, 'str');
        }

        return $_callback . '(' . $_str_return . ')';
    }
}
