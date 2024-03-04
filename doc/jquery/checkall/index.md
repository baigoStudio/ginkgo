## baigoCheckall

这是一个表单 checkbox 全选插件

* [下载](https://github.com/baigoStudio/ginkgo/tree/master/public/static/lib/baigoCheckall/)

----------

#### 目录结构

1. baigoCheckall.js 全选插件
2. baigoCheckall.min.js 全选插件压缩版

----------

#### 使用方法

载入文件

``` markup
<!-- jQuery 库 -->
<script src="jquery.min.js" type="text/javascript"></script>

<!-- 插件 -->
<script src="baigoCheckall.min.js" type="text/javascript"></script>
```

[下载 jQuery](http://www.jquery.com)

在需要操作的 `checkbox` 中定义 `id` 和 `data-parent`，其中，`id` 代表选框本身，`data-parent` 代表父元素的 `id`，例：

``` markup
<input type="checkbox" id="first" data-parent="none">
<input type="checkbox" id="second_1" data-parent="first">
<input type="checkbox" id="second_2" data-parent="first">
<input type="checkbox" id="second_3" data-parent="first">
<input type="checkbox" id="second_4" data-parent="first">
```

> 特别提示：1.0 之前，由 `class` 定义父元素的 `id`，1.0 之后改为 `data-parent` 属性。

初始化插件

``` markup
<script type="text/javascript">
$(document).ready(function(){
  // 初始化
  $('#form_demo').baigoCheckall();
});
</script>
```

当用户选中 `id` 为 `first` 的选框的时候，`data-parent` 为 `first` 的选框将全部被选中，反之则为未选中；当任意一个 `data-parent` 为 first 的选框未被选中时，`id` 为 `first` 的选框也会处于未被选中状态。
