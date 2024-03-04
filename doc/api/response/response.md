## ginkgo\response

本目录保存数据库驱动及其相关的类。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                         框架系统目录
|   +-- response                   响应目录
|   |   +-- json.class.php         JSON 响应
|   |   +-- jsonp.class.php        JSONP 响应
|   |   +-- redirect.class.php     重定向响应
|   |   +--  ...
|   |
|   +--  ...
|
+--  ...
```

#### 扩展响应类型

可以在 `ginkgo/response` 目录下创建新的响应类，并继承 `ginkgo\Response` 类，建议重定义 output 方法来实现新的响应类型，具体可参考该目录下已存在的类。
