## HTTP 请求

HTTP 请求功能由 `ginkgo\Http` 类完成。

----------

#### 基本操作

* 请求 HTTP 地址

    ``` php
    $data = array(
        'test' => 'abc',
    );
    
    $http = Http::instance();

    $http->request('http://www.baigo.net', $data, 'post'); // POST 方法发送数据 $date
    ```

* 设置头信息

    ``` php
    $http->setHeader('Referer', 'http://www.baigo.net');
    $http->setHeader('User-Agent', 'Mozilla/5.0');
    ```

* 设置访问端口

    ``` php
    $http->setPort('80');
    ```

* 设置请求类型

    ``` php
    $http->setAccept('application/json');
    ```

* 设置内容类型

    ``` php
    $http->contentType('application/x-www-form-urlencoded', 'UTF-8'); // 支持设置编码
    ```

* 获取错误信息

    ``` php
    $http->getError();
    ```

* 获取错误号

    ``` php
    $http->getErrno();
    ```

* 获取 HTTP 状态码

    ``` php
    $http->getStatusCode();
    ```

* 获取返回信息

    ``` php
    $http->getResult();
    ```

* 抓取远程地址

    ``` php
    $http->getRemote('http://www.baigo.net/test.txt', '', 'get'); // GET 方法抓取
    ```

* 将抓取到的远程文件保存至指定位置

    ``` php
    $http->move('/web/date', 'text.txt', true); // 第三个参数为是否覆盖
    ```
