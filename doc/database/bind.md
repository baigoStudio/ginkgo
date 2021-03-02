## 参数绑定

除了使用原生 SQL 以外，大多数情况下无需进行手动绑定，系统会在查询和写入数据的时候自动使用参数绑定。

ginkgo 支持占位符绑定，可以使用 `bind()` 方法绑定参数，例如：

``` php
Db::prepare('insert into user (name) values (:name)');
Db::bind('name', 'baigo', 'str');
Db::execute();
```

`bind()` 方法说明

``` php
function bind( $bind [, $value = '' [, $type = '' ]] )
```
参数

* `bind` 名称

    支持两种类型：为字符串时表示占位符，为数组时表示批量绑定

* `value` 值

    当 `bind` 为字符串时为必须，当 `bind` 为数组时自动忽略。

* `type` 类型

    为空时自动识别类型，当 `bind` 为数组时自动忽略。

    可能的值

    | 值 | 描述 |
    | - | - |
    | str（默认值） | 字符串 |
    | int | 整数 |
    | float | 浮点数 |
    | double | 数字 |
    | bool | 布尔值 |

----------

#### 批量绑定

支持批量绑定参数，例如：

``` php
$bind = array(
    // array('名称', '值', '类型'),
    array('id', 8),
    array('name', 'baigo'),
);

Db::prepare('insert into user (id, name) values (:id, :name)');
Db::bind($bind);
Db::execute();
```

----------

#### 其他方法

`execute()` 方法也支持绑定参数，用法与 `bind()` 方法相同，例如：

``` php
$bind = array(
    array('id', 8),
    array('name', 'baigo'),
);

Db::prepare('insert into user (id, name) values (:id, :name)');
Db::execute($bind);
```

`prepare()` 方法也支持绑定参数，用法与 `bind()` 方法类似，例如：

``` php
// 单个绑定
Db::prepare('insert into user (name) values (:name)', 'name', 'baigo', 'str');
Db::execute();

// 批量绑定
$bind = array(
    array('id', 8),
    array('name', 'baigo'),
);

Db::prepare('insert into user (id, name) values (:id, :name)', $bind);
Db::execute();
```
