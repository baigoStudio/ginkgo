## 请求信息

如果要获取当前的请求信息，可以使用 `ginkgo\Request` 类：

``` php
$obj_request = Request::instance();
```

----------

##### 获取 URL 信息

``` php
$request = Request::instance();

// 获取当前域名
echo 'domain: ' . $request->domain() . '<br>';

// 获取当前入口文件
echo 'file: ' . $request->baseFile() . '<br>';

// 获取当前 URL 地址
echo 'url: ' . $request->url() . '<br>';

// 获取当前 URL 地址（包含域名）
echo 'url with domain: ' . $request->url(true) . '<br>';

// 获取当前 URL 地址 不含 QUERY_STRING
echo 'url without query: ' . $request->baseUrl() . '<br>';

// 获取 URL 访问的 ROOT 地址
echo 'root: ' . $request->root() . '<br>';

// 获取 URL 访问的 ROOT 地址（包含域名）
echo 'root with domain: ' . $request->root(true) . '<br>';
```

输出结果为：

  domain: http://ginkgo
  file: /index.php
  url: /index/index/hello.html?name=ginkgo
  url with domain: http://ginkgo/index/index/hello.html?name=ginkgo
  url without query: /index/index/hello.html
  root: /
  root with domain: http://ginkgo

----------

##### 模块 / 控制器 / 动作 名称

获取全部

``` php
$request = Request::instance();

// 获取实际 模块 / 控制器 / 动作 名称
$route = $request->route();
echo '实际模块名称是' . $route['mod'];
echo '实际控制器名称是' . $route['ctrl'];
echo '实际动作名称是' . $route['act'];

// 获取原始 模块 / 控制器 / 动作 名称
$routeOrig = $request->routeOrig();
echo '原始模块名称是' . $routeOrig['mod'];
echo '原始控制器名称是' . $routeOrig['ctrl'];
echo '原始动作名称是' . $routeOrig['act'];
```

如果当前访问的地址是

> http://server/index.php/index/index/hello_world

输出结果为：

  实际模块名称是 index
  实际控制器名称是 index
  实际动作名称是 helloWorld

  原始模块名称是 index
  原始控制器名称是 index
  原始动作名称是 hello_world

如果当前访问的地址是

> http://server/index.php/index/index/hello_world

路由定义为：

``` php
'route' => array(
  'route_rule'    => array( //路由规则
    'admin/hello/index' => 'index/index/hello_world',
  ),
),
```

输出结果为：

  实际模块名称是 index
  实际控制器名称是 index
  实际动作名称是 helloWorld

  原始模块名称是 admin
  原始控制器名称是 hello
  原始动作名称是 index

设置路由可以调用 `setRoute()` 方法。

``` php
$request = Request::instance();

$route = array(
  'mod'   => 'index', // 可选
  'ctrl'  => 'index', // 可选
  'act'   => 'hello_world', // 可选
);

$request->setRoute($route);
```

----------

##### 获取请求参数

``` php
$request = Request::instance();
echo '请求方法：' . $request->method() . '<br>';
echo '访问ip地址：' . $request->ip() . '<br>';
echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br>';
echo '请求参数：';
print_r($request->getParam());
```

输出结果为：

  请求方法：GET
  访问ip地址：127.0.0.1
  是否Ajax请求：false
  请求参数：
  array (
    'test' => ddd,
    'name' => ginkgo,
  );
