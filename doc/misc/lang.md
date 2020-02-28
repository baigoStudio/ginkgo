## 多语言

多语言支持由 `ginkgo\Lang` 类提供，如果你的应用涉及到多语言，可以定义相关的语言包。

默认情况下，系统载入的是默认语言包，并且不会自动侦测当前系统的语言。

语言设置位于 `lang` 配置参数内，系统默认设置为：

``` php
'lang' => array(
    'switch'    => false, //多语言切换
    'default'   => 'zh_CN', //默认语言
),
```

多语言切换开启后，系统会自动检测当前环境，目前，语言自动检测功能仅提供检测，开发者需要自行完善自动设置与记忆。

必须先实例化语言类才能在需要的地方使用，如：

``` php
$lang = Lang::instance();
```

----------

#### 获取当前语言


``` php
echo $lang->getCurrent();
```

`getCurrent` 方法说明

``` php
function getCurrent( [$lower = false [, $separator = '' [, $client = false]]] )
```
参数

0.1.1 新增

* `lower` 是否小写
    
* `separator` 分割线

* `client` 取得自动检测的语言值

----------

#### 获取语言变量

使用 `get` 方法
 
``` php
echo $lang->get('Add user error');
```

`get` 方法说明

``` php
function get( $name [, $range = '' [, $replace = array() [, $show_src = true]]] )
```

参数

* `name` 变量名
    
* `range` 作用域

* `replace` 输出替换

* `show_src` 是否返回变量名


模板中已内置 `$lang` 实例，可以直接使用，如：

``` php
<?php echo $lang->get('page_error'); ?>
<?php echo $lang->get('var_error'; ?>
```

如果继承了 `ginkgo\Ctrl 类`，可以直接调用实例：

``` php
class Ctrl {
    // ginkgo\Lang 的实例
    protected $obj_lang;
}
```

验证类 `ginkgo\Validate` 内置了如下类的实例：
 
``` php
class Validate {
    // ginkgo\Lang 的实例
    protected $obj_lang;
}
```

语言定义一般采用英语来描述。

----------

#### 语言定义

系统会默认加载下面三个语言包：

* 框架语言包 `./ginkgo/lang/当前语言.lang.php`
* 模块语言包 `./app/lang/当前语言/模块/common.lang.php`
* 控制器语言包 `./app/lang/当前语言/模块/控制器.lang.php`

> 注意：为了符合开发规范，所有文件名必须小写，当前语言转换为语言包路径时，系统会做自动转换。

如果还需要加载其他语言包，可以用 `load` 方法加载：

``` php
$lang->load(GK_APP_LANG . 'zh_CN.php');
```

语言包定义格式是 PHP 返回数组的方式，例如：

``` php
return array(
     'Hello ginkgo'     => '欢迎使用 Ginkgo',
     'data type error'  => '数据类型错误',
);
```

也可以动态定义语言值，例如：

``` php
$lang->set('define2', '语言定义');
$value = $lang->get('define2');
```

----------

#### 输出替换

支持对语言变量输出的内容进行替换，例如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

    public function index() {
        $replace = array(
            'name'  => 'Ginkgo',
            'email' => 'ginkgo@qq.com',
        );
        
        echo $this->obj_lang->get('Hello {:name}', '', $replace);
        echo $this->obj_lang->get('Email: {:email} not found', '', $replace);
    }

}
```

假设语言包如下：

``` php
return array(
     'Hello {:name}'                => '欢迎使用 {:name}',
     'Email: {:email} not found'    => 'Email: {:email} 未找到',
);
```

此时，上述例子获取的语言变量为：

> * 欢迎使用 Ginkgo
> * Email: ginkgo@qq.com 未找到

语言包未定义的情况下，上述例子获取的语言变量为：

> * Hello Ginkgo
> * Email: ginkgo@qq.com not found


----------

## 语言作用域

语言变量支持作用域，默认情况下，所有参数都在默认作用域下面。如果语言需要用于不同的项目或者相互隔离，那么就可以使用作用域，作用域的作用好比是语言变量的命名空间一样。ginkgo 支持二级作用域，两级作用域之间用 <kbd>.</kbd> 隔开。

``` php
// 导入 my_lang.lang.php 中的语言变量，并纳入 user 作用域
$lang->load('my_lang.lang.php', '', 'user'); 

// 设置 user_type 参数，并纳入 user 作用域
$lang->set('user_type', '用户类型', 'user'); 

// 批量设置语言变量，并纳入 test 作用域
$lang->set($my_lang, '', 'test'); 

// 批量设置语言变量，并纳入 test 下面的 abc 作用域
$lang->set($my_lang, '', 'test.abc'); 

// 读取 user 作用域的 user_type 语言变量
echo $lang->get('user_type', 'user'); 
```

可以使用 `range` 方法切换当前语言的作用域，例如：

``` php
$lang->range('test');
```