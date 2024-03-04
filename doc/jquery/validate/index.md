## baigoValidate

这是一个表单验证插件，`3.0` 起彻底重写，与以往版本完全不兼容。

> 本插件基于 bootstrap 4.3.* 版本，主要用到 css 样式，请使用者注意，您也可以通过配置完全脱离 bootstrap！

* [验证规则](builtin.md)
* [消息定义](message.md)
* [配置](option.md)
* [特殊情况](special.md)
* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoValidate/)

----------

<span id="dir"></span>

#### 目录结构

1. baigoValidate.js 验证插件
2. baigoValidate.min.js 验证插件压缩版
3. ajax.json ajax 验证示例

----------

<span id="use"></span>

#### 基本使用

载入文件

``` markup
<!-- 样式表，3.0 起不再需要 -->
<link href="baigoValidate.css" type="text/css" rel="stylesheet">

<!-- jQuery 库 -->
<script src="jquery.min.js" type="text/javascript"></script>

<!-- bootstrap 库 -->
<script src="bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="bootstrap.min.css" type="text/css" rel="stylesheet">

<!-- 插件 -->
<script src="baigoValidate.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

[下载 Bootstrap](http://getbootstrap.com)

表单 HTML

> 请注意表单的 `id` 或 `name` 属性必须与验证规则一一对应

`全局消息容器` 元素在验证出错时会提示错误。

`id="msg_{:name}"` 类型的元素会显示每一个表单验证的结果，`{:name}` 值应该与验证规则一一对应。

``` markup
<form name="tag_form" id="tag_form" action="tag_save.php">
  <div>
    <label>名称</label>
    <input value="" name="tag_name" id="tag_name">
    <small id="msg_tag_name"></small>
  </div>

  <div>
    <label>状态</label>
    <div>
      <input type="radio" name="tag_status" id="tag_status_show" value="show" checked>
      <label for="tag_status_show">显示</label>
    </div>
    <div>
      <input type="radio" name="tag_status" id="tag_status_hide" value="hide">
      <label for="tag_status_hide">隐藏</label>
    </div>
    <small id="msg_tag_status"></small>
  </div>

  <!-- 全局消息容器 -->
  <div class="bg-validate-box"></div>

  <button type="submit">保存</button>
</form>
```

初始化并触发验证，如：

``` markup
<script type="text/javascript">
// 配置
var opts_validate = {
  rules: {
    tag_name: {
      length: '1,30'
    },
    tag_status: {
      require: true
    }
  },
  attr_names: {
    tag_name: 'Tag',
    tag_status: '状态'
  },
  type_msg: {
    length: '{:attr} 只能在 {:rule} 之间',
    require: '{:attr} 是必须的'
  },
  msg: {
    loading: 'Loading...'
  },
  box: {
    msg: '输入错误'
  }
};

$(document).ready(function(){
  // 初始化
  obj_form = $('#form_id').baigoValidate(opts_validate);

  // 验证，2.0 起由 validateSubmit 改为 verify
  obj_form.verify();
});
</script>
```
