## 函数

可以方便的在 ginkgo 中添加自定义函数。

如果需要给应用添加函数，只需要在应用的公共文件 `./app/common.php`中定义即可，系统会自动加载。

如果你需要增加新的函数文件，例如需要增加 `./app/function.php`，就需要配置 func_extra 如：

先创建 app/function.php 文件，大致如下：


``` php
// 增加一个新的 table 函数
function table($table, $config = array()) {
    return $table;
}

// 增加一个新的 db 函数
function db($name, $config = array()) {
    return $name; 
}
```

然后，在配置文件中设置：

``` php
'func_extra' => array(
    GK_PATH_APP . 'function.php',
),
```

如果还需要加载更多的函数文件，如 `./app/func/sys.php`，可以配置如下：

``` php
'func_extra' => array(
    GK_PATH_APP . 'function.php',
    GK_PATH_APP . 'func/sys.php',
),
```
