## baigoClear

这是一个清理表单 ajax 提交插件，与 baigoSubmit 不同的是本插件可以提供循环提交，对于需要分页处理的场景特别有效。

> 本插件基于 bootstrap 4.3.* 版本，主要用到 css 样式和 progress 组件，请使用者注意！

* [方法](method.md)
* [配置](option.md)
* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoClear/)

----------

<span id="dir"></span>

#### 目录结构

1. baigoClear.js 提交插件
2. baigoClear.min.js 提交插件压缩版

----------

<span id="use"></span>

#### 基本使用

载入文件

``` markup
<!-- jQuery 库 -->
<script src="jquery.min.js" type="text/javascript"></script>

<!-- bootstrap 库 -->
<script src="bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="bootstrap.min.css" type="text/css" rel="stylesheet">

<!-- 插件 -->
<script src="baigoClear.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

[下载 Bootstrap](http://getbootstrap.com)

表单 HTML

``` markup
<form name="form_cate" id="form_cate" class="form_clear" action="clear.php">
  <div>数据清理</div>
  <button type="submit">开始清理</button>
</form>
```

初始化并提交，如：

``` markup
<script type="text/javascript">
// 配置
var opts_clear = {
  msg: {
    loading: '正在清理',
    complete: '清理完毕'
  }
};

$(document).ready(function(){
  // 初始化
  var obj_clear  = $('#form_cate').baigoClear(opts_clear);

  // 提交
  $('#form_cate').submit(function(){
    obj_clear.clearSubmit();
  });
});
</script>
```

----------

<span id="result"></span>

#### 服务器返回

插件接受 json 对象的返回，如：

``` javascript
{
  count: 300, // 总页数
  min_id: 0, // 最小 ID
  max_id: 100, // 最大 ID
  status: 'complete', // 状态
  msg: '提交成功' // 消息
}
```

status 可能的值

* `err` 错误

  此时提交会中断，并显示消息

* `complete` 完成

  此时提交会中断，并显示消息

* `next` 下一页

  此时提交会继续

* `*` 其他

  此时提交会重新开始

----------

<span id="formData"></span>

#### 附加表单

插件会将 `服务器返回` 的 `min_id` 和 `max_id` 附加到表单中再次提交。

插件会额外附加一个 `page` 表单，类似分页参数，此表单在第一次或者重新开始时，值为 <kbd>1</kbd>，接下去每次提交都会递加 <kbd>1</kbd>。

| 表单 | 说明 | 备注 |
| - | - | - |
| min_id | 最小 ID | 由服务器原样返回 |
| max_id | 最大 ID | 由服务器原样返回 |
| page | 页数 | 从 <kbd>1</kbd> 开始，每次递加 <kbd>1</kbd> |
