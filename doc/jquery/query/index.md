## baigoQuery

这是一个查询表单提交插件，用于生成符合 ginkgo 框架 URL 访问规则的查询 URL。

* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoQuery/)

----------

#### 目录结构

1. baigoQuery.js 查询表单提交插件
2. baigoQuery.min.js 查询表单提交插件压缩版

----------

#### 使用方法

载入文件

``` markup
<!-- jQuery 库 -->
<script src="jquery.min.js" type="text/javascript"></script>

<!-- 插件 -->
<script src="baigoQuery.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

表单 HTML

``` markup
<form name="search_form" id="search_form" action="/search/">
  <div>
    <label>关键词</label>
    <input type="text" name="key" value="" placeholder="关键词">
  </div>
  <div>
    <label>电压</label>
    <input type="text" name="cate" value="" placeholder="分类">
  </div>
  <div>
    <label>序列号</label>
    <input type="text" name="year" value="" placeholder="年代">
  </div>
  <button type="submit">搜索</button>
</form>
```

初始化并提交，如：

``` markup
<script type="text/javascript">
$(document).ready(function(){
  // 初始化插件
  var obj_query = $('#search_form').baigoQuery();

  $('#search_form').submit(function(){
    obj_query.formSubmit(); // 提交
  });
});
</script>
```

跳转的 URL 为：

/search/key/{:key}/cate/{:cate}/year/{:year}

----------

#### 初始化配置

插件初始化时可以传入参数，如：

``` javascript
$(document).ready(function(){
  // 实例化插件
  var obj_query = $('#search_form').baigoQuery({
    action: '', // 提交地址，默认为表单 action 属性值
    separator: '/', // 参数分隔符，用于替换传统 URL 中的 &
    equal: '/' // 参数值分隔符，用户替换传统 URL 中的 =
  });
});
```

您也可以按自己的意愿生成 URL，如：

``` javascript
$(document).ready(function(){
  // 实例化插件
  var obj_query = $('#search_form').baigoQuery({
    separator: '/',
    equal: '-'
  });
});
```

跳转的 URL 为：

/search/key-{:key}/cate-{:cate}/year-{:year}
