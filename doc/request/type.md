## 请求类型

在很多情况下，需要判断当前请求类型是 GET、POST 或者 AJAX，一方面可以针对请求类型作出不同的处理，另外一方面需要验证安全性，过滤不安全的请求。ginkgo 统一采用 `ginkgo\Request` 类处理请求类型。

用法如下：

``` php
$request = Request::instance();

// 是否为 GET 请求
if ($request->isGet()) echo "当前为 GET 请求";
// 是否为 POST 请求
if ($request->isPost()) echo "当前为 POST 请求";
// 是否为 AJAX 请求
if ($request->isAjax()) echo "当前为 AJAX 请求";
// 是否为 PJAX 请求
if ($request->isPjax()) echo "当前为 PJAX 请求";
// 是否为手机访问
if ($request->isMobile()) echo "当前为手机访问";
// 是否为 SSL
if ($request->isSsl()) echo "当前为 SSL";
```