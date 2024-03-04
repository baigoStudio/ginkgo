## ginkgo\Except

`0.2.2` 之前为 `ginkgo\Exception`

异常处理，完善 [php 原生异常处理类](https://www.php.net/manual/zh/class.exception.php)

----------

### 类摘要

```php
namespace ginkgo;

class Except extends \Exception {
  // 属性
  private $statusCode;
  private $data = array();

  // 方法
  public __construct( string $message [, int $statusCode = 0 [, int $code = 0 [, string $file [, int $line [, object \Exception $previous = null ]]]]] ) : object
  public getStatusCode() : int
  public setData( $name [, array $data ] )
  public getData( [ string $name ] ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$statusCode` | private | int | HTTP 状态码 |
| `$data` | private | array | 错误详情 |
| 方法 | - | - | - |
| __construct() | public | | 构造函数 |
| [getStatusCode()](#getStatusCode()) | public | | 获取 HTTP 状态码 |
| [setData()](#setData()) | public | | 设置错误详情 |
| [getData()](#getData()) | public | | 获取错误详情 |

----------

<span id="__construct()"></span>

#### `__construct()` 初始化

``` php
public function __construct( string $message [, int $statusCode = 0 [, int $code = 0 [, string $file [, int $line [, object \Exception $previous = null ]]]]] ) : object
```

参数

* `message` 错误消息
* `statusCode` HTTP 状态码
* `code` 错误代码
* `file` 错误所在文件
* `line` 错误所在行
* `previous` 上一个异常对象

返回

* 本类实例

----------

<span id="getStatusCode()"></span>

#### `getStatusCode()` 获取 HTTP 状态码

``` php
public function getStatusCode() : int
```

参数

* 无

返回

* HTTP 状态码

----------

<span id="setData()"></span>

#### `setData()` 设置错误详情

``` php
public function setData( $name [, array $data ] )
```

参数

* `name` 错误名
* `data` 错误详情

返回

* 无

----------

<span id="getData()"></span>

#### `getData()` 获取错误详情

``` php
public function getData( [ string $name ] ) : mixed
```

参数

* `name` 错误名

返回

* 错误详情
