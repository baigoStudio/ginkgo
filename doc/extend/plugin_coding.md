## 编写插件

----------

#### 主文件

文件名必须为 `.class.php` 为后缀，文件名可以和目录同名，也可由描述文件中的 class 项定义。如：

``` javascript
{
    "name": "Hello",
    "class": "Hello",
    ...
}
```

实际文件名为 `hello.class.php`。该文件必须包含一个类，名称与文件名相同，类名应当注意是否重名。

示例代码

``` php
namespace extend\plugin\hello;

use ginkgo\Plugin;

if (!class_exists('extend\plugin\hello\Hello')) { // 防止类重复

    class Hello {

        public $config = array();
        public $opts = array();

        function __construct() {
            // 定义动作
            // 第一个参数是 钩子 的名称
            // 第二个参数是 对象名 必须为本类
            // 第三个是插件所执行的 方法（函数）
            Plugin::add('action_console_menu_plugin', $this, 'sayHello');
        }

        //参数由 listen 侦听方法所传递过来
        function sayHello($param) {
            //echo '<div>test</div>';

            $param = str_ireplace('__baigo__', 'BAIGO', $param);

            return $param;
        }
        
    }

}
```

----------

#### 定义动作

可以使用 `ginkgo\Plugin` 类的 `add` 方法向指定的钩子添加动作，此方法一般用于插件中，例如：

``` php
namespace extend\plugin\hello;

use ginkgo\Plugin;

class Hello {

    function __construct() {
        Plugin::add('action_console_menu_plugin', $this, 'sayHello'); // 单个定义
        Plugin::add('action_console_menu_plugin', $this, array('doHello', 'testHello')); // 批量定义
    }

    function sayHello($param) {
        return $param;
    }
    
    function doHello($param) {
        return $param;
    }

    function testHello($param) {
        return $param;
    }

}
```

----------

#### 插件属性

插件类中可以定义 config 与 opts 属性，必须声明为 public，系统在初始化插件时，会自动读取 `config.json` 和 `opts_var.json` 文件，并将值定义为插件类的属性，如：

``` php
namespace extend\plugin\hello;

use ginkgo\Plugin;

class Hello {

    public $config;
    public $opts;
    
    function __construct() {
        Plugin::add('action_console_menu_plugin', $this, 'sayHello'); // 单个定义
    }

    function sayHello($param) {
        print_r($this->config);
    }
    
}
```

> 0.1.1 起由 `.inc.php` 更改为 `.json`

----------

#### 描述文件

文件名必须为 `config.json`，此文件直接返回数组，如：

``` javascript
{
    "name": "Hello",
    "class": "Hello",
    "version": "1.0",
    "author": "Baigo",
    "plugin_url": "http://www.baigo.net/cms/plugin/hello",
    "detail": "本插件为一个开发示例",
    "author_url": "http://www.baigo.net"
}
```
> 0.1.1 起由 `config.inc.php` 更改为 `config.json`

说明如下

| 键名 | 描述 |
| - | - | - |
| name | 插件的名称。 |
| class | 类名，安装插件以后，系统会自动实例化该类。 |
| version | 版本 |
| author | 作者 |
| detail | 说明 |
| plugin_url | 插件网址，由该开发者自行设立，介绍插件的使用方法等。 |
| author_url | 作者网址，由该开发者自行设立，介绍作者等。 |

