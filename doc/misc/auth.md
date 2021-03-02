## 认证

`0.1.2` 新增

认证是鉴定用户身份的过程。它通常使用一个标识符（如用户名）和一个加密令牌（比如密码或者存取令牌）来鉴别用户身份。认证是登录功能的基础。认证功能由 `ginkgo\Auth` 类完成。

----------

#### 用户登录的典型过程

注意：以下例子仅作为说明，所有数据未经验证过滤，不宜作为登录程序直接使用。

``` php
$auth = Auth::instance();
$user = Loader::modal('User');

// 从表单取得数据
$inputSubmit = array(
    'user_name' => $_POST['user_name'],
    'user_pass' => $_POST['user_pass'],
);

// 从数据库读取用户信息
$userRow = $user->read($inputSubmit['user_name'], 'user_name');
if (!$userRow) {
    return '用户不存在';
}

// 验证密码
$cryptString = Crypt::crypt($inputSubmit['user_pass'], $userRow['user_rand']);
if ($cryptString != $userRow['user_pass']) {
    return '密码错误';
}

// 写入认证信息
$auth->write($userRow);
```

----------

#### 读取当前登录用户的典型过程

注意：以下例子仅作为说明，所有数据未经验证过滤，不宜作为登录程序直接使用。

``` php
$auth = Auth::instance();
$user = Loader::modal('User');

// 读取认证信息
$authRow = $auth->read();

$session  = $authRow['session'];
$remember = $authRow['remember'];

// 从数据库读取用户信息
$userRow = $user->read($session['user_id']); // 用会话数据读取
if (!$userRow) { // 如不存在则用记住信息读取 (相当于自动登录)
    $userRow = $user->read($remember['user_id']);
    if (!$userRow) { // 如不存在则直接报错
        return '用户不存在';
    }
}

// 检测认证
if (!$auth->check($userRow) {
    return $auth->getError();
}

... // 继续其他操作
```

----------

#### 实例化认证类

认证在使用之前，需要进行实例化操作。

``` php
$config = array(
    'session_expire'    => 20 * GK_MINUTE, // 认证过期时间
    'remember_expire'   => 30 * GK_DAY, // 记住密码过期时间
);
$auth = Auth::instance($config);
```

或者通过定义配置参数的方式，在配置文件中添加：

``` php
'auth' => array(
    'session_expire'    => 20 * GK_MINUTE, // 认证过期时间
    'remember_expire'   => 30 * GK_DAY, // 记住密码过期时间
),
```

认证参数如下：

| 参数 | 描述 | 默认 |
| - | - | - |
| session_expire | 认证有效期（单位为 秒） | 12000 |
| remember_expire | 记住密码有效期（单位为 秒） | 2592000 |

----------

#### 设置、取得前缀

很多系统可能会存在两个甚至数个登录通道，比如一个论坛系统存在普通用户登录与后台管理用户登录，普通用户登录后可以进行发帖、回复、评论等操作，管理员登录后，可以对整个论坛系统进行设置等操作，此时如果是同样的 ID，就存在冲突的可能性，为不同的登录通道设置不同的前缀可以有效避免冲突。

在实例化时设置前缀，如：

``` php
$auth = Auth::instance(array(), 'user');
```


通过 `$prefix` 属性设置，如：

``` php
$auth = Auth::instance();

$auth->prefix = 'user';
```


通过 `prefix()` 方法设置，如：

``` php
$auth = Auth::instance();

$auth->prefix('user');
```

用 `$prefix` 属性和 `prefix()` 方法还可以取得当前前缀，如：

``` php
$auth = Auth::instance();

echo $auth->prefix();
echo $auth->prefix;
```

----------

#### 设置、取得选项

`0.2.0` 新增

选项可以控制认证实例的一些功能开启与关闭，目前支持的功能如下：

| 参数 | 描述 | 默认 |
| - | - | - |
| cookie | 是否开启 cookie，如果开启，系统将同时通过 cookie 来验证 | true |
| remember | 是否开启记住用户，如果开启，系统可以实现自动登录 | false |


通过 `$options` 属性来设置选项，如：

``` php
$auth = Auth::instance();

$auth->options = array(
    'cookie'    => true,
    'remember'  => false,
);
```


通过 `setOptions()` 方法设置，如：

``` php
$auth = Auth::instance();

$auth->setOptions('cookie', true); // 单个设置

$options = array(
    'cookie'    => true,
    'remember'  => false,
);

$auth->setOptions($options); // 批量设置
```


用 `$options` 属性和 `getOptions()` 方法还可以取得当前前缀，如：

``` php
$auth = Auth::instance();

echo $auth->options;
echo $auth->getOptions();
```

----------

#### 写入认证信息

``` php
$userRow = array(
    'user_id'           => 2,
    'user_name'         => 'test',
    'user_time_login'   => 568445,
    'user_ip'           => '127.0.0.1',
);

$auth->prefix = 'user'; // 注意与 userRow 数组的名称对应

$auth->write($userRow, true, 'auto', 'remember');
```

`write()` 方法说明

``` php
function write( $userRow [, $regen = false [, $loginType = 'form' [, $remember = '' [, $pathCookie = '/' ]]]] )
```

参数

* `userRow` 用户信息：

    必须为数组，结构如下：

    | 名称 | 类型 | 必需 | 描述 |
    | - | - | - | - |
    | 前缀_id | int | true | ID |
    | 前缀_name | string | true | 用户名 |
    | 前缀_time_login | int | true | 最后登录时间（UNIX 时间戳） |
    | 前缀_ip | string | true | IP 地址 |


* `regen` 使用新生成的会话 ID 更新现有会话 ID

    布尔值，默认为 false

* `loginType` 登录类型

    字符串，默认为 form，表示从表单登录，开发者可以根据实际情况自行命名，如：auto 等等

* `remember` 记住登录状态

    字符串，默认为空，要记住登录状态，必须将本参数设置为 `remember`，`0.2.0` 起可以为 `true`

* `pathCookie` Cookie 保存路径

    字符串或数组，默认 /

返回

* 无

----------

#### 读取认证

``` php
$authinfo = $auth->read();
```

参数

* 无

返回

* 数组，结构如下：

    ``` php
    array(
        'session' => array( // 会话
            '前缀_id'           => 2, // 用户 ID
            '前缀_name'         => 'username', // 用户名
            '前缀_hash'         => 'dfekeiEjiweerw', // 哈希值
            '前缀_time'         => 54684857, // 保存时间
            '前缀_time_expire'  => 46744874, // 过期时间
        ),
        'cookie' => array( // Cookie
            '前缀_id'           => 2,
            '前缀_name'         => 'username', // 用户名
            '前缀_hash'         => 'dfekeiEjiweerw',
            '前缀_time'         => 54684857,
            '前缀_time_expire'  => 46744874,
        ),
        'remember' => array( // 记住的登录状态
            '前缀_id'           => 2,
            '前缀_name'         => 'username', // 用户名
            '前缀_hash'         => 'dfekeiEjiweerw',
            '前缀_time'         => 54684857,
            '前缀_time_expire'  => 46744874,
        ),
    );
    ```

----------

#### 检测认证

``` php
$auth->check($userRow, $pathCookie);
```

`check()` 方法说明

``` php
function check( $userRow [, $pathCookie = '/' ] )
```

参数

* `userRow` 用户信息：

    必须为数组，结构如下：

    | 名称 | 类型 | 必需 | 描述 |
    | - | - | - | - |
    | 前缀_id | int | true | ID |
    | 前缀_name | string | true | 用户名 |
    | 前缀_time_login | int | true | 最后登录时间（UNIX 时间戳） |
    | 前缀_ip | string | true | IP 地址 |

* `pathCookie` Cookie 保存路径

    字符串，默认 /

返回

* 布尔值

----------

#### 结束认证

用户结束登录

``` php
$auth->end();
```
----------


#### 获取错误信息

``` php
$auth->getError();
```
