<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo;

// 不能非法包含或直接执行
if (!defined('IN_GINKGO')) {
  return 'Access denied';
}

// 签名类
class Sign {

  /** 生成签名
   * make function.
   *
   * @access public
   * @static
   * @param string $data 待签名字符
   * @param string $salt (default: '') 盐
   * @param bool $is_upper (default: true) 是否大写
   * @param bool $func (default: '') 哈希方法 since 0.3.2
   * @return 签名
   */
  public static function make($data, $salt = '', $is_upper = true, $func = '') {
    $_str_data = '';

    if (is_array($data)) {
      $_arr_data = sort($data, SORT_STRING);
      $_str_data = implode('', $_arr_data);
    } else if (is_scalar($data)) {
      $_str_data = $data;
    }

    switch ($func) {
      case 'sha1':
        $_str_sign = sha1($_str_data . $salt);
      break;

      case 'crypt':
        $_str_sign = crypt($_str_data, $salt);
      break;

      default:
        $_str_sign = md5($_str_data . $salt);
      break;
    }

    if ($is_upper) {
      $_str_sign = strtoupper($_str_sign);
    }
    return $_str_sign;
  }

  /** 验证签名
   * check function.
   *
   * @access public
   * @static
   * @param string $data 待签名字符
   * @param string $sign 签名
   * @param string $salt (default: '') 盐
   * @param bool $is_upper (default: true) 是否大写
   * @return 验证结果
   */
  public static function check($data, $sign, $salt = '', $is_upper = true, $func = '') {
    $_str_signChk = self::make($data, $salt, $is_upper, $func);

    /*print_r($_str_signChk);
    print_r('<br>');
    print_r($sign);*/

    return $_str_signChk == $sign;
  }
}
