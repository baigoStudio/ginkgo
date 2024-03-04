<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace ginkgo\db;

use PDO;
use ginkgo\Config;
use ginkgo\Func;
use ginkgo\Strings;
use ginkgo\Log;
use ginkgo\except\Db_Except;

// 不能非法包含或直接执行
if (!defined('IN_GINKGO')) {
  return 'Access denied';
}

// 数据库连接器抽象类
abstract class Connector {

  public $config = array(); // 数据库配置
  public $obj_builder; // 语句生成器实例
  public $obj_pdo; // PDO 实例
  public $obj_result; // SQL 语句结果集实例

  protected static $instance = array(); // 当前实例
  protected $isConnect; // 是否连接标记
  protected $mid; // 模型 ID
  protected $optDebugDump = false; // 调试配置
  protected $obj_pdoWrite; // 写 PDO
  protected $obj_pdoRead; // 只读 PDO
  protected $rwSeparate   = false; // 是否开启读写分离

  protected $_config      = array(); // 转换后 config
  protected $_masterNo    = 0; // 主库序号
  protected $_table       = array(); // 数据表名
  protected $_tableTemp   = array(); // 临时数据表名, 切换操作的数据表, 对多表进行操作
  protected $_pk; // 主键
  protected $_force       = ''; // 强制使用索引名
  protected $_distinct    = false; // 是否不重复
  protected $_join        = ''; // join 语句
  protected $_where       = ''; // where 条件语句
  protected $_whereOr     = array(); // whereOr 语句数组
  protected $_whereAnd    = array(); // whereAnd 语句数组
  protected $_paginate    = array(); // 分页参数
  protected $_group       = ''; // group 语句
  protected $_order       = ''; // order 语句
  protected $_limit       = ''; // limit 语句
  protected $_bind        = array(); // 绑定参数数组
  protected $_fetchSql    = false; // 是否获取 sql 语句
  protected $_master      = false; // 强制主数据库


  // 默认参数类型
  protected $paramType = array(
    'bool'  => PDO::PARAM_BOOL,
    'int'   => PDO::PARAM_INT,
    'str'   => PDO::PARAM_STR,
  );


  /** 构造函数
   * __construct function.
   *
   * @access protected
   * @param array $config (default: array()) 数据库配置
   * @return void
   */
  protected function __construct($config = array()) {
    $this->init($config); // 配置处理
  }

  protected function __clone() { }

  /** 实例化
   * instance function.
   *
   * @access public
   * @static
   * @param array $config (default: array())
   * @return 当前类的实例
   */
  public static function instance($config = array(), $name = false) {
    if ($name === false) {
      $name = md5(serialize($config));
    }

    if (Func::notEmpty($name) && !isset(self::$instance[$name])) {
      self::$instance[$name] = new static($config);
    }

    return self::$instance[$name];
  }

  /** 配置处理并实例化 sql 语句构造器
   * config function.
   *
   * @access public
   * @param array $config (default: array()) 配置
   * @return void
   */
  public function init($config = array()) {
    if (Func::isEmpty($config['type'])) { // 未指定类型, 默认 mysql
      $config['type'] = 'mysql';
    }

    $this->config = $config;

    $this->configProcess();

    $_class = 'ginkgo\\db\\builder\\' . Strings::ucwords($config['type'], '_'); // 补全构造器命名空间

    if (class_exists($_class)) {
      $this->obj_builder = $_class::instance($config); // 实例化 sql 语句构造器
    } else {
      $_obj_excpt = new Db_Except('SQL Builder not found', 500);

      $_obj_excpt->setData('err_detail', $_class);

      throw $_obj_excpt;
    }
  }


  /** 连接数据库
   * connect function.
   *
   * @access public
   * @return void
   */
  public function connect() {
    try {
      $_arr_dsn = $this->dsnProcess(); // dsn 处理

      if ($this->rwSeparate === true) {
        $this->obj_pdoWrite = new PDO($_arr_dsn['write']['dsn'], $_arr_dsn['write']['user'], $_arr_dsn['write']['pass']); // 实例化 写 PDO

        $this->obj_pdoRead = new PDO($_arr_dsn['read']['dsn'], $_arr_dsn['read']['user'], $_arr_dsn['read']['pass']); // 实例化 只读 PDO
        $this->obj_pdoWrite->exec('SET NAMES ' . $_arr_dsn['write']['charset']); // 设置字符编码
        $this->obj_pdoRead->exec('SET NAMES ' . $_arr_dsn['read']['charset']); // 设置字符编码
      } else {
        $this->obj_pdo = new PDO($_arr_dsn['dsn'], $_arr_dsn['user'], $_arr_dsn['pass']); // 实例化 pdo
        $this->obj_pdo->exec('SET NAMES ' . $_arr_dsn['charset']); // 设置字符编码
      }
    } catch (\PDOException $excpt) { // 报错
      $_obj_excpt = new Db_Except('Can not connect to database', 500);
      if ($this->config['debug'] === true || $this->config['debug'] === 'true') {
        $_obj_excpt->setData('err_detail', $excpt->getMessage());
      }

      throw $_obj_excpt;
    }

    $_mix_configDebug  = Config::get('debug'); // 取得调试配置

    if (is_array($_mix_configDebug)) {
      if ($_mix_configDebug['dump'] === 'trace') { // 假如配置为输出
        $this->optDebugDump = 'trace';
      }
    } else if (is_scalar($_mix_configDebug)) {
      if ($_mix_configDebug === 'trace') { // 假如配置为输出
        $this->optDebugDump = 'trace';
      }
    }

    $this->isConnect = true; // 标识为已连接
  }


  /** 执行原生 sql (一般用于 插入、更新 或者 删除)
   * exec function.
   *
   * @access public
   * @param mixed $sql 语句
   * @return 影响行数
   */
  public function exec($sql) {
    if (Func::isEmpty($this->isConnect)) {
      $this->connect();
    }

    if ($this->rwSeparate === true) {
      $this->obj_pdo = $this->obj_pdoWrite;
    }

    if ($this->optDebugDump === 'trace') {
      Log::record($sql, 'sql'); // 记录日志
    }

    return $this->obj_pdo->exec($sql); // 执行
  }


  /** 执行原生 sql (一般用于 select)
   * query function.
   *
   * @access public
   * @param mixed $sql
   * @return 结果集实例
   */
  public function query($sql) {
    if (Func::isEmpty($this->isConnect)) {
      $this->connect();
    }

    if ($this->rwSeparate === true) {
      if ($this->_master === true) {
        $this->obj_pdo = $this->obj_pdoWrite;
      } else {
        $this->obj_pdo = $this->obj_pdoRead;
      }
    }

    if ($this->optDebugDump === 'trace') {
      Log::record($sql, 'sql'); // 记录日志
    }

    $this->obj_result = $this->obj_pdo->query($sql); // 执行

    if ($this->obj_result === false) {
      $_obj_excpt = new Db_Except('PDO::query error', 500);

      $_arr_error = $this->obj_pdo->errorInfo();

      if (isset($_arr_error[2])) {
        $_obj_excpt->setData('err_detail', $sql . ', ' . $_arr_error[2]);
      }

      throw $_obj_excpt;
    }

    return $this->obj_result;
  }


  /** 取得新插入的 id
   * lastInsertId function.
   *
   * @access public
   * @return void
   */
  public function lastInsertId() {
    return $this->obj_pdo->lastInsertId();
  }


  /** 预处理 sql 语句
   * prepare function.
   *
   * @access public
   * @param mixed $sql 语句
   * @param array $bind (default: array()) 绑定参数
   * @param string $value (default: '') 绑定值
   * @param string $type (default: '') 参数类型
   * @return 结果集实例
   */
  public function prepare($sql, $bind = array(), $value = '', $type = '') {
    if (Func::isEmpty($this->isConnect)) {
      $this->connect(); // 连接数据库
    }

    $this->obj_result = $this->obj_pdo->prepare($sql); // 预处理

    if (Func::notEmpty($bind)) {
      $this->bind($bind, $value, $type); // 绑定处理
    }

    return $this->obj_result;
  }


  /** 执行预处理 sql 语句
   * execute function.
   *
   * @access public
   * @param array $bind (default: array()) 绑定参数
   * @param string $value (default: '') 绑定值
   * @param string $type (default: '') 参数类型
   * @param string $reset (default: true) 执行完毕是否重置 sql
   * @return void
   */
  public function execute($bind = array(), $value = '', $type = '', $reset = true) {
    if (Func::notEmpty($bind)) {
      $this->bind($bind, $value, $type); // 绑定处理
    }

    if ($reset !== false) {
      $this->resetSql(); // 重置 sql
    }

    return $this->obj_result->execute(); // 执行
  }


  /** 是否查询不重复的记录
   * distinct function.
   *
   * @access public
   * @param bool $bool (default: true) 是否查询不重复
   * @return 当前实例
   */
  public function distinct($bool = true) {
    $this->_distinct = $bool;

    return $this;
  }


  /** 分页
   * paginate function.
   *
   * @access public
   * @param int $perpage (default: 0) 每页记录数
   * @param string $current (default: 'get') 当前页
   * @param string $pageparam (default: 'page') 分页参数
   * @param int $pergroup (default: 0) 每组页数
   * @return 当前实例
   */
  public function paginate($perpage = 0, $current = 'get', $pageparam = 'page', $pergroup = 0) {
    $this->_paginate = array(
      'perpage'   => $perpage,
      'current'   => $current,
      'pageparam' => $pageparam,
      'pergroup'  => $pergroup,
    );

    return $this;
  }


  /** 是否获取 sql 语句
   * fetchSql function.
   *
   * @access public
   * @param bool $bool (default: true)
   * @return 当前实例
   */
  public function fetchSql($bool = true) {
    $this->_fetchSql = $bool;

    return $this;
  }

  /** 强制主数据库
   * master function.
   *
   * @access public
   * @param bool $bool (default: true)
   * @return 当前实例
   */
  public function master($bool = true) {
    $this->_master = $bool;

    return $this;
  }


  /** 取得影响行数
   * getRowCount function.
   *
   * @access public
   * @return 行数
   */
  public function getRowCount() {
    return $this->obj_result->rowCount();
  }


  /** 取得当前行数据
   * getRow function.
   *
   * @access public
   * @return void
   */
  public function getRow() {
    $_num_return = 0;

    $_arr_result = $this->obj_result->fetch(PDO::FETCH_NUM);

    if (isset($_arr_result[0])) {
      $_num_return = $_arr_result[0];
    }

    return $_num_return;
  }


  /** 取得结果
   * getResult function.
   *
   * @access public
   * @param bool $all (default: true) 是否为全部
   * @param mixed $type (default: PDO::FETCH_ASSOC) 取得类型
   * @return 数据结果
   */
  public function getResult($all = true, $type = PDO::FETCH_ASSOC) {
    if ($all) {
      $_mix_return = $this->obj_result->fetchAll($type);
    } else {
      $_mix_return = $this->obj_result->fetch($type);
    }

    return $_mix_return;
  }


  /** 设置模型名 (防止冲突)
   * setModel function.
   *
   * @access public
   * @param string $model (default: '')
   * @return void
   */
  public function setModel($model) {
    if (Func::isEmpty($model)) {
      $model = get_class($this); // 如果未定义参数, 直接以当前实例命名
    }

    $this->mid = md5($model); // md5 编码

    /*print_r($model);
    print_r('<br>');
    print_r($this->mid);
    print_r('<br>');*/
  }


  /** 设置数据表名
   * setTable function.
   *
   * @access public
   * @param mixed $table
   * @return void
   */
  public function setTable($table) {
    $this->_table[$this->mid] = $this->obj_builder->table(strtolower($table));
  }


  /** 取得当前数据表名
   * getTable function.
   *
   * @access public
   * @return void
   */
  public function getTable() {
    $_str_table = '';

    if (isset($this->_tableTemp[$this->mid]) && Func::notEmpty($this->_tableTemp[$this->mid])) {
      $_str_table = $this->_tableTemp[$this->mid];
    } else if (isset($this->_table[$this->mid]) && Func::notEmpty($this->_table[$this->mid])) {
      $_str_table = $this->_table[$this->mid];
    }

    return $_str_table;
  }


  /** 设置主键
   * setTable function.
   *
   * @access public
   * @param mixed $table
   * @return void
   */
  public function setPk($pk) {
    $this->_pk[$this->mid] = $this->obj_builder->addChar($pk);
  }


  /** 取得当前数据表主键
   * getPk function.
   *
   * @access public
   * @return void
   */
  public function getPk() {
    $_str_pk = '';

    if (isset($this->_pk[$this->mid]) && Func::notEmpty($this->_pk[$this->mid])) {
      $_str_pk = $this->_pk[$this->mid];
    }

    return $_str_pk;
  }


  /** 绑定参数
   * bind function.
   *
   * @access public
   * @param mixed $bind 参数
   * @param string $value (default: '') 值
   * @param string $type (default: '') 参数类型
   * @return 当前实例
   */
  public function bind($bind, $value = '', $type = '') {
    if (is_array($bind)) {
      if (isset($bind[0])) {
        if (is_array($bind[0])) {
          foreach ($bind as $_key => $_value) {
            if (is_array($_value)) {
              if (isset($_value[0]) && is_scalar($_value[0])) {
                if (!isset($_value[1])) {
                  $_value[1] = '';
                }

                if (!isset($_value[2])) {
                  $_value[2] = '';
                }

                $_result = $this->bindProcess($_value[0], $_value[1], $_value[2]);
              }
            }
          }
        } else if (is_scalar($bind[0])) {
          if (!isset($bind[1])) {
            $bind[1] = '';
          }

          if (!isset($bind[2])) {
            $bind[2] = '';
          }

          $_result = $this->bindProcess($bind[0], $bind[1], $bind[2]);
        }
      }
    } else if (is_scalar($bind)) {
      $_result = $this->bindProcess($bind, $value, $type);
    }

    return $this;
  }


  /** 重置 sql
   * resetSql function.
   *
   * @access public
   * @return void
   */
  public function resetSql() {
    $this->_tableTemp   = array();
    $this->_force       = '';
    $this->_join        = '';
    $this->_group       = '';
    $this->_order       = '';
    $this->_limit       = '';
    $this->_bind        = '';
    $this->_where       = '';
    $this->_whereOr     = array();
    $this->_whereAnd    = array();
    $this->_paginate    = array();
    $this->_distinct    = false;
    $this->_fetchSql    = false;
  }


  /** 取得绑定后 SQL (配合 fetchSql 方法)
   * fetchBind function.
   *
   * @access protected
   * @param mixed $sql 语句
   * @param mixed $bind 参数
   * @param string $value (default: '') 值
   * @param string $type (default: '') 参数类型
   * @return 处理后的语句
   */
  public function fetchBind($sql, $bind, $value = '', $type = '') {
    if (is_array($bind)) {
      if (isset($bind[0])) {
        if (is_array($bind[0])) {
          foreach ($bind as $_key => $_value) {
            if (is_array($_value)) {
              if (isset($_value[0]) && is_scalar($_value[0])) {
                if (!isset($_value[1])) {
                  $_value[1] = '';
                }

                if (!isset($_value[2])) {
                  $_value[2] = '';
                }

                $sql = $this->fetchBindProcess($sql, $_value[0], $_value[1], $_value[2]);
              }
            }
          }
        } else if (is_scalar($bind[0])) {
          if (!isset($bind[1])) {
            $bind[1] = '';
          }

          if (!isset($bind[2])) {
            $bind[2] = '';
          }

          $sql = $this->fetchBindProcess($sql, $bind[0], $bind[1], $bind[2]);
        }
      }
    } else if (is_scalar($bind)) {
      $sql = $this->fetchBindProcess($sql, $bind, $value, $type);
    }

    return $sql;
  }

  /** 绑定处理
   * bindProcess function.
   *
   * @access private
   * @param mixed $bind 参数
   * @param string $value (default: '') 值
   * @param string $type (default: '') 参数类型
   * @return void
   */
  private function bindProcess($param, $value, $type = '') {
    //print_r($param);

    $_result = false;
    $type    = strtolower($type); // 转小写

    if (Func::notEmpty($param) && is_scalar($param)) { // 如果参数是标量才有效
      $_num_type = $this->getType($value, $type); // 取得参数类型

      if ($_num_type !== PDO::PARAM_STR && Func::isEmpty($value)) { // 如果不是字符串类型且为空
        $value = 0; // 值设为 0
      }

      if (is_numeric($param)) { // 如果参数是数字, 直接使用
        $_mix_param = $param;
      } else {
        $_mix_param = ':' . $param; // 否则添加前缀
      }

      /*print_r($_mix_param);
      print_r(' => ');
      print_r($value);
      print_r(', type: ');
      print_r($_num_type);
      print_r('<br>');
      print_r(PHP_EOL);*/

      $_result = $this->obj_result->bindValue($_mix_param, $value, $_num_type); // 绑定

      if (!$_result) { // 报错
        $_obj_excpt = new Db_Except('Error occurred when binding parameters', 500);

        $_obj_excpt->setData('err_detail', $param);

        throw $_obj_excpt;
      }
    }

    return $_result;
  }


  /** 取得绑定处理
   * fetchBindProcess function.
   *
   * @access private
   * @param mixed $sql 语句
   * @param mixed $bind 参数
   * @param string $value (default: '') 值
   * @param string $type (default: '') 参数类型
   * @return void
   */
  private function fetchBindProcess($sql, $param, $value, $type = '') {
    $type   = strtolower($type); // 转小写

    if (Func::notEmpty($param)) { // 参数不为空才有效
      $_num_type = $this->getType($value, $type); // 取得类型

      if ($_num_type !== PDO::PARAM_STR && Func::isEmpty($value)) { // 如果不是字符串类型且为空
        $value = 0; // 值设为 0
      }

      if ($_num_type === PDO::PARAM_STR) { // 如果是字符串类型, 则转义处理
        $_str_value = '\'' . $value . '\'';
      } else {
        $_str_value = $value;
      }

      if (!is_numeric($param)) { // 如果参数不是数字
        $param = ':' . $param; // 添加前缀
      }

      $sql = str_ireplace($param, $_str_value, $sql);
    }

    return $sql;
  }


  /** 取得类型
   * getType function.
   *
   * @access private
   * @param mixed $value 值
   * @param string $type (default: '') 类型
   * @return void
   */
  private function getType($value, $type = '') {
    $_num_type = $this->paramType['str'];

    if (Func::isEmpty($type)) {
      if (is_bool($value)) {
        $_str_type = 'bool';
      } else if (is_numeric($value)) {
        $_str_type = 'int';
      } else if (is_string($value)) {
        $_str_type = 'str';
      }

      if (isset($this->paramType[$_str_type])) {
        $_num_type = $this->paramType[$_str_type];
      }
    } else {
      if (isset($this->paramType[$type])) {
        $_num_type = $this->paramType[$type];
      }
    }

    return $_num_type;
  }


  /** config 处理
   * configProcess function.
   *
   * @access private
   * @return config
   */
  private function configProcess() {
    $_arr_config = $this->config;

    if (strpos($_arr_config['host'], ',')) {
      $_arr_config['host'] = explode(',', $_arr_config['host']);
    }

    if (isset($_arr_config['port']) && Func::notEmpty($_arr_config['port']) && strpos($_arr_config['port'], ',')) {
      $_arr_config['port'] = explode(',', $_arr_config['port']);
    }

    if (strpos($_arr_config['dbname'], ',')) {
      $_arr_config['dbname'] = explode(',', $_arr_config['dbname']);
    }

    if (strpos($_arr_config['user'], ',')) {
      $_arr_config['user'] = explode(',', $_arr_config['user']);
    }

    if (strpos($_arr_config['pass'], ',')) {
      $_arr_config['pass'] = explode(',', $_arr_config['pass']);
    }

    if (strpos($_arr_config['charset'], ',')) {
      $_arr_config['charset'] = explode(',', $_arr_config['charset']);
    }

    $this->_config = $_arr_config;

    return $_arr_config;
  }


  /** dsn 处理
   * dsnProcess function.
   *
   * @access private
   * @return dsn 字符串
   */
  private function dsnProcess() {
    $_arr_config = $this->_config;
    $_num_rand   = 0;
    $_arr_return = array();

    if (is_array($_arr_config['host']) && isset($_arr_config['rw_separate']) && ($_arr_config['rw_separate'] === true || $_arr_config['rw_separate'] === 'true')) {
      $_num_slave  = 0;

      if (isset($_arr_config['master_count']) && $_arr_config['master_count'] > 0) {
        $_num_rand = floor(mt_rand(0, $_arr_config['master_count'] - 1));
      }

      if (isset($_arr_config['slave_no']) && $_arr_config['slave_no'] > 0) {
        $_num_slave = $_arr_config['slave_no'];
      } else {
        if (isset($_arr_config['master_count']) && $_arr_config['master_count'] > 0) {
          $_num_except = $_arr_config['master_count'];
        } else {
          $_num_except = 1;
        }

        $_num_slave = floor(mt_rand($_num_except, count($_arr_config['host']) - 1));
      }

      $this->rwSeparate = true;

      $_arr_return = array(
        'write' => $this->paramProcess($_num_rand),
        'read'  => $this->paramProcess($_num_slave),
      );
    } else {
      if (is_array($_arr_config['host'])) {
        $_num_rand = array_rand($_arr_config['host']);
      }

      $_arr_return = $this->paramProcess($_num_rand);
    }

    $this->_masterNo = $_num_rand;

    return $_arr_return;
  }


  private function paramProcess($param_no = 0) {
    $_arr_config = $this->_config;

    $_str_dsn    = $_arr_config['type'];

    if (is_array($_arr_config['host'])) {
      $_str_host = $_arr_config['host'][$param_no];
    } else {
      $_str_host = $_arr_config['host'];
    }

    $_str_dsn .= ':host=' . $_str_host;

    if (isset($_arr_config['port']) && Func::notEmpty($_arr_config['port'])) {
      if (is_array($_arr_config['port'])) {
        $_str_port = $_arr_config['port'][$param_no];
      } else {
        $_str_port = $_arr_config['port'];
      }

      $_str_dsn .= ';port=' . $_str_port;
    }

    if (is_array($_arr_config['dbname'])) {
      $_str_dbname = $_arr_config['dbname'][$param_no];
    } else {
      $_str_dbname = $_arr_config['dbname'];
    }

    $_str_dsn .= ';dbname=' . $_str_dbname;

    if (is_array($_arr_config['user'])) {
      $_str_user = $_arr_config['user'][$param_no];
    } else {
      $_str_user = $_arr_config['user'];
    }

    if (is_array($_arr_config['pass'])) {
      $_str_pass = $_arr_config['pass'][$param_no];
    } else {
      $_str_pass = $_arr_config['pass'];
    }

    if (is_array($_arr_config['charset'])) {
      $_str_charset = $_arr_config['charset'][$param_no];
    } else {
      $_str_charset = $_arr_config['charset'];
    }

    return array(
      'dsn'     => $_str_dsn,
      'user'    => $_str_user,
      'pass'    => $_str_pass,
      'charset' => $_str_charset,
    );
  }

  public function __destruct() {
    $this->obj_pdo    = null;
    $this->obj_result = null;
  }
}
