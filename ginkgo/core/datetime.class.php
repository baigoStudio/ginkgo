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

// 日期时间处理
class Datetime {

  public static $config = array(); // 配置

  private static $configThis = array( // 默认配置
    'date'       => 'Y-m-d', // 日期
    'date_short' => 'm-d', // 短日期
    'time_short' => 'H:i', // 短时间
  );

  private static $init; // 是否初始化标志

  public static function init($config = array()) {
    self::config($config); // 配置

    self::$init = true; // 标识为已初始化
  }

  /** 强化版 strtotime, 可以自动过滤转义过的符号
   * strtotime function.
   *
   * @access public
   * @static
   * @param string $time 日期时间字符串
   * @return 时间戳
   */
  public static function toTime($time) {
    $_arr_src   = array('&#45;', '&#58;');
    $_arr_dst   = array('-', ':');
    $time       = str_replace($_arr_src, $_arr_dst, $time);
    $_tm_return = strtotime($time);

    return $_tm_return;
  }

  /** 两个日期差值
   * strtotime function.
   *
   * @access public
   * @static
   * @param string $begin 起始时间
   * @param string $end 结束时间
   * @param string $type 类型
   * @return 时间戳
   */
  public static function diff($begin, $end = 'now', $abs = true) {
    if (is_numeric($begin)) {
      $begin = date('Y-m-d H:i:s', $begin);
    } else {
      $begin = (string)$begin;
    }

    if (is_numeric($end)) {
      $end = date('Y-m-d H:i:s', $end);
    } else {
      if ($end == 'now') {
        $end = date('Y-m-d H:i:s');
      }
      $end = (string)$end;
    }

    $_obj_diff = date_diff(date_create($begin), date_create($end), $abs);

    $_num_s = self::toTime($end) - self::toTime($begin);
    $_num_a = ceil($_num_s / GK_DAY);
    $_num_w = intval($_num_s / GK_WEEK);
    $_mod_d = ceil(($_num_s % GK_WEEK) / GK_DAY);

    if ($_mod_d >= 7) {
      ++$_num_w;
      $_mod_d = 0;
    }

    return array(
      'R'      => $_obj_diff->format('%R'),
      'y'      => $_obj_diff->format('%y'),
      'm'      => $_obj_diff->format('%m'),
      'd'      => $_obj_diff->format('%d'),
      'h'      => $_obj_diff->format('%h'),
      'i'      => $_obj_diff->format('%i'),
      's'      => $_obj_diff->format('%s'),
      'a'      => $_obj_diff->format('%a'),
      'w'      => $_num_w,
      'day'    => $_mod_d,
      'period' => $_obj_diff->format('%a') + 1,
    );
  }

  /** 友好的显示时间
   * strtotime function.
   *
   * @access public
   * @static
   * @param string $time 日期时间字符串
   * @return 时间戳
   */
  public static function friendly($time = GK_NOW) {
    if (Func::isEmpty(self::$init)) {
      self::init();
    }

    $time = (int)$time;

    $_tm_diff       = GK_NOW - $time;
    $_str_year      = date('Y', $time);
    $_str_diff      = '';
    $_str_unit      = '';
    $_tm_today      = strtotime('today 00:00:00');
    $_tm_yesterday  = strtotime('-1 day 00:00:00');
    $_tm_before     = strtotime('-2 days 00:00:00');
    $_str_yearThis  = date('Y');

    if ($_tm_diff < GK_MINUTE) { //1分钟内
      $_str_diff = 'Just now';
    } else if ($_tm_diff < GK_HOUR) { //1小时内
      $_str_diff = floor($_tm_diff / GK_MINUTE);
      $_str_unit = 'Minutes ago';
    } else if ($_tm_diff < GK_DAY) { //24小时内
      if ($time > $_tm_today) { //今天
        $_str_diff = floor($_tm_diff / GK_HOUR); //昨天
        $_str_unit = 'Hours ago';
      } else {
        $_str_diff = 'Yesterday';
      }
    } else if ($_tm_diff < GK_MONTH) { //一个月内
      if ($time > $_tm_yesterday) { //昨天
        $_str_diff = 'Yesterday';
      } else if ($time > $_tm_before) { //前天
        $_str_diff = 'The day before yesterday';
      } else { //3天前
        $_str_diff = floor($_tm_diff / GK_DAY);
        $_str_unit = 'Days ago';
      }
    } else if ($_str_year == $_str_yearThis) { //今年
      $_str_diff = date(self::$config['date_short'] . ' ' . self::$config['time_short'], $time);
    } else {
      $_str_diff = date(self::$config['date'] . ' ' . self::$config['time_short'], $time);
    }

    return array(
      'diff' => $_str_diff,
      'unit' => $_str_unit,
    );
  }


  // 配置
  public static function config($config = array()) {
    $_arr_config   = Config::get('var_default'); // 取得配置

    $_arr_configDo = self::$configThis;

    if (is_array($_arr_config) && Func::notEmpty($_arr_config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, $_arr_config); // 合并配置
    }

    if (is_array(self::$config) && Func::notEmpty(self::$config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, self::$config); // 合并配置
    }

    if (is_array($config) && Func::notEmpty($config)) {
      $_arr_configDo = array_replace_recursive($_arr_configDo, $config); // 合并配置
    }

    self::$config  = $_arr_configDo;
  }
}
