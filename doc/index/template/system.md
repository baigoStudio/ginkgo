## 系统变量

普通的模板变量需赋值后才能输出，系统变量则不需要，系统变量的输出使用 `Request` 对象，模板中已内置，可以直接使用 `$request`，例如：

``` php
<?php echo $request->server('script_name'); ?> // 输出 $_SERVER['SCRIPT_NAME'] 变量
<?php echo $request->session('user_id'); ?> // 输出 $_SESSION['user_id'] 变量
<?php echo $request->get('page'); ?> // 输出 $_GET['page'] 变量
<?php echo $request->cookie('name'); ?>  // 输出 $_COOKIE['name'] 变量
```

支持输出 `$_SERVER`、`$_POST`、`$_GET`、`$_REQUEST`、`$_SESSION` 和 `$_COOKIE` 变量，详情请查看 [请求 -> 输入变量](../request/input.md)

----------

#### 常量输出

还可以输出常量

``` php
<?php echo PHP_VERSION; ?>
<?php echo GK_PATH_APP; ?>
```

----------

#### 配置输出

输出配置参数使用：

``` php
<?php echo $config['route']['default_mod']; ?>
<?php echo $config['route']['default_ctrl']; ?>
```

----------

#### 语言变量

语言变量的输出使用 `Lang` 对象，模板中已内置，可以直接使用 `$lang`，例如：

``` php
<?php echo $lang->get('page_error'); ?>
<?php echo $lang->get('var_error'; ?>
```
