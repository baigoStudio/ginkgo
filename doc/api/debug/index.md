## ginkgo\Debug

调试信息处理

----------

### 类摘要

```php
namespace ginkgo;

class Debug {
  // 属性
  public static $error;

  private static $data;
  private static $init;
  private static $obj_request;

  // 方法
  public static init()
  public static get( [ string $name ] ) : mixed
  public static record( string $name, string $value )
  public static inject( mixed $content [, string $type = 'html' ] ) : mixed
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$error` | public | array static | 错误消息 |
| `$data` | private | array static | 错误类型 |
| `$init` | private | bool static | 是否初始化 |
| [`$obj_request`](../request/index.md) | private | object static | 请求实例 |
| 方法 | - | - | - |
| [init()](#init()) | public | static | 初始化 |
| [get()](#get()) | public | static | 取得错误 |
| [record()](#record()) | public | static | 记录错误 |
| [inject()](#inject()) | public | static | 注入调试信息 |

----------

<span id="init()"></span>

#### `init()` 初始化

``` php
public static function init()
```

参数

* 无

返回

* 无

----------

<span id="get"></span>

#### `get()` 取得错误

``` php
public static function get( [ string $name ] ) : mixed
```

参数

* `name` 错误名，如为空表示返回所有错误

返回

* 错误信息

----------

<span id="record"></span>

#### `record()` 记录错误

``` php
public static function record( string $name, string $value )
```

参数

* `name` 错误名
* `value` 错误内容

返回

* 无

----------

<span id="inject"></span>

#### `inject()` 注入调试信息

``` php
public static function inject( mixed $content [, string $type = 'html' ] ) : mixed
```

参数

* `content` 待注入内容
* `type` 待注入内容的类型

  可能的值

  | 值 | 描述 |
  | - | - |
  | html（默认值） | HTML |
  | arr | 数组 |

返回

* 注入后的结果
