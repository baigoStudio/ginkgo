## 路由定义

路由定义可以使用两种方式，包括路由配置和动态注册。

----------

##### 路由配置

路由配置位于应用目录下面的 `config.inc.php` 文件，`route` 参数下的 `route` 分支，如：

``` php
'route' => array(
    'route_rule'    => array( //路由规则
        //静态例子 规则 => 地址
        'index/article/index' => 'index/article/show', 
        
        //动态例子 array(规则, 地址)
        array('article/:year/:month/:id', 'index/article/index'), 
        
        //正则例子 array(规则, 地址, 参数)
        array('/^cate[\/\S+]+\/(\d+)+\S*$/i', 'index/cate/index', 'id'), 
    ),
),
```

----------

##### 动态注册

路由定义采用 `ginkgo\Route` 类的 rule 方法注册，例如：

``` php
use ginkgo\Route;

$rule = array(
    //静态例子 规则 => 地址
    'index/article/index' => 'index/article/show', 
    
    //动态例子 array(规则, 地址)
    array('article/:year/:month/:id', 'index/article/index'), 
    
    //正则例子 array(规则, 地址, 参数)
    array('/^cate[\/\S+]+\/(\d+)+\S*$/i', 'index/cate/index', 'id'), 
);
    
Route::rule($rule);
```
