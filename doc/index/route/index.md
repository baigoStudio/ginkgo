## 路由概况

ginkgo 默认采用的 URL 规则是：

``` markup
http://server/index.php/mod/ctrl/act/param/value/...
```

路由的作用是简化 URL 访问地址，并根据定义的路由类型做出正确的解析。

ginkgo 的路由支持三种方式的 URL 解析规则。

1. 静态规则
2. 动态规则
3. 正则规则

三种规则的示例：

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
