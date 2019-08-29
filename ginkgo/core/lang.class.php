<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo;

//不能非法包含或直接执行
defined('IN_GINKGO') or exit('Access denied');

class Lang {

    private static $instance;
    private static $lang;
    private static $config;
    private static $current; //默认语言
    private static $clientLang; //客户端语言
    private static $route;
    private static $range = '';

    private function __construct() {
        self::$config = Config::get('lang');

        $this->getCurrent();
        $this->loadSys();
    }

    private function __clone() {

    }

    public function range($range = '') {
        if (Func::isEmpty($range)) {
            return self::$range;
        } else {
            self::$range = $range;
        }
    }

    public static function instance() {
        if (Func::isEmpty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //获取当前语言
    function getCurrent() {
        if (!Func::isEmpty(self::$config['switch'])) { //语言开关为开
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                self::$clientLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            }
        }

        if (Func::isEmpty(self::$current)) {
            self::$current = self::$config['default'];
        }

        //print_r(self::$current);

        mb_internal_encoding('UTF-8'); //设置内部字符编码
        setlocale(LC_ALL, self::$current . '.UTF-8'); //设置区域格式,主要针对 csv 处理

        return self::$current;
    }


    function setCurrent($lang = '') {
        self::$current = $lang;
    }


    function set($name, $value = '', $range = '') { //设置语言字段
        $_mix_range = self::rangeProcess($range);

        /*print_r($name);
        print_r('<br>');*/

        if (Func::isEmpty($_mix_range)) {
            if (is_array($name)) {
                self::$lang = array_replace_recursive(self::$lang, $name);
            } else if (is_string($name)) {
                if (isset(self::$lang[$name])) {
                    self::$lang[$name] = array_replace_recursive(self::$lang[$name], $value);
                } else {
                    self::$lang[$name] = $value;
                }
            }
        } else if (is_array($_mix_range)) {
            if (is_array($name)) {
                if (isset($_mix_range[1])) {
                    if (isset(self::$lang[$_mix_range[0]][$_mix_range[1]])) {
                        self::$lang[$_mix_range[0]][$_mix_range[1]] = array_replace_recursive(self::$lang[$_mix_range[0]][$_mix_range[1]], $name);
                    } else {
                        self::$lang[$_mix_range[0]][$_mix_range[1]] = $name;
                    }
                } else if (isset($_mix_range[0])) {
                    if (isset(self::$lang[$_mix_range[0]])) {
                        self::$lang[$_mix_range[0]] = array_replace_recursive(self::$lang[$_mix_range[0]], $name);
                    } else {
                        self::$lang[$_mix_range[0]] = $name;
                    }
                }
            } else if (is_string($name)) {
                if (isset($_mix_range[1])) {
                    if (isset(self::$lang[$_mix_range[0]][$_mix_range[1]][$name]) && is_array($value)) {
                        self::$lang[$_mix_range[0]][$_mix_range[1]][$name] = array_replace_recursive(self::$lang[$_mix_range[0]][$_mix_range[1]][$name], $value);
                    } else {
                        self::$lang[$_mix_range[0]][$_mix_range[1]][$name] = $value;
                    }
                } else if (isset($_mix_range[0])) {
                    if (isset(self::$lang[$_mix_range[0]][$name]) && is_array($value)) {
                        self::$lang[$_mix_range[0]][$name] = array_replace_recursive(self::$lang[$_mix_range[0]][$name], $value);
                    } else {
                        self::$lang[$_mix_range[0]][$name] = $value;
                    }
                }
            }
        } else if (is_string($_mix_range)) {
            if (is_array($name)) {
                if (isset(self::$lang[$_mix_range])) {
                    self::$lang[$_mix_range] = array_replace_recursive(self::$lang[$_mix_range], $name);
                } else {
                    self::$lang[$_mix_range] = $name;
                }
            } else {
                if (isset(self::$lang[$_mix_range][$name]) && is_array($value)) {
                    self::$lang[$_mix_range][$name] = array_replace_recursive(self::$lang[$_mix_range][$name], $value);
                } else {
                    self::$lang[$_mix_range][$name] = $value;
                }
            }
        }

        //print_r(self::$lang);
    }

    function get($name, $range = '', $replace = array(), $show_key = true) { //获取语言字段
        $name = (string)$name;

        $_mix_range     = self::rangeProcess($range);

        /*print_r($name);
        print_r(' ||| ');
        print_r($_mix_range);
        print_r('<br>');*/

        if ($show_key) {
            $_str_return    = $name;
        } else {
            $_str_return    = '';
        }

        if (Func::isEmpty($_mix_range)) {
            if (isset(self::$lang[$name])) {
                $_str_return = self::$lang[$name];
            }
        } else if (is_array($_mix_range)) {
            if (isset($_mix_range[1])) {
                if (isset(self::$lang[$_mix_range[0]][$_mix_range[1]][$name])) {
                    $_str_return = self::$lang[$_mix_range[0]][$_mix_range[1]][$name];
                }
            } else if (isset($_mix_range[0])) {
                if (isset(self::$lang[$_mix_range[0]][$name])) {
                    $_str_return = self::$lang[$_mix_range[0]][$name];
                }
            }
        } else if (is_string($_mix_range)) {
            if (isset(self::$lang[$_mix_range][$name])) {
                $_str_return = self::$lang[$_mix_range][$name];
            }
        }

        if (is_array($replace) && !Func::isEmpty($replace)) {
            $_arr_replace = array_keys($replace);
            foreach ($_arr_replace as $_key=>&$_value) {
                $_value = '{:' . $_value . '}';
            }
            $_str_return = str_ireplace($_arr_replace, $replace, $_str_return);
        }

        return $_str_return;
    }


    function load($path, $range = '') {
        $_arr_lang = array();

        if (Func::isFile($path)) {
            $_arr_lang = Loader::load($path, 'include');
        }

        /*print_r($range);
        print_r('<br>');*/

        $this->set($_arr_lang, '', $range);

        return $_arr_lang;
    }


    private function loadSys() {
        $_str_pathSys = GK_PATH_LANG . self::$current . GK_EXT_LANG;

        if (Func::isFile($_str_pathSys)) {
            self::$lang['__ginkgo__'] = Loader::load($_str_pathSys, 'include');
        }
    }


    private static function rangeProcess($range = '') {
        if (Func::isEmpty($range)) {
            $_str_range = self::$range;
        } else {
            $_str_range = $range;
        }

        if (!is_string($_str_range)) {
            $_str_range = '';
        }

        $_mix_return    = '';

        if (strpos($_str_range, '.')) {
            $_mix_return = explode('.', $_str_range);
        } else {
            $_mix_return = $_str_range;
        }

        return $_mix_return;
    }
}


