<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo\common;

use ginkgo\Config;
use ginkgo\Log;
use ginkgo\Func;
use ginkgo\File;

// 不能非法包含或直接执行
if (!defined('IN_GINKGO')) {
  return 'Access denied';
}

// 文件处理抽象类 since 0.3.0
abstract class File_Sys {

  public $mimeRows = array(); // mime 池
  public $error; // 错误
  public $rule = 'md5'; // 生成文件名规则 (函数名)

  public $fileInfo = array(
    'name'     => '',
    'tmp_name' => '',
    'ext'      => '',
    'mime'     => '',
    'size'     => 0,
  );

  public $config = array();

  protected $obj_file; // 文件对象

  /** 构造函数
   * __construct function.
   *
   * @access protected
   * @return void
   */
  protected function __construct($config = array()) {
    $this->config($config); // 初始化
    $this->obj_file = File::instance();
  }

  // 兼容用
  public function __call($method, $params) {
    return $this->getInfo($params);
  }

  public function config($config = array()) {

  }


  /** 获取 mime
   * getMime function.
   *
   * @access public
   * @param string $path (default: '') 路径
   * @param string $mime (default: false) 严格获取 mime
   * @return mime
   */
  public function getMime($path, $strict = false) {
    $_str_mime = '';

     if ($strict === true || $strict === 'true') {
      $_obj_finfo = new \finfo();

      $_str_mime  = $_obj_finfo->file($path, FILEINFO_MIME_TYPE);
    } else if (Func::notEmpty($strict) && is_string($strict)) {
      $_str_mime = $strict;
    } else {
      $_str_ext = $this->getExt($path); //取得扩展名

      if (isset($this->mimeRows[$_str_ext])) {
        $_str_mime = $this->mimeRows[$_str_ext][0];
      }
    }

    return $_str_mime;
  }


  /** 获取扩展名
   * getExt function.
   *
   * @access public
   * @param string $path 路径
   * @param mixed $mime (default: false) mime 类型
   * @return 扩展名
   */
  public function getExt($path, $mime = false) {
    $_str_ext = strtolower(pathinfo($path, PATHINFO_EXTENSION)); //取得扩展名

    if ($mime) {
      // 扩展名与 mime 不符的情况下, 反向查找, 如果存在, 则更改扩展名
      if (!isset($this->mimeRows[$_str_ext]) || !in_array($mime, $this->mimeRows[$_str_ext])) {
        foreach ($this->mimeRows as $_key_allow=>$_value_allow) {
          if (in_array($mime, $_value_allow)) {
            return $_key_allow;
          }
        }
      }
    }

    return $_str_ext;
  }


  // 获取信息
  public function getInfo($name = '') {
    $_mix_retrun = '';

    if (Func::isEmpty($name)) {
      $_mix_retrun = $this->fileInfo;
    } else if (isset($this->fileInfo[$name])) {
      $_mix_retrun = $this->fileInfo[$name];
    }

    return $_mix_retrun;
  }

  // 获取错误
  public function getError() {
    return $this->error;
  }


  public function setMime($mime, $value = array()) {
    if (is_array($mime)) {
      $this->mimeRows = array_replace_recursive($this->mimeRows, $mime);
    } else {
      $this->mimeRows[$mime] = $value;
    }
  }


  /** 设置生成文件名规则 (函数名)
   * rule function.
   *
   * @access public
   * @param mixed $rule
   * @return 当前实例
   */
  public function rule($rule) {
    $this->rule = $rule;

    return $this;
  }


  /** 验证文件是否允许
   * verifyFile function.
   *
   * @access protected
   * @param string $ext 扩展名
   * @param string $mime (default: '') mime
   * @return bool
   */
  protected function verifyFile($ext, $mime) {
    if (Func::notEmpty($this->mimeRows)) {
      if (!isset($this->mimeRows[$ext])) { //该扩展名的 mime 数组是否存在
        $this->errRecord(get_class($this) . '::verifyFile(), MIME check failed: ' . $ext);

        return false;
      }

      if (!in_array($mime, $this->mimeRows[$ext])) { //是否允许
        $this->errRecord(get_class($this) . '::verifyFile(), MIME not allowed: ' . $mime);

        return false;
      }
    }

    return true;
  }


  // 生成文件名
  protected function genFilename($name = true) {
    if ($name === true) { // 参数为 true 时, 按规则生成文件名
      if (is_callable($this->rule)) {
        $_str_type = $this->rule;
      } else {
        $_str_type = 'md5';
      }

      if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
        $_tm_time = $_SERVER['REQUEST_TIME_FLOAT'];
      } else {
        $_tm_time = GK_NOW;
      }

      $name = call_user_func($_str_type, $_tm_time) . '.' . $this->fileInfo['ext'];
    } else if ($name === false) { // 参数为 false 时, 使用原始文件名
      $name = $this->fileInfo['name'];
    }

    // 指定为字符串时, 直接使用

    return $name;
  }


  protected function errRecord($msg) {  // since 0.2.4
    $this->error      = $msg;
    $_bool_debugDump  = false;
    $_mix_configDebug = Config::get('debug'); // 取得调试配置

    if (is_array($_mix_configDebug)) {
      if ($_mix_configDebug['dump'] === true || $_mix_configDebug['dump'] === 'true' || $_mix_configDebug['dump'] === 'trace') { // 假如配置为输出
        $_bool_debugDump = true;
      }
    } else if (is_scalar($_mix_configDebug)) {
      if ($_mix_configDebug === true || $_mix_configDebug === 'true' || $_mix_configDebug === 'trace') { // 假如配置为输出
        $_bool_debugDump = true;
      }
    }

    if ($_bool_debugDump) {
      Log::record('type: ' . get_class($this) . ', msg: ' . $msg, 'log');
    }
  }
}
