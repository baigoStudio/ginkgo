## 扩展配置

ginkgo 支持扩展配置，只需要在公共配置文件中配置 `config_extra` 参数。扩展配置加载的值全部位于配置的 `var_extra` 分支下。

下面以 ftp 配置信息为例，ftp 扩展配置默认位于 `var_extra` 下的 `ftp` 分支中：

``` php
'var_extra' => array(
    'ftp' => array(
        'host'   => '127.0.0.1', // 服务器地址
        'port'   => 21, // 端口
        'user'   => '', // 用户名
        'pass'   => '', // 密码
        'path'   => '/', // 远程路径
        'pasv'   => 'off', // 被动模式
    ),
),
```

如果需要使用扩展配置，则首先在 `config.inc.php` 中添加配置：

``` php
'config_extra' => array(
    'ftp' => true, // 必须使用 参数名 => 参数值 的形式
),
```

必须使用 `参数名 => 参数值` 的形式，参数值必须为 true 或 'true'。

定义之后，ftp 配置就可以独立使用 `extra_ftp.inc.php` 文件，配置内容如下：

``` php
/* ftp 设置 */
return array(
    'host'   => '127.0.0.1', // 服务器地址
    'port'   => 21, // 端口
    'user'   => '', // 用户名
    'pass'   => '', // 密码
    'path'   => '/', // 远程路径
    'pasv'   => 'off', // 被动模式
);
```

如果配置了 `config_extra` 参数，并同时在 `config.inc.php` 和 `extra_ftp.inc.php` 文件中配置，则 `extra_ftp.inc.php` 文件的配置会覆盖 `config.inc.php` 中的设置。

要获取 ftp 配置文件的 pasv 参数，应该是：

``` php
Config::get('pasv', 'var_extra.ftp');
```

要获取完整的 ftp 扩展配置的参数，则使用：

``` php
Config::get('ftp', 'var_extra');
```