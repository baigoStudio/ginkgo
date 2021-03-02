## 配置作用域

配置参数支持作用域，默认情况下，所有参数都在默认作用域下面。如果配置需要用于不同的项目或者相互隔离，那么就可以使用作用域，作用域的作用好比是配置参数的命名空间一样。ginkgo 支持二级作用域，两级作用域之间用 <kbd>.</kbd> 隔开。

``` php
// 导入 my_config.inc.php 中的配置参数，并纳入 user 作用域
Config::load('my_config.inc.php', '', 'user');

// 设置 user_type 参数，并纳入 user 作用域
Config::set('user_type', 'super', 'user');

// 批量设置配置参数，并纳入 test 作用域
Config::set($config, '', 'test');

// 批量设置配置参数，并纳入 test 下面的 abc 作用域
Config::set($config, '', 'test.abc');

// 读取 user 作用域的 user_type 配置参数
echo Config::get('user_type', 'user');

// 读取 user 作用域下面的所有配置参数
print_r(Config::get('', 'user'));
```

可以使用 `range()` 方法切换当前配置的作用域，例如：

``` php
Config::range('test');
```
