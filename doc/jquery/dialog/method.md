## 方法

baigoDialog 实例化以后可以调用方法，如：

``` markup
<form name="delete_form" id="delete_form" action="delete.php">
  <button type="submit" id="btn_submit">删除</button>
  <button type="button" id="btn_alert">提醒</button>
</form>

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

----------

<span id="confirm"></span>

#### `confirm()` 方法说明

用于确认某些动作，可以取消。

``` javascript
obj_dialog.confirm(message, callback);
```

参数

* `message` 提醒消息，必需

* `callback` 回调，必需，必须是函数

  当用户点击 cancel 按钮，函数的参数值为 false，点击 confirm 按钮否则为 true

----------

<span id="alert"></span>

#### `alert()` 方法说明

用于显示提醒消息，无法取消。

``` javascript
obj_dialog.alert(message);
```

参数

* `message` 提醒消息，必需

----------

<span id="input"></span>

#### `input()` 方法说明

`1.0.1` 新增

用于确认某些动作，可以取消。

``` javascript
obj_dialog.input(input, callback);
```

参数

* `input` 需要输入的值，必需

  类型可以为 array 或 string

* `callback` 回调，必需，必须是函数

  函数的参数值为用户输入值，参数值可能为 array 或 string，与 input 参数对应
