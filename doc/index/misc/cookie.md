## Cookie

Cookie 功能由 `ginkgo\Cookie` 完成。

----------

#### 配置

无需手动初始化，系统会自动在调用之前进行 Cookie 初始化工作。

``` php
'cookie' => array(
  'prefix'    => '', // cookie 名称前缀
  'expire'    => 0, // cookie 保存时间
  'path'      => '/', // cookie 保存路径
  'domain'    => '', // cookie 有效域名
  'secure'    => false, //  cookie 启用安全传输
  'httponly'  => false, // httponly 设置
  'setcookie' => true, // 是否使用 setcookie
),
```

----------

#### 初始化

``` php
$config = array(
  'prefix'    => '', // cookie 名称前缀
  'expire'    => 0, // cookie 保存时间
  'path'      => '/', // cookie 保存路径
  'domain'    => '', // cookie 有效域名
  'secure'    => false, //  cookie 启用安全传输
  'httponly'  => false, // httponly 设置
  'setcookie' => true, // 是否使用 setcookie
);

// cookie初始化
Cookie::init($config);
// 指定当前前缀
Cookie::prefix('ginkgo_');
```

----------

#### 基本操作

* 设置

  ``` php
  Cookie::set('name', $value);

  $config = array(
    'prefix'    => '', // cookie 名称前缀
    'expire'    => 0, // cookie 保存时间
  );

  Cookie::set('name', $value, $config);
  ```

* 取值

  ``` php
  Cookie::get('name');
  // 获取指定前缀的cookie值
  Cookie::get('name', 'ginkgo_');
  ```

  如果 name 值不存在，则默认返回空。

* 删除

  ``` php
  Cookie::delete('name');
  // 删除指定前缀的 cookie
  Cookie::delete('name', 'ginkgo_');
  ```

* 前缀

  ``` php
  Cookie::prefix('prefix');
  Cookie::prefix(); // 取得前缀
  ```
