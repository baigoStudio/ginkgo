## 渲染

因为控制器可以无需继承任何基础类，因此在控制器中如何使用视图取决于你怎么定义控制器。

渲染模板最常用的方法是控制器继承 `ginkgo\Ctrl` 类后调用 `fetch` 方法：

`fetch` 方法说明

``` php
function fetch( [$template = '' [, $assign = '' [, $value = '']]] )
```

参数

* `template` 模板

    支持如下几种写法：

    | 用法 | 描述 | 规则 |
    | - | - | - |
    | 不带任何参数	 | 自动定位 | app/tpl/`当前模块/当前控制器/当前动作`.tpl.php |
    | 动作 | 常用写法 | app/tpl/当前模块/当前控制器/`动作`.tpl.php |
    | 控制器/动作 | 常用写法 | app/tpl/当前模块/`控制器/动作`.tpl.php |
    | 完整的模板路径 | 必须包含模板后缀 | 模板后缀必须与系统配置一致，详情请查看 `配置 -> 常量配置` 和 `附录 -> 配置参考` 章节 |

* `assign` 变量

    支持两种类型：字符串、数组

* `value` 变量值

    当 `assign` 为字符串时为必须，当 `assign` 为数组时自动忽略。
        

下面是一个最典型的用法，不带任何参数：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function index() {
        // 不带任何参数 自动定位当前动作的模板文件
        return $this->fetch();
    }

}
```

文件名为实际动作的小写和下划线，如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function cateList() {
        return $this->fetch();
    }

}
```

模板的文件名为

> `cate_list`.tpl.php

模板的实际位置是

> app/tpl/`index/index/cate_list`.tpl.php

如果没有按照定义规则来定义模板（或者需要调用其他模板），可以使用：

``` php
// 指定模板输出
return $this->fetch('edit');
```

表示调用当前控制器下面的 edit 模板

``` php
return $this->fetch('member/read');
```

表示调用 Member 控制器下面的 read 模板。

----------

#### 跨模块渲染模板及自定义模板路径

渲染输出不需要写模板的路径和后缀。这里的控制器和动作并不一定需要有实际对应的控制器和动作，只是一个目录名称和文件名称而已，例如，你的项目里面可能根本没有 Public 控制器，更没有 Public 控制器的 menu 动作，但是一样可以使用

``` php
return $this->fetch('public/menu');
```

输出这个模板文件。理解了这个，模板输出就清晰了。

支持从设置的根目录开始读取模板，以下是默认设置下的例子：

``` php
return $this->fetch('/menu');
```

表示读取的模板是

> app/tpl/当前模块/menu.tpl.php

如果需要调用视图类 `ginkgo\View` 的其它方法，可以直接使用 `$this->obj_view` 对象。

如果你的模板位置比较特殊或者需要自定义模板的位置，可以通过写入完整模板路径、调用 `ginkgo\View` 的 `setPath` 方法或者修改配置来实现。

自动定位

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function cateList() {
        return $this->fetch();
    }

}
```

明确写入模板路径和后缀

``` php
return $this->fetch('/web/app/tpl/index/index/cate_list.tpl.php');
```

调用 `setPath` 方法

``` php
$this->obj_view->setPath('/web/app/tpl/index/');

return $this->fetch('index/cate_list');
```

以上方式的效果是一致的。

模板配置的 path 参数支持完整路径定义，默认采用 app/tpl/ 作为模板目录

``` php
'tpl' => array(
    'path'   => 'default', // 定义模板目录
    ...
);
```

模板的实际目录是

> app/tpl/default/

``` php
'tpl' => array(
    'path'   => '/web/app/tpl/', // 定义模板根目录
    ...
);
```

模板的实际目录是

> /web/app/tpl/

----------

#### 渲染内容

如果希望直接解析内容而不通过模板文件的话，可以使用 `display` 方法：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function index() {
        // 直接渲染内容
        $content = '\<?php echo $name; ?\> - \<?php echo $email; ?\>';
        $data = array(
            'name'  => 'ginkgo', 
            'email' => 'ginkgo@qq.com'
        );
        return $this->display($content, $data);
    }
}
```
