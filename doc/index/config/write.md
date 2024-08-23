## 写配置文件

ginkgo 还可以直接写入配置文件，如：

`0.1.1` 新增

``` php
$arr_config = array(
  'title' => 'Ginkgo',
  'name'  => 'ginkgo',
);

Config::write(GK_PATH_APP . 'config/config.inc.php', $arr_config);
```

系统会自动处理数据生成配置文件，上述例子生成的配置文件如下：

``` php
<?php return array(
  'title' => 'Ginkgo',
  'name'  => 'ginkgo',
);
```

又如：

``` php
$config = 'Ginkgo';

Config::write(GK_PATH_APP . 'config/config.inc.php', $config);
```

生成的配置文件如下:

``` php
<?php return 'Ginkgo';
```

> 系统会自动判断配置值的类型并加以转换
