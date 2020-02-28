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
* 常用函数 `ginkgo\Func` 类增加 `strSecret` 函数，用于敏感字符的隐藏，如手机号码：`139 **** 8888`
* 多语言支持 `ginkgo\Lang` 类的 `getCurrent` 方法增加三个参数，用于不同语言编码的显示
* 修复验证类 `ginkgo\Validate` 中验证类型 number 中，变量为数值型出错的问题
* 为验证类 `ginkgo\Validate` 增加语言实例 `$obj_lang`
* 验证类 `ginkgo\Validate` 可验证数组
* 修复视图类 `ginkgo\View` 输出替换无法正常实现的问题
* 修复 html 类 `ginkgo\Html` 中错误过滤括弧的问题
* 解决 json 类 `ginkgo\Json` 中解码失败返回值不是数组的问题
* 修复路由类 `ginkgo\Route` 中原始路由 routeOrig 中的命名错误
* 修复路由类 `ginkgo\Route` 中绑定模块时出现的参数乱序错误
* 为配置类 `ginkgo\Config` 增加 write 方法
* `./const.php` 文件中增加用于时间计算的一些常量

----------

# v0.1.0

* 初次发布