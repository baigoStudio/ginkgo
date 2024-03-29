<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo;

use ginkgo\common\File_Sys;

// 不能非法包含或直接执行
if (!defined('IN_GINKGO')) {
  return 'Access denied';
}

// 上传类
class Upload extends File_Sys {

  public $limitSize = 0; // 允许上传大小

  protected static $instance; // 当前实例

  private $configThis     = array(
    'limit_size'    => 200, //上传尺寸
    'limit_unit'    => 'kb', //尺寸单位
  ); // 默认配置

  /** 初始化实例
   * instance function.
   *
   * @access public
   * @static
   * @return 当前类的实例
   */
  public static function instance() {
    if (Func::isEmpty(self::$instance)) {
      self::$instance = new static();
    }

    return self::$instance;
  }

  // 配置 since 0.2.0
  public function config($config = array()) {
    $_arr_config   = Config::get('upload', 'var_extra');

    $_arr_configDo = $this->configThis;

    if (is_array($_arr_config) && Func::notEmpty($_arr_config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, $_arr_config); // 合并配置
    }

    if (is_array($this->config) && Func::notEmpty($this->config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, $this->config); // 合并配置
    }

    if (is_array($config) && Func::notEmpty($config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, $config); // 合并配置
    }

    $_arr_configDo['limit_unit'] = strtolower($_arr_configDo['limit_unit']);

    switch ($_arr_configDo['limit_unit']) { // 初始化单位
      case 'tb':
        $_num_sizeUnit = GK_TB;
      break;

      case 'gb':
        $_num_sizeUnit = GK_GB;
      break;

      case 'mb':
        $_num_sizeUnit = GK_MB;
      break;

      case 'kb':
        $_num_sizeUnit = GK_KB;
      break;

      default:
        $_num_sizeUnit = 1;
      break;
    }

    if ($this->limitSize < 1) { // 如果大小限制未定义
      $this->limitSize = $_arr_configDo['limit_size'] * $_num_sizeUnit;
    }

    $this->config  = $_arr_configDo;
  }


  /** 创建上传对象
   * create function.
   *
   * @access public
   * @param mixed $name
   * @return void
   */
  public function create($name) {
    if (!isset($_FILES) || !isset($_FILES[$name])) {
      $this->errRecord('Upload::create(), No files uploaded'); // 没有上传数据

      return false;
    }

    $_arr_fileInfo = $_FILES[$name];

    // 上传文件校验
    if (!isset($_arr_fileInfo['tmp_name']) || !is_uploaded_file($_arr_fileInfo['tmp_name'])) {
      $this->errRecord('Upload::create(), is_upload, No files uploaded');

      return false;
    }

    // 错误处理
    if (isset($_arr_fileInfo['error']) && $_arr_fileInfo['error'] > 0) {
      $this->errorProcess($_arr_fileInfo['error']);

      return false;
    }

    // 取得 mime
    $_str_mime  = $this->getMime($_arr_fileInfo['tmp_name'], $_arr_fileInfo['type']);

    // 取得扩展名
    $_str_ext   = $this->getExt($_arr_fileInfo['name'], $_str_mime);

    // 验证是否为允许的文件
    if (!$this->verifyFile($_str_ext, $_str_mime)) {
      return false;
    }

    if ($_arr_fileInfo['size'] > $this->limitSize) { //是否超过尺寸
      $this->errRecord('Upload::create(), Upload file size exceeds the settings');

      return false;
    }

    $_arr_fileInfo['name']  = Func::safe($_arr_fileInfo['name']);
    $_arr_fileInfo['ext']   = $_str_ext;
    $_arr_fileInfo['mime']  = $_str_mime;

    $_arr_fileInfoDo = array_replace_recursive($this->fileInfo, $_arr_fileInfo);
    $this->fileInfo  = $_arr_fileInfoDo;

    return $_arr_fileInfoDo;
  }


  /** 设置、获取大小限制
   * setLimit function.
   *
   * @access public
   * @param mixed $size
   * @return void
   */
  public function limit($size = false) {
    if ($size === false) {
      return $this->limitSize;
    } else {
      $this->limitSize = (float)$size;
    }
  }


  /** 移动文件
   * move function.
   *
   * @access public
   * @param string $dir 目的地路径
   * @param mixed $name (default: true) 文件名, 参数为 true 时, 按规则生成文件名, false 时, 使用原始文件名, 字符串直接使用
   * @param bool $replace (default: true) 是否替换
   * @return void
   */
  public function move($dir, $name = true, $replace = true) {
    if (!$this->obj_file->dirMk($dir)) { // 建目录
      $this->errRecord('Upload::move(), Failed to create directory: ' . $dir);

      return false;
    }

    $name = $this->genFilename($name); // 生成文件名

    if (Func::isEmpty($name)) {
      $this->errRecord('Upload::move(), Missing filename');

      return false;
    }

    $_str_path = Func::fixDs($dir) . $name; // 补全路径

    if (!$replace && File::fileHas($_str_path)) { // 如果为不替换, 冲突时报错
      $this->errRecord('Upload::move(), Has the same filename: ' . $_str_path);

      return false;
    }

    if (!move_uploaded_file($this->fileInfo['tmp_name'], $_str_path)) { // 移动至指定目录
      $this->errRecord('Upload::move(), Failed to move uploaded file'); // 移动失败

      return false;
    }

    if (File::fileHas($this->fileInfo['tmp_name'])) { // 如果临时文件仍然存在
      $this->obj_file->fileDelete($this->fileInfo['tmp_name']); // 删除临时文件
    }

    return $_str_path;
  }


  /** 错误处理
   * errorProcess function.
   *
   * @access private
   * @param mixed $error_no 错误号
   * @return void
   */
  private function errorProcess($error_no) {
    switch ($error_no) {
      case UPLOAD_ERR_INI_SIZE:
        $this->errRecord('Upload::errorProcess(), Upload file size exceeds the php.ini settings');
      break;

      case UPLOAD_ERR_FORM_SIZE:
        $this->errRecord('Upload::errorProcess(), Upload file size exceeds the form settings');
      break;

      case UPLOAD_ERR_PARTIAL:
        $this->errRecord('Upload::errorProcess(), Only the portion of file is uploaded');
      break;

      case UPLOAD_ERR_NO_FILE:
        $this->errRecord('Upload::errorProcess(), No files uploaded');
      break;

      case UPLOAD_ERR_NO_TMP_DIR:
        $this->errRecord('Upload::errorProcess(), Upload temp dir not found');
      break;

      case UPLOAD_ERR_CANT_WRITE:
        $this->errRecord('Upload::errorProcess(), File write error');
      break;

      default:
        $this->errRecord('Upload::errorProcess(), Unknown upload error');
      break;
    }
  }
}
