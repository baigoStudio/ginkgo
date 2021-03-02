## 输入变量

可以通过 `Request` 对象输入变量的获取和安全过滤，支持 `$_GET`、`$_POST`、`$_REQUEST`、`$_SERVER`、`$_SESSION`、`$_COOKIE` 等系统变量。

----------

##### 变量获取

| 方法 | 描述 |
| - | - |
| get | 获取 $_GET 变量 |
| post | 获取 $_POST 变量 |
| request | 获取 $_REQUEST 变量 |
| param | 获取 PARAM 变量 |
| session | 获取 $_SESSION 变量 |
| cookie | 获取 $_COOKIE 变量 |
| server | 获取 $_SERVER 变量 |

----------

##### 获取 GET 变量

``` php
$request = Request::instance();

$request->get('id'); // 获取某个 get 变量
$request->get('name'); // 获取 get 变量
$request->get(); // 获取所有的 get 变量（经过滤）
$request->get(false); // 获取所有的 get 变量（原始）
```

`get()` 方法说明：

``` php
function get( [ $name = true [, $type = 'str' [, $default = '' ]]] )
```

参数

* `name` 变量名

    支持三种类型

    布尔值：true (默认)，取得所有被过滤的变量，false，取得所有原始变量

    字符串：取得指定变量

    数组：取得数组指定的变量，如不存在或为空，则自动用空值补全。

* `type` 类型

    当 `name` 为数组时自动忽略。

    可能的值

    | 值 | 描述 |
    | - | - |
    | str（默认值） | 字符串 |
    | int | 整数 |
    | float | 浮点数 |
    | num | 数字 |
    | arr | 数组 |

* `default` 默认值

    当 `name` 为数组时自动忽略。

说明：当变量不存在或者类型不符合时，会用默认值填充变量。

``` php
$request = Request::instance();

$id = $request->get('id' 'int', 0);
```

 变量名为多维数组时：

``` php
$inputParam = array(
    // '变量名'      => array('类型', '默认值'),
    'admin_id'      => array('int', 0),
    'admin_name'    => array('txt', ''),
    'admin_pass'    => array('txt', ''),
    'admin_note'    => array('txt', ''),
    'admin_status'  => array('txt', ''),
    'admin_type'    => array('txt', ''),
);

$submitInput = $this->obj_request->get($inputParam);
```

----------

##### 获取 POST 变量

``` php
$request = Request::instance();

$request->post('id'); // 获取某个 post 变量
$request->post('name'); // 获取 post 变量
$request->post(); // 获取所有的 post 变量（经过滤）
$request->post(false); // 获取所有的 post 变量（原始）
```

`post()` 方法的用法与 `get()` 方法相同

----------

##### 获取 REQUEST 变量

``` php
$request = Request::instance();

$request->request('id'); // 获取某个 request 变量
$request->request('name'); // 获取 request 变量
$request->request(); // 获取所有的 request 变量（经过滤）
$request->request(false); // 获取所有的 request 变量（原始）
```

`request()` 方法的用法与 `get()` 方法相同

----------

##### 获取 PARAM 变量

PARAM 变量是框架提供的用于优化 URL 的变量，详情请查看 [架构 -> URL 访问](../construct/url.md)。

``` php
$request = Request::instance();

$request->param('id'); // 获取某个 param 变量
$request->param('name'); // 获取 param 变量
$request->param(); // 获取所有的 param 变量（经过滤）
$request->param(false); // 获取所有的 param 变量（原始）
```

`param()` 方法的用法与 `get()` 方法相同

----------

##### 获取 SESSION 变量

``` php
$request = Request::instance();

$request->session('id'); // 获取某个 session 变量
$request->session('name'); // 获取 session 变量
$request->session(); // 获取所有的 session 变量
```

----------

##### 获取 COOKIE 变量

``` php
$request = Request::instance();

$request->cookie('id'); // 获取某个 cookie 变量
$request->cookie('name'); // 获取 cookie 变量
$request->cookie(); // 获取所有的 cookie 变量
```

----------

##### 获取 SERVER 变量

``` php
$request = Request::instance();

$request->server('id'); // 获取某个 server 变量
$request->server('name'); // 获取 server 变量
$request->server(); // 获取所有的 server 变量
```
