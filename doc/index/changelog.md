##### v0.2.1

* 修复 `ginkgo\Db\Connector\Mysql` 类中，`fetchSql()` 方法无法完整获取真实 SQL 语句的错误
* 修复 `ginkgo\File` 类中，没有完全将文件路径转换成小写的问题
* 修复 `ginkgo\Cookie` 类中，无法删除指定路径下的 Cookie 的问题
* `ginkgo\Strings` 类改名为 `ginkgo\Strings`
* 修复缓存有效期的逻辑错误
* 做了兼容 PHP 7 的调整

----------

### v0.2.0

* 为 `ginkgo\Ubbcode` 类增加 `getImages()` 方法
* 改善路径处理
* 修复无法捕获部分错误的问题
* 改善 Debug 输出信息
* 新增 `ginkgo\Arrays` 类，用于处理数组，将原 `ginkgo\Func` 类中与数组相关的方法迁移
* 新增 `ginkgo\Strings` 类，用于处理字符串，将原 `ginkgo\Func` 类中与字符串相关的方法迁移
* 为 `ginkgo\Ubbcode` 类增加是否启用 `nl2br` 的选项，并改善了部分正则规则
* 彻底重写 `ginkgo\Ftp` 类，由 FTP 函数更改为 cURL
* 修复 `ginkgo\Image` 类中，按比例生成缩略图时的错误
* 修复 `ginkgo\Validate` 类中的部分错误
* 修复数据库 `find()` 方法中，未指定 limit 参数的错误
* 修复 jsonp 响应类中，默认参数指定的错误
* 为相关类增加了 `$config` 属性和 `config()` 方法，应用更加灵活
* 全面验证和重写了类成员的权限和类型

----------

##### v0.1.3

* 修复 `ginkgo\view\driver\Php` 类中，无法指定模板绝对路径的错误
* 修复 `ginkgo\Auth` 登录认证类中哈希生成和验证的问题
* 新增 `ginkgo\Paginator` 类，并对数据库、模型的分页查询做了简化，可直接分页查询数据
* 新增自动加载控制器配置功能
* 为 `ginkgo\Smtp` 类，新增利用 `mail()` 函数发送邮件的功能
* 改善了模板自动定位的处理过程
* 取消部分配置项，简化逻辑
* 改善了异常模板自动定位的处理过程
* bootstrap 升级至 4.5.2

----------

##### v0.1.2

* 改善了数据库调试与 SQL 语句日志记录功能
* 改善了错误调试功能
* 修复模板中无法使用 `$request` 实例的问题
* 为 `ginkgo\Ubbcode` 类增加一些支持
* 修复 `ginkgo\db\connect\Mysql` 类中的，与 `where()` 方法相关的参数顺序错误
* 改善 `ginkgo\Config` 类中的 `load()` 方法，自行判断文件是否存在，如不存在不再抛出错误
* 改善 `ginkgo\App` 类中加载配置文件的流程，自动加载与控制器同名的配置文件
* 为 `ginkgo\Func` 类增加 `getRegex()` 方法，对应 `checkRegex()`，用于取得正则匹配结果
* 为 `ginkgo\Func` 类的 `arrayFilter()` 方法增加第二个参数，可以选择是否去除等值为 FALSE 的条目
* 修复了 `ginkgo\response\Redirect` 类中，`remember()` 方法无法定义路径的问题
* 修复了 `ginkgo\Route` 类中，`build()` 方法会忽略参数的问题
* 修复了 `ginkgo\Validate` 类无法指定验证码 ID 的问题
* 增加了 `ginkgo\Auth` 登录认证类，统一管理登录认证信息
* 优化了一些类的语法和注释
* 改善输入过滤规则
* 改善了部分类中，因不区分大小写的替换规则而导致的偶发问题
* `./const.php` 文件中增加用于容量计算的一些常量

----------

##### v0.1.1

* 将控制器动作名称由 `下划线` 分隔单词更改为 `下划线` 或 `连字符` 分割单词，例如：`hello_world` 与 `hello-world` 都是有效的
* 增加模块名、控制器名称中的 `连字符` 自动替换为 `下划线` 的功能
* 改善 PDO 预处理语句中，系统自动生成的语句容易发生绑定名称冲突的问题
* 插件的 `config.inc.php` 更改为 `config.json`，`opts.json` 更改为 `opts_var.json`，`opts.inc.php` 更改为 `opts.json`
* 修复当调试模式关闭时错误日志无法记录错误详情的问题
* 改善部分类的静态属性和静态方法
* 支持自定义 http 错误页面，如：404、500 错误等
* 改善 URL 路由解析，并将解析后获得的 URL 参数注入到 `$_GET` 变量
* 修复根据路由获取参数时，值为 0 时无法获取参数的问题
* ubbcode 增加引用块（blockquote）支持
* 常用函数 `ginkgo\Func` 类增加 `strSecret()` 方法，用于敏感字符的隐藏，如手机号码：`139 **** 8888`
* 多语言支持 `ginkgo\Lang` 类的 `getCurrent()` 方法增加三个参数，用于不同语言编码的显示
* 修复验证类 `ginkgo\Validate` 中验证类型 number 中，变量为数值型出错的问题
* 为验证类 `ginkgo\Validate` 增加语言实例 `$obj_lang`
* 验证类 `ginkgo\Validate` 可验证数组
* 修复视图类 `ginkgo\View` 输出替换无法正常实现的问题
* 修复 html 类 `ginkgo\Html` 中错误过滤括弧的问题
* 解决 json 类 `ginkgo\Json` 中解码失败返回值不是数组的问题
* 修复路由类 `ginkgo\Route` 中原始路由 routeOrig 中的命名错误
* 修复路由类 `ginkgo\Route` 中绑定模块时出现的参数乱序错误
* 为配置类 `ginkgo\Config` 增加 `write()` 方法
* `./const.php` 文件中增加用于时间计算的一些常量

----------

# v0.1.0

* 初次发布
