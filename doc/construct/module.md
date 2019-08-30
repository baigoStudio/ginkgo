## 模块设计

标准的应用和模块目录结构如下

    +-- app                      应用目录（可设置）
    |  +-- classes               类库目录
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- config                配置目录
    |  |  +-- config.inc.php     应用配置
    |  |  +-- dbconfig.inc.php   数据库配置
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- ctrl                  控制器目录
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- lang                  语言目录
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- model                 数据模型目录
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- tpl                   模板目录
    |  |  +-- module1            模块1（示例）
    |  |  |  +-- default         default 模板（示例）
    |  |  |  +-- test            test 模板（示例）
    |  |  |  +--  ...
    |  |  |
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- validate              验证器目录
    |  |  +-- module1            模块1（示例）
    |  |  +-- module2            模块2（示例）
    |  |  +--  ...               更多模块
    |  |
    |  +-- common.php            公共文件

> 目录必须采用小写和下划线命名

如果希望更改各目录的位置，可以在入口文件中定义常量，如：

添加 `GK_APP_CONFIG` 可以更改配置文件的目录：

``` php
// 定义配置目录
define('GK_APP_CONFIG', __DIR__ . '/../config/');

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```
    
如果只想改变配置目录的名称，也可以添加 `GK_NAME_CONFIG` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_CONFIG', 'config');
```

添加 `GK_PATH_APP` 可以更改应用目录的位置：

``` php
// 定义配置目录
define('GK_PATH_APP', __DIR__ . '/../app/'); //应用目录

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```
    
如果只想改变应用目录的名称，也可以添加 `GK_NAME_APP` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_APP', 'app');
```

> 注意：常量定义必须在加载框架引导文件之前 

详情请查看 `配置 -> 常量配置` 章节

> 模块名称请避免使用 PHP 保留关键字，保留字列表参见 <http://php.net/manual/zh/reserved.keywords.php>，否则会造成系统错误。