## 请求参数

模板支持直接输出 `Request`，用法如下：

> $request->方法('参数')

例如：

``` php
<?php echo $request->get('id'); ?>
<?php echo $request->param('name'); ?>
```

支持 `Request` 类的所有方法，详情请查看 [请求](../request/index.md)。

下面都是有效的输出：

``` php
// 调用 request 对象的 get 方法 传入参数为 id
echo $request->get('id');
// 调用 request 对象的 param 方法 传入参数为 name
echo $request->param('name');
// 调用 request 对象的 root 方法
echo $request->root();
// 调用 request 对象的 root 方法，并且传入参数 true
echo $request->root('true');
// 调用 request 对象的 path 方法
echo $request->path();
// 调用 request 对象的 route 方法
echo $request->route();
// 调用 request 对象的 host 方法
echo $request->host();
// 调用 request 对象的 ip 方法
echo $request->ip();
// 调用 request 对象的 header 方法
echo $request->header('accept-encoding');
```
