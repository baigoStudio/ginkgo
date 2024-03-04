## baigoSubmit

这是一个表单 ajax 提交插件

> 本插件基于 bootstrap 4.3.* 版本与 font-awesome 图标插件，主要用到 css 样式和 modal 组件，请使用者注意！

* [方法](method.md)
* [配置](option.md)
* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoSubmit/)

----------

<span id="dir"></span>

#### 目录结构

1. baigoSubmit.js 提交插件
2. baigoSubmit.min.js 提交插件压缩版

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
<script src="baigoSubmit.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

[下载 Bootstrap](http://getbootstrap.com)

表单 HTML

``` markup
<form name="login_form" id="login_form" action="login.php">
  <div>
    <label>用户名</label>
    <input type="text" name="admin_name" id="admin_name">
  </div>

  <div>
    <label>密码</label>
    <input type="password" name="admin_pass" id="admin_pass">
  </div>

  <button type="submit">登录</button>
</form>
```

初始化并提交，如：

``` markup
<script type="text/javascript">
// 配置
var opts_submit = {
  msg_text: {
    submitting: '正在登录'
  },
  modal: {
    btn_text: {
      close: '关闭',
      ok: 'OK'
    }
  },
  jump: {
    url: 'index.php',
    text: '正在跳转',
    delay: 1000
  }
};

$(document).ready(function(){
  // 初始化
  var obj_submit = $('#login_form').baigoSubmit(opts_submit);

  // 提交
  $('#login_form').submit(function(){
    obj_submit.formSubmit();
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
  msg: '提交成功',
  rcode: 'y010101',
  user_id: 2
}
```
