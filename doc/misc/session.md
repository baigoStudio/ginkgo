## Session 会话

Session 功能由 `ginkgo\Session` 类配合 Session 驱动类一起完成，内置 file、db 驱动。

----------

#### Session 初始化

Session 会在第一次调用 `Session` 类的时候按照配置参数自动初始化：

``` php
'session' => array(
  'autostart'     => true, //自动开始
  'name'          => '', //Session ID 名称
  'type'          => 'file', //类型 (可选 db,file)
  'path'          => '', //保存路径 (默认为 /runtime/session)
  'prefix'        => 'ginkgo_', //前缀
  'cookie_domain' => '',
  'life_time'     => 1200, // session 生存时间
),
```

如果使用上述配置参数，无需任何操作就可以直接调用 `Session` 类的相关方法，例如：

``` php
Session::set('name', 'baigo');
Session::get('name');
```

或者调用 `init()` 方法进行初始化：

``` php
$config = array(
  'autostart'     => true, //自动开始
  'name'          => '', //Session ID 名称
  'type'          => 'file', //类型 (可选 db,file)
  'path'          => '', //保存路径 (默认为 /runtime/session)
  'prefix'        => 'ginkgo_', //前缀
  'cookie_domain' => '',
  'life_time'     => 1200, // session 生存时间
),

Session::init($config);
```

还可以调用 `config()` 方法改变配置：

``` php
Session::config($config);
```

----------

#### 设置参数

默认支持的 Session 设置参数包括：

| 参数 | 描述 | 默认 |
| - | - | - |
| autostart | 是否自动开启 | false |
| name | Session ID 名称 | |
| type | 类型 (目前可选 db, file) | file |
| path | 保存路径 (仅对 file 类型有效) | /runtime/session |
| prefix | Session 前缀 | ginkgo_ |
| cookie_domain | cookie_domain |
| life_time | 生命周期（单位为 秒） | 1200 |

`type` 参数支持完整命名空间定义，默认采用 `ginkgo\session\driver` 作为命名空间，如果使用自己扩展的驱动，可以配置为：

``` php
'session' => array(
  'type'   => 'org\session\File',
  ...
);
```

表示采用 `org\session\File` 类作为驱动，而不是默认的 `ginkgo\session\driver\file`。

> 如果做了 Session 驱动扩展，可能有些参数不一定有效。

----------

#### 基本操作

* 赋值

  ``` php
  Session::set('name', $value);
  Session::set('name', $value, 'prefix'); // 前缀为 prefix
  ```

* 取值

  ``` php
  Session::get('name');
  Session::get('name', 'prefix'); // 取得前缀为 prefix 的值
  ```

  如果 name 值不存在，则默认返回空。

* 删除

  ``` php
  Session::delete('name');
  ```

* 前缀

  ``` php
  Session::prefix('prefix');
  Session::prefix(); // 取得前缀
  ```

----------

#### 二级数组

支持 Session 的二维数组操作，例如：

``` php
// 赋值（当前作用域）
Session::set('name','baigo.item');
// 取值（当前作用域）
Session::get('name', 'item');
// 删除（当前作用域）
Session::delete('name', 'item');
```
