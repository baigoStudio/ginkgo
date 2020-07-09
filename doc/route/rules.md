## 路由规则

路由规则是一个多维数组，可以包含多条规则，路由规则定义是从根目录开始，而不是基于模块名的。根目录是基于项目部署位置的 PATH_INFO，如：

> * __http://server/index.php/__ 是一个根目录
> * __http://server/project/index.php/__ 也是一个根目录

规则的定义以 / 为参数分割符（无论的 PATH_INFO 分隔符设置是什么，请确保在定义路由规则表达式的时候统一使用 / 进行 URL 参数分割）。以下是一些例子：

``` php
'route' => array(
    'route_rule'    => array( //路由规则
        //静态例子 规则 => 地址
        'index/article/index' => 'index/article/show', 
        
        //动态例子 array(规则, 地址)
        array('article/:year/:month/:id', 'index/article/index'), 
        
        //正则例子 array(规则, 地址, 参数)
        array('/^cate[\/\S+]+\/(\d+)+\S*$/i', 'index/cate/index', 'id'), 

        ... // 更多规则
    ),
),
```

----------

##### 静态规则
    
静态规则为一个 `键名 => 键值` 方式表达的数组，如：

``` php
'route_rule' => array( // 路由规则
    'article/show' => 'index/article/show', // 规则 => 地址
    ... // 更多规则
),
```

* 访问 __http://server/index.php/`article/show`__

    会自动路由到 __http://server/index.php/index/article/show__

* 系统会忽略规则外的 URL 部分，还是以上述规则为例，访问 __http://server/index.php/`article/show`/test__

    会自动路由到 __http://server/index.php/index/article/show__

----------

##### 动态规则

动态规则为一个 `array(规则, 地址)` 方式表达的数组，如：

``` php
'route_rule' => array( // 路由规则
    array('article/:year/:month/:id', 'index/article/index') // array(规则, 地址)
    ... // 更多规则
),
```

* 访问 __http://server/index.php/`article/2015/06/234325`__

    会自动路由到 __http://server/index.php/index/article/show/year/2015/month/06/id/234325__

* 系统会忽略规则外的 URL 部分，还是以上述规则为例，访问 __http://server/index.php/`article/2015/06/234325`/status/public__

    会自动路由到 __http://server/index.php/index/article/show/year/2015/month/06/id/234325/status/public__
    
每个参数中以 <kbd>:</kbd> 开头的参数都表示动态变量，并且会自动绑定到动作的对应参数。
    
----------

##### 正则规则

正则规则为一个 `array(规则, 地址, 参数)` 方式表达的数组，其中 `参数` 可以为数组或者字符串，系统会根据正则规则匹配到的结果，自动绑定到动作的对应参数，如：

``` php
'route_rule' => array( // 路由规则
    array('/^cate[\/\S+]+\/(\d+)+\S*$/i', 'index/cate/index', 'id') // array(正则规则, 地址, 参数)
    ... // 更多规则
),
```

* 访问 __http://server/index.php/`cate/234325`__

    会自动路由到 __http://server/index.php/index/cate/index/id/234325__

* 系统会忽略规则外的 URL 部分，还是以上述规则为例，访问 __http://server/index.php/`cate/234325`/status/public__

    会自动路由到 __http://server/index.php/index/cate/index/id/234325/status/public__


``` php
'route_rule' => array( // 路由规则
    array('/^cate[\/\x{4e00}-\x{9fa5}a-zA-Z0-9\_\-]+\/id\/(\d+)+(\/page\/(\d+))?.*$/ui', 'index/cate/index', array('id', '', 'page')), //正则例子 array(规则, 地址, 参数)
    ... // 更多规则
),
```

* 访问 __http://server/index.php/`cate/news/art/id/234325/page/2`__

    会自动路由到 __http://server/index.php/index/cate/index/id/234325/page/2__

* 系统会忽略规则外的 URL 部分，还是以上述规则为例，访问 __http://server/index.php/`cate/news/art/id/234325/page/2`/status/public__

    会自动路由到 __http://server/index.php/index/cate/index/id/234325/page/2/status/public__

----------

##### 特别注意

根据 [概况 -> 开发规范](../overview/spec.md) 的要求，因此 ginkgo 采用了如下两种自动转换的策略：

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