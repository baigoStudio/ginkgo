## baigoTag

这是一个 Tag 管理插件，用于 blog、cms 等需要用到 Tag 标签的后台。

> 本插件需要 typeahead.js 0.11.* 配合，主要用到 Bloodhound 功能，请使用者注意！

* [方法](method.md)
* [配置](option.md)
* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoTag/)

----------

<span id="dir"></span>

#### 目录结构

1. baigoTag.js 提交插件
2. baigoTag.min.js 提交插件压缩版
2. baigoTag.css CSS 样式文件

----------

<span id="use"></span>

#### 基本使用

载入文件

``` markup
<!-- jQuery 库 -->
<script src="jquery.min.js" type="text/javascript"></script>

<!-- typeahead -->
<link href="typeahead.css" type="text/css" rel="stylesheet">
<script src="typeahead.bundle.min.js" type="text/javascript"></script>

<!-- 插件 -->
<link href="baigoTag.css" type="text/css" rel="stylesheet">
<script src="baigoTag.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

[下载 typeahead.js](https://github.com/twitter/typeahead.js)

表单 HTML

``` markup
<form name="article_form" id="article_form" action="article.php">
  <input type="text" name="article_tag" id="article_tag">
</form>
```

初始化并提交，如：

``` markup
<script type="text/javascript">
var opts_tag = {
  remote: {
    url: 'tag.php?key=%KEY'
  }
};

$(document).ready(function(){
  // 初始化 baigoTag
  var obj_tag = $('#article_tag').baigoTag(opts_tag);
});
</script>
```

----------

<span id="remore"></span>

#### 远程查询

远程查询必须在初始化时指定 `remote.url` 对象，可以用通配符，通配符的名称由 `remote.wildcard` 对象指定，默认为 `%KEY`，上述例子中的 %KEY 会由 article_tag 表单值填充，也可以自行定义通配符的名称，如：

``` javascript
var opts_tag = {
  remote: {
    url: 'tag.php?key=%SEARCH',
    wildcard: '%SEARCH'
  }
};

$(document).ready(function(){
  // 初始化 baigoTag
  var obj_tag = $('#article_tag').baigoTag(opts_tag);
});
```

插件接受 json 对象的返回，如：

``` javascript
[
  '年代', '分类', '北京'
]
```

----------

<span id="submit"></span>

#### 表单提交

插件会自动根据 Tag 输入框的 `name` 和 `id` 属性生成一个 `id="{:id}_hidden"` 形式的隐藏表单，其值为逗号 <kbd>,</kbd> 分隔的 Tag 列表，如：

``` markup
<form name="article_form" id="article_form" action="article.php">
  <input type="hidden" name="article_tag_hidden" id="article_tag_hidden" value="年代,分类,北京">
  <input type="text" name="article_tag" id="article_tag">
</form>
```
