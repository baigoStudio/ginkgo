## 响应参数

`Response` 对象提供了一系列方法用于设置响应参数，包括设置输出内容、状态码及 header 信息等。

----------

#### 设置数据

`Response` 提供了 `setContent` 方法用于设置响应数据。

``` php
$data = array(
    'Hello', 'world!',
);

$response = Response::instance();
$response->setContent($data);
```

注意 `setContent` 方法设置的只是原始数据，并不一定是最终的输出数据，最终的响应输出数据是会根据当前的 `Response` 响应类型做自动转换的，例如：

``` php
$data = array(
    'Hello', 'world!',
);

$response = Response::instance();
$response->setContent($data);
$response->setType('json');
```

最终的输出数据就是 `json_encode($data)` 转换后的数据。

如果要获取当前响应对象实例的实际输出数据可以使用 `getContent` 方法。

----------

#### 设置状态码

`Response` 提供了 `setStatusCode` 方法用于设置响应状态码，例如：

``` php
$data = array(
    'Hello', 'world!',
);

$response = Response::instance();
$response->setContent($data);
$response->setStatusCode(201);
```

除了 redirect 响应默认状态码是 302 之外，其它类型的响应默认状态码均为 200。

如果要获取当前响应对象实例的状态码的值，可以使用 `getStatusCode` 方法。

----------

#### 设置头信息

可以使用 `Response` 的 `setHeader` 方法设置响应的头信息

``` php
$data = array(
    'Hello', 'world!',
);

$response = Response::instance();
$response->setContent($data);
$response->setHeader('Cache-control', 'no-cache,must-revalidate');
```

`setHeader` 方法支持两种方式设置，如果传入数组，则表示批量设置，如果传入两个参数，第一个参数表示头信息名，第二个参数表示头信息的值，例如：

``` php
// 单个设置
$response->setHeader('Cache-control', 'no-cache,must-revalidate');
// 批量设置

$header = array(
    'Cache-control' => 'no-cache,must-revalidate',
    'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT',
);
$response->setHeader($header);
```
除了 `setHeader` 方法之外，`Response` 还提供了常用头信息的快捷设置方法：

| 方法名 | 作用 |
| - | - |
| expires | 设置 Expires 头信息 |
| cacheControl | 设置 Cache-control 头信息 |
| contentType | 设置 Content-Type 头信息 |

除非你要清楚自己在做什么，否则不要随便更改这些头信息，每种响应类型都有默认的 `contentType` 信息，一般无需设置。

你可以使用 `getHeader` 方法获取当前响应对象实例的头信息。
