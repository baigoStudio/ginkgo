## 模块设计

标准的应用和模块目录结构如下

  +-- app                        应用目录（可设置）
  |   +-- classes                类库目录
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- config                 配置目录
  |   |   +-- config.inc.php     应用配置
  |   |   +-- dbconfig.inc.php   数据库配置
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- ctrl                   控制器目录
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- lang                   语言目录
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- model                  数据模型目录
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- tpl                    模板目录
  |   |   +-- module1            模块1（示例）
  |   |   |   +-- default        default 模板（示例）
  |   |   |   +-- test           test 模板（示例）
  |   |   |   +--  ...
  |   |   |
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- validate               验证器目录
  |   |   +-- module1            模块1（示例）
  |   |   +-- module2            模块2（示例）
  |   |   +--  ...               更多模块
  |   |
  |   +-- common.php             公共文件

> 目录必须采用小写和下划线命名

如果希望更改各目录的位置，可以在入口文件中定义常量，如：

添加 `GK_APP_CONFIG` 可以更改配置文件的目录：

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

添加 `GK_PATH_APP` 可以更改应用目录的位置：

``` php
// 定义配置目录
define('GK_PATH_APP', __DIR__ . '/../app/'); //应用目录

// 加载框架引导文件
require(__DIR__ . '/../ginkgo/boot.php');
```

如果只想变更应用目录的名称，也可以添加 `GK_NAME_APP` 常量定义，例如：

``` php
// 定义配置目录
define('GK_NAME_APP', 'app');
```

> 注意：常量定义必须在加载框架引导文件之前

详情请查看 [配置 -> 常量配置](../config/const.md)

> 模块名称请避免使用 PHP 保留关键字，保留字列表参见 [php 官网](http://www.php.net/manual/zh/reserved.keywords.php)，否则会造成系统错误。

----------

##### 特别注意

根据 [概况 -> 开发规范](../index/spec.md) 的要求，因此 ginkgo 采用了如下两种自动转换的策略：

* 文件夹和文件的命名使用使用小写和下划线，当路由中的模块与控制器为小写字母和横杠时，系统会将横杠 <kbd>-</kbd> 转换为下划线 <kbd>_</kbd>。

* 方法的命名使用驼峰法（首字母小写），但是路由都使用小写，当路由中的动作命名为小写字母和下划线或横杠时，系统会将动作自动转换为驼峰法（首字母小写）。

如果当前访问的地址是

> http://server/index.php/mod-index/ctrl-index/hello-world `0.1.1` 新增

或

> http://server/index.php/mod_index/ctrl_index/hello_world

控制器的实际位置是

> app/ctrl/mod_index/ctrl_index.ctrl.php

控制器类定义如下：

``` php
namespace app\ctrl\mod_index;

class Ctrl_Index {
  public function helloWorld() {
    return 'hello_world';
  }
}
```
