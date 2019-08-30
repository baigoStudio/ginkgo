## FTP

FTP 功能由 `ginkgo\Ftp` 类完成，FTP 全称 File Transfer Protocol，即文件传输协议，是用于在网络上进行文件传输的一套标准协议。

----------

#### 定义服务器

可以通过配置文件定义

``` php
'var_extra' => array(
    'ftp' => array(
        'host'   => '', // 服务器
        'port'   => 21, // 端口
        'user'   => '', // 用户名
        'pass'   => '', // 密码
        'path'   => '', // 远程路径
        'pasv'   => 'off', // 被动模式
    ),    
    ...
),
```

也可以在实例化 FTP 类时定义

``` php
$config = array(
    'host'   => '', // 服务器
    'port'   => 21, // 端口
    'user'   => '', // 用户名
    'pass'   => '', // 密码
    'path'   => '', // 远程路径
    'pasv'   => 'off', // 被动模式
);

$ftp = Ftp::instance($config);
```

> 优先级：初始化定义 &gt; 配置文件定义

----------

#### 连接服务器

`init` 方法可快捷的连接并登录服务器

``` php
$ftp->init();
```

`connect` 方法可连接服务器

``` php
$ftp->connect();
```

`login` 方法可登录服务器

``` php
$ftp->login();
```

----------

#### 基本操作

> 默认所有操作均为相对目录，即系统会自动在路径前加上配置中所定义的远程路径。下列方法中的 $abs 参数可以定义。true 为绝对路径，false 为相对路径。

* 列出文件和目录

    ``` php
    $ftp = Ftp::instance();
    
    $lists = $ftp->dirList('./image', $abs);
    ```

* 创建文件夹

    ``` php
    $ftp->dirMk('./image', $abs);
    ```

* 删除目录

    ``` php
    $ftp->dirDelete('./dir', $abs);
    ```

* 上传文件

    ``` php
    $ftp->fileUpload($local, $remote, $abs, $mod);
    ```
    
    1. local 本地服务器路径
    2. remote 远程服务器路径
    3. abs 是否绝对路径
    4. mod 传输模式，只能为 FTP_ASCII（文本模式）或 FTP_BINARY（二进制模式）


* 删除文件

    ``` php
    $ftp->fileDelete('./src.txt', $abs);
    ```
