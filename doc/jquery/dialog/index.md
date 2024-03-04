## baigoDialog

这是一个对话框插件，用于替代原生 JavaScript 的 alert 和 confirm 函数。

> 本插件基于 bootstrap 4.3.* 版本，主要用到 css 样式和 modal 组件，请使用者注意！

* [方法](method.md)
* [配置](option.md)
* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoDialog/)

----------

<span id="dir"></span>

#### 目录结构

1. baigoDialog.js 提交插件
2. baigoDialog.min.js 提交插件压缩版

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
<script src="baigoDialog.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

[下载 Bootstrap](http://getbootstrap.com)

表单 HTML

``` markup
<form name="delete_form" id="delete_form" action="delete.php">
  <button type="submit" id="btn_submit">删除</button>
  <button type="button" id="btn_alert">提醒</button>
</form>
```

初始化并提交，如：

``` markup
<script type="text/javascript">
// 配置
var opts_dialog = {
  btn_text: {
    cancel: '取消',
    confirm: '确定'
  }
};

$(document).ready(function(){
  // 初始化
  var obj_dialog = $.baigoDialog(opts_dialog);

  $('#delete_form').submit(function(){
    obj_dialog.confirm('确定要删除吗？', function(confirm_result){
      return confirm_result;
    });
  });

  $('#btn_alert').click(function(){
    obj_dialog.alert('这是一个提醒！');
  });
});
</script>
```
