## 目录结构

```
project 应用部署目录
+-- app                     应用目录（可设置）
|   +-- classes             类库目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- config              配置目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- ctrl                控制器目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- lang                语言目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- model               数据模型目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- tpl                 模板目录
|   |   +-- module1         模块1（示例）
|   |   |   +-- default     default 模板（示例）
|   |   |   +-- test        test 模板（示例）
|   |   |
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- validate            验证器目录
|   |   +-- module1         模块1（示例）
|   |   +-- module2         模块2（示例）
|   |   +--  ...            更多模块
|   |
|   +-- common.php          公共文件
|
+-- ginkgo                  框架系统目录
|   +-- lang                语言包目录
|   +-- core                框架内核目录
|   +-- tpl                 系统模板目录
|   +-- base.php            框架基本引导文件
|   +-- boot.php            框架引导文件
|   +-- const.php           常量定义文件
|   +-- convention.php      默认配置文件
|   +-- LICENSE.txt         授权说明文件
|   +-- SPECIFICATION.md    开发规范
|   +-- README.md           README 文件
|
+-- extend                  扩展目录（可定义）
|   +-- plugin              插件目录
|   +--  ...                更多类库
|
+-- public                  web 部署目录（公开访问目录）
|   +-- static              静态资源存放目录（css、js、image）
|   +-- index.php           入口文件
|   +-- .htaccess           用于 apache 的重写
|
+-- runtime                 运行时目录（可写、可设置）
+-- vendor                  第三方类库目录（Composer）
+-- composer.json           composer 定义文件
```

建议 public 目录作为公开访问目录，其它都是公开目录之外，当然必须修改 `public/index.php` 中的相关路径。如果没法做到这点，请记得设置目录的访问权限或者添加目录保护的文件。

框架自带了一个完整的应用目录结构和默认的入口文件，开发人员可以在这个基础之上灵活运用。

> 如果是 mac 或者 linux 环境，请确保 runtime 目录有可写权限
