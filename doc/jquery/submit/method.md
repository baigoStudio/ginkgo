## 方法

baigoSubmit 实例化以后可以调用方法，如：

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

  obj_submit.ajaxUrl('test.php'); // 变更 action 地址

  $('#login_form').submit(function(){
    obj_submit.formSubmit('new_login.php'); // 提交
  });
});
</script>
```

----------

<span id="ajaxUrl"></span>

#### `ajaxUrl()` 方法说明

用于变更 action 地址

``` javascript
obj_submit.ajaxUrl(url);
```

参数

* `url` 提交地址，必需

----------

<span id="formSubmit"></span>

#### `formSubmit()` 方法说明

用于提交表单

``` javascript
obj_submit.formSubmit(url, callback);
```

参数

* `url` 提交地址，可选，为空时为表单 `action` 属性值
* `callback` 回调函数，可选，必须是函数，`2.1.1` 新增

  函数的参数值为服务端返回值

如：

``` javascript
$(document).ready(function(){
  // 初始化
  var obj_submit = $('#login_form').baigoSubmit(opts_submit);

  $('#login_form').submit(function(){
    obj_submit.formSubmit('new_login.php', function(result){ // 提交
      console.log(result);
    });
  });
});
```

----------

<span id="jump"></span>

#### `jump()` 方法说明

`2.1.3` 新增

用于页面跳转

``` javascript
obj_submit.jump(url);
```

参数

* `url` 跳转地址

如：

``` javascript
$(document).ready(function(){
  // 初始化
  var obj_submit = $('#login_form').baigoSubmit(opts_submit);

  $('#login_form').submit(function(){
    obj_submit.formSubmit(false, function(result){ // 提交
      obj_submit.jump('new_login.php');
    });
  });
});
```
