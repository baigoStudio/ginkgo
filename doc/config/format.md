## 配置格式

ginkgo 支持返回 PHP 数组进行配置。

``` php
//项目配置
return array(        
    'default_mod'   => 'index', // 默认模块名        
    'default_ctrl'  => 'index', // 默认控制器名
    'default_act'   => 'index', // 默认动作名
    // ... 更多配置参数
);
```

建议使用小写定义配置参数，开发者还可以在配置中使用二维数组来实现更复杂的配置，例如：

``` php
//项目配置
return array(        
    'default_mod'   => 'index',
    'cache'         => array( 
        'type'   => 'file',
        'path'   => GK_PATH_CACHE,
        'prefix' => '',
        'expire' => 0,
    ),
);
```

详细配置含义请查看 `附录 -> 配置参考` 章节。

----------

##### 作用域

配置支持作用域，利用作用域，可以定义二级甚至三级配置，例如：

``` php
$config = array( 
    'user'  =>  array(
        'type'  =>  1,
        'name'  =>  'ginkgo',
    ),
    'db'    =>  array(
        'type'      =>  'mysql',
        'user'      =>  'root',
        'password'  =>  '',
    ),
];

Config::set($config); // 设置配置参数

echo Config::get('type', 'user');// 读取并输出二级配置参数
```