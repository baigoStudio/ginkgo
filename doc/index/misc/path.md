## 路径处理

路径处理功能由 `ginkgo\Path` 类完成，全部为静态方法，如：

``` php
use ginkgo\Path;

$str = '/web/wwwroot/test/abc/';

Func::fixDs($str);
```

----------

#### `fixDs()` 规范化路径分隔符，并在最后添加分隔符

``` php
function fixDs( $path [, $ds = DS ] )
```

参数

* `path` 路径
* `ds` 路径分隔符

返回

* 格式化后的路径，如：/web/wwwroot//test/abc 转换为 /web/wwwroot/test/abc/

----------

#### `fillUrl()` 将 URL 补充完整

``` php
function fillUrl( $url, $baseUrl )
```

参数

* `url` URL
* `baseUrl` 基本 URL

返回

* 完整的 URL，如：
    URL 为 ./image/logo.png，
    基本 URL 为 http://www.baigo.net，
    补充完整后为 http://www.baigo.net/image/logo.png

----------
