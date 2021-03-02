## SMTP

SMTP 功能由 `ginkgo\Smtp` 类完成，SMTP 全称 Simple Mail Transfer Protocol，即简单邮件传输协议，是在 Internet 传输 email 的事实标准。

----------

#### 配置

可以通过配置文件定义

``` php
'var_extra' => array(
    'smtp' => array(
        'method'        => 'smtp', // 发送方法 0.1.3 新增
        'host'          => '', // 服务器
        'secure'        => 'off', // 加密传输
        'port'          => 25, // 端口
        'auth'          => 'true', // 是否需要验证
        'user'          => '', // 用户名
        'pass'          => '', // 密码
        'from_addr'     => 'root@localhost', // 来源地址
        'from_name'     => 'root', // 来源名字
        'reply_addr'    => 'root@localhost', // 回复地址
        'reply_name'    => 'root', // 回复名字
        'debug'         => '0', // 调试模式
    ),
    ...
),
```

也可以在实例化 SMTP 类时定义

``` php
$config = array(
    'method'        => 'smtp', // 发送方法 0.1.3 新增
    'host'          => '', // 服务器
    'secure'        => 'off', // 加密类型
    'port'          => 25, // 端口
    'auth'          => 'true', // 是否需要验证
    'user'          => '', // 用户名
    'pass'          => '', // 密码
    'from_addr'     => 'root@localhost', // 来源地址
    'from_name'     => 'root', // 来源名字
    'reply_addr'    => 'root@localhost', // 回复地址
    'reply_name'    => 'root', // 回复名字
    'debug'         => '0', // 调试模式
);

$smtp = Smtp::instance($config);
```

> 优先级：初始化定义 &gt; 配置文件定义

----------

#### 连接服务器

`connect()` 方法可连接服务器

> `send()` 方法在执行时，也会自动调用此方法 `0.1.3` 新增

``` php
$smtp->connect();
```

完整的发送邮件例子

``` php
$smtp = Smtp::instance($config);

$smtp->connect();
$smtp->addRcpt('baigo@baigo.net'); // 支持多个收件人
$smtp->addRcpt('fone@baigo.net', 'fone'); // 支持定义收件人名
$smtp->setSubject('这是一封邮件');
$smtp->setContent('<div>这是邮件内容</div>'); // 支持 HTML
$smtp->send();
```

----------

#### 基本操作

* 添加收件人

    ``` php
    $smtp = Smtp::instance();

    $smtp->addRcpt('baigo@baigo.net'); // 支持多个收件人
    $smtp->addRcpt('fone@baigo.net', 'fone'); // 支持定义收件人名
    ```

* 添加回复人

    ``` php
    $smtp->addReply('baigo@baigo.net'); // 支持多个回复人
    $smtp->addReply('fone@baigo.net', 'fone'); // 支持定义回复人名
    ```

* 设置发件人

    ``` php
    $smtp->setFrom('fone@baigo.net', 'fone'); // 支持定义发件人名
    ```

* 设置邮件主题

    ``` php
    $smtp->setSubject('这是一封邮件');
    ```

* 设置邮件内容

    ``` php
    $smtp->setContent('<div>这是邮件内容</div>'); // 支持 HTML
    ```

* 设置纯文本邮件内容

    ``` php
    $smtp->setContentAlt('这是邮件内容');
    ```

* 发送邮件

    ``` php
    $smtp->send();
    ```

* 获取错误信息

    ``` php
    $smtp->getError();
    ```
