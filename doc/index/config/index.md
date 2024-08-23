## 配置概况

系统默认的配置目录为 `GK_PATH_APP` 的 `config` 目录下，分为应用配置和模块配置，模块配置位于各模块目录下。

```
+-- app 应用目录（可设置）
|   +-- config                      配置目录
|   |   +-- config.inc.php          应用配置
|   |   +-- dbconfig.inc.php        数据库配置
|   |   +-- extra_smtp.inc.php      smtp 配置
|   |   +-- extra_upload.inc.php    上传配置
|   |   +-- extra_ftp.inc.php       ftp 分发配置
|   |   +-- module1                 模块1（示例）
|   |   |   +-- common.inc.php      模块1 公用配置
|   |   |   +--  ...                更多配置
|   |   |
|   |   +-- module2                 模块2（示例）
|   |   +--  ...                    更多模块
```

如果希望更改配置目录的位置，可以在入口文件中定义配置目录的位置，添加 `GK_APP_CONFIG` 常量定义即可，例如：

``` php
// 定义配置目录
define('GK_APP_CONFIG', __DIR__ . '/../config/');

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```

如果只想变更配置目录的名称，也可以添加 `GK_NAME_CONFIG` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_CONFIG', 'config');
```

> 注意：常量定义必须在加载框架引导文件之前

* 系统会自动加载 `config.inc.php`、`dbconfig.inc.php` 这两个默认配置文件。
* 如果存在 `extra_smtp.inc.php`、`extra_upload.inc.php` 和 `extra_ftp.inc.php` 这几个扩展配置文件，系统会自动加载。
* 如果存在 `./app/config/当前模块名/common.inc.php` 模块配置，系统会自动加载。
* 如果存在 `./app/config/当前模块名/控制器名.inc.php` 控制器配置，系统会自动加载。 `0.1.2` 新增
* 如果需要额外的配置，可以通过配置增加或者手动加载。

> 注意：配置文件必须以 `.inc.php` 结尾
