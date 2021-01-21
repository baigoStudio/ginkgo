<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo;

// 不能非法包含或直接执行
defined('IN_GINKGO') or exit('Access denied');

// 日志管理类
class Log {

    public static $config = array(); // 配置
    public static $log; // 日志内容

    private static $configThis = array( // 默认配置
        'save'      => false, //是否保存日志
        'file_size' => 2097152, //日志大小限制
    );

    private static $init; // 是否初始化标志


    /** 初始化
     * init function.
     *
     * @access private
     * @static
     * @return void
     */
    public static function init($config = array()) {
        self::config($config);

        $_str_timezone  = Config::get('timezone', 'var_default'); // 获取时区配置

        App::setTimezone($_str_timezone); // 设置时区

        self::$init     = true; // 标识为已初始化
    }


    /** 配置
     * prefix function.
     * since 0.1.4
     * @access public
     * @param string $config (default: array()) 配置
     * @return
     */
    public static function config($config = array()) {
        $_arr_config   = Config::get('log'); // 取得配置
        $_arr_configDo = array_replace_recursive(self::$configThis, $_arr_config, self::$config, $config); // 合并配置
        self::$config  = $_arr_configDo;
    }


    /** 获取日志
     * get function.
     *
     * @access public
     * @static
     * @param string $type (default: '') 日志类型
     * @return 日志
     */
    public static function get($type = '') {
        $_value = '';

        if (Func::isEmpty($type)) {
            $_value = self::$log;
        } else if (isset(self::$log[$type])) {
            $_value = self::$log[$type];
        }

        //print_r($_value);

        return $_value;
    }

    /** 记录日志
     * record function.
     *
     * @access public
     * @static
     * @param string $value (default: '') 日志内容
     * @param string $type (default: '') 日志类型
     * @return void
     */
    public static function record($value, $type = '') {
        if (Func::isEmpty(self::$init)) {
            self::init();
        }

        if (is_array($value)) {
            $value = Arrays::toJson($value);
        }

        self::$log[$type][] = '[' . date('c') . '] ' . $value;
    }


    /** 保存日志
     * save function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function save() {
        if (Func::isEmpty(self::$init)) {
            self::init();
        }

        if (isset(self::$config['save']) && (self::$config['save'] === true || self::$config['save'] === 'true')) {
            if (!Func::isEmpty(self::$log)) {
                $_obj_file = File::instance();

                foreach (self::$log as $_key=>$_value) {
                    $_str_logPath = GK_PATH_LOG . $_key . GK_EXT_LOG;

                    if (File::fileHas($_str_logPath) && filesize($_str_logPath) >= floor(self::$config['file_size'])) { // 日志文件大于设置, 则按日期另存
                        try {
                            $_obj_file->fileMove($_str_logPath, dirname($_str_logPath) . DS . date('Y-m-d') . '_' . basename($_str_logPath));
                        } catch (\Exception $e) {
                        }
                    }

                    $_str_content = '';

                    foreach ($_value as $_key_row=>$_value_row) {
                        $_obj_file->fileWrite($_str_logPath, $_value_row . PHP_EOL, true); // 写入
                    }
                }
            }
        }
    }
}
