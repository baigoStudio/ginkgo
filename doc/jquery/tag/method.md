## 方法

baigoTag 实例化以后可以调用方法，如：

``` markup
<form name="article_form" id="article_form" action="article.php">
  <input type="text" name="article_tag" id="article_tag">
</form>

<script type="text/javascript">
// 配置
var opts_tag = {
  remote: {
    url: 'tag.php?key=%KEY'
  }
};

$(document).ready(function(){
  // 初始化 baigoTag
  var obj_tag = $('#article_tag').baigoTag(opts_tag);

  obj_tag.add('年代');
  obj_tag.add(['年代', '分类', '北京']);
  obj_tag.remove('年代');
  var tags = obj_tag.getTags();
});
</script>
```

----------

<span id="add"></span>

#### `add()` 方法说明

添加 Tag

``` javascript
obj_dialog.add(tags);
```

参数

* `tags` Tags 可以为字符串或者 json 对象

----------

<span id="remove"></span>

#### `remove()` 方法说明

移除 Tag

``` javascript
obj_dialog.remove(tag);
```

参数

* `tag` Tag 必须为字符串

----------

<span id="getTags"></span>

#### `getTags()` 方法说明

获取所有 Tag

``` javascript
obj_dialog.getTags();
```

返回值为 Tag 列表的 json 对象
