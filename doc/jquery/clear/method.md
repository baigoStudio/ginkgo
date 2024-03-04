## 方法

baigoClear 实例化以后可以调用方法，如：

``` markup
<form name="form_cate" id="form_cate" class="form_clear" action="clear.php">
  <div>数据清理</div>
  <button type="submit">开始清理</button>
</form>

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
  var obj_clear = $('#form_cate').baigoClear(opts_clear);

  obj_clear.ajaxUrl('test.php'); // 变更 action 地址

  $('#form_cate').submit(function(){
    obj_clear.clearSubmit('new_clear.php'); // 提交
  });
});
</script>
```

----------

<span id="ajaxUrl"></span>

#### `ajaxUrl()` 方法说明

用于变更 action 地址

``` javascript
obj_clear.ajaxUrl(url);
```

参数

* `url` 提交地址，必须

----------

<span id="clearSubmit"></span>

#### `clearSubmit()` 方法说明

用于提交表单

``` javascript
obj_clear.clearSubmit(url);
```

参数

* `url` 提交地址，为空时为表单 `action` 属性值
