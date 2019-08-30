## 配置参考

----------

#### 综合

```php
'var_default' => array(
    'site_name'             => 'ginkgo Framework', // 站点名称
    'timezone'              => 'Asia/Shanghai', // 默认时区
    'perpage'               => 30, // 默认每页记录数
    'pergroup'              => 10, // 分页每组页数
    'return_type'           => 'html', // 默认 返回类型
    'return_type_ajax'      => 'json', // 默认 ajax 返回类型
    'jsonp_callback'        => '', // 默认 jsonp 处理方法
    'jsonp_callback_param'  => '', // 默认 jsonp 请求参数
),
```

----------

#### 语言

```php
'lang' => array( // 语言
    'switch'    => false, // 语言开关
    'default'   => 'zh_CN', // 默认语言
),
```

----------

#### 调试

```php
'debug' => array( // 调试
    'dump'  => false, // 输出调试信息 false 关闭, trace 输出 Trace
    'tag'   => 'div', // 调试信息包含在标签内
    'class' => 'container p-5', // 调试信息包含标签的 css 类名
),
```

----------

#### 日志

```php
'log' => array(
    'file_size' => 2 * 1024 * 1024, // 日志文件最大限制
),
```

----------

#### 模板

```php
'tpl' => array( // 模板
    'type'      => 'php', // 默认模板驱动
    'path'      => '', // 默认模板路径
    'sys'       => '', // 系统模板
    'suffix'    => '', // 模板后缀 (默认 .tpl.php)
),
```

----------

#### 会话

```php
'session' => array( // 会话
    'autostart'     => false, // 自动开始
    'name'          => '', // Session ID 名称
    'type'          => 'file', // 类型 (可选 db,file)
    'path'          => '', // 保存路径 (默认为 /runtime/session)
    'prefix'        => 'ginkgo_', // 前缀
    'cookie_domain' => '',
    'life_time'     => 1200, // session 生存时间
),
```

----------

#### Cookie

```php
'cookie' => array( // cookie
    'prefix'    => '', // cookie 名称前缀
    'expire'    => 0, // cookie 保存时间
    'path'      => '/', // cookie 保存路径
    'domain'    => '', // cookie 有效域名
    'secure'    => false, //  cookie 启用安全传输
    'httponly'  => false, // httponly 设置
    'setcookie' => true, // 是否使用 setcookie
),
```

----------

#### 缓存

```php
'cache' => array( //缓存
    'type'          => 'file', // 类型 (可选 file)
    'prefix'        => 'ginkgo', // 前缀
    'life_time'     => 86400, // cache 生存时间 0 为永久保存
),
```

----------

#### 路由

```php
'route' => array(
    'route_type'    => '', // 路由模式 (可选 normal, noBaseFile)
    'url_suffix'    => '', // URL 后缀
    'default_mod'   => '', // 默认模块 (默认为 index)
    'default_ctrl'  => '', // 默认控制器 (默认为 index)
    'default_act'   => '', // 默认动作 (默认为 index)
    'route_rule'    => array( // 路由规则
        /*'index/article/index' => 'index/article/show', // 静态例子 规则 => 地址
        array('article/:year/:month/:id', 'index/article/index'), // 动态例子 array(规则, 地址)
        array('/^cate[\/\S+]+\/(\d+)+\S*$/i', 'index/cate/index', 'id'),*/ // 正则例子 array(规则, 地址, 参数)
    ),
),
```

----------

#### 图片 MIME

```php
'image' => array(
    'gif' => array(
        'image/gif',
    ),
    'jpg' => array(
        'image/jpeg',
        'image/pjpeg'
    ),
    'jpeg' => array(
        'image/jpeg',
        'image/pjpeg'
    ),
    'jpe' => array(
        'image/jpeg',
        'image/pjpeg'
    ),
    'png' => array(
        'image/png',
        'image/x-png'
    ),
    'bmp' => array(
        'image/bmp',
        'image/x-bmp',
        'image/x-bitmap',
        'image/x-xbitmap',
        'image/x-win-bitmap',
        'image/x-windows-bmp',
        'image/ms-bmp',
        'image/x-ms-bmp',
        'application/bmp',
        'application/x-bmp',
        'application/x-win-bitmap'
    ),
),
```

----------

#### 加载扩展配置

```php
'config_extra' => array(
    'upload'    => true,
    'ftp'       => true,
    'smtp'      => true,
),
```

----------

#### 扩展配置默认值

```php
'var_extra' => array(
    'upload' => array( // 上传
        'limit_size'    => 200, // 上传尺寸
        'limit_unit'    => 'kb', // 尺寸单位
        'limit_count'   => 10, // 单次上传限制
        'url_prefix'    => 'http://' . $_SERVER['SERVER_NAME'], // 上传前缀
    ),
    'ftp' => array( // FTP
        'host'   => '', // 服务器
        'port'   => 21, // 端口
        'user'   => '', // 用户名
        'pass'   => '', // 密码
        'path'   => '', // 远程路径
        'pasv'   => 'off', // 被动模式
    ),
    'smtp' => array( // SMTP
        'host'          => '', // 服务器
        'secure'        => 'off', // 加密类型
        'port'          => 25, // 端口
        'auth'          => 'true', // 是否需要验证
        'user'          => '', // 用户名
        'pass'          => '', // 密码
        'from_addr'     => 'root@localhost', // 来源地址
        'from_name'     => 'root', // 来源名字
        'reply_addr'    => 'root@localhost', // 回复地址
        'reply_name'    => 'root', // 回复名字
        'debug'         => '0', // 调试模式
    ),
),
```

----------

#### 加载扩展函数

```php
'func_extra' => array(
    GK_PATH_APP . 'function' . GK_EXT,
    GK_PATH_APP . 'more_func' . GK_EXT,
),
```

----------

#### 插件
```php
'plugin' => array(), //插件
```

----------

#### 数据库

```php
'dbconfig' => array(
    'type'    => 'mysql', // 数据库类型
    'host'    => '127.0.0.1', // 服务器地址
    'name'    => 'baigo', // 数据库名
    'user'    => 'root', // 数据库用户名
    'pass'    => '', // 数据库密码
    'port'    => '', // 数据库连接端口
    'charset' => 'utf8', // 数据库编码默认采用 utf8
    'prefix'  => 'baigo_', // 数据库表前缀
    'debug'   => false, // 数据库调试模式
),
```