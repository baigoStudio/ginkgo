## 配置

配置为一个 JSON 对象，大致形式及说明如下：

``` javascript
var opts_tag = {
  maxTags: 5, // 最多 Tag（默认为 5 个）
  minChar: 0, // 最小字符（大于此值才会添加，默认为 0 无限制）
  addOnBlur: true, // 失去焦点时添加（默认为 true）
  highlight: true, // 关键词高亮
  confirmKeycodes: [
    // 添加键码
  ],
  class_name: {
    // 类名定义
  },
  selector: {
    // 选择器定义
  }
  tpl: {
    // 模板定义
  },
  remote: {
    // 远程查询
  }
};
```

* [remote 远程查询](#remote)，必需
* [selector 选择器定义](#selector)
* [class_name 类名定义](#class_name)
* [confirmKeycodes 添加键码](#confirmKeycodes)
* [tpl 对话框模板](#tpl)

----------

<span id="remote"></span>

#### remote 远程查询

| 对象 | 定义 | 默认值 |
| - | - | - |
| url | 远程查询地址 | |
| wildcard | 通配符 | %KEY |

``` javascript
var opts_tag = {
  // ...
  remote: {
    url: '',
    wildcard: '%KEY'
  },
  // ...
};
```

----------

<span id="selector"></span>

#### selector 选择器定义

| 对象 | 定义 | 默认值 |
| - | - | - |
| tag_list | Tag 列表容器 | .bg-tag-list |
| tag_item | 单个 Tag 容器 | .bg-tag-item |

``` javascript
var opts_tag = {
  // ...
  selector: {
    tag_list: '.bg-tag-list',
    tag_item: '.bg-tag-item'
  },
  // ...
};
```

----------

<span id="class_name"></span>

#### class_name 类名定义

| 对象 | 定义 | 默认值 |
| - | - | - |
| tag_list | Tag 列表容器 | bg-tag-list |
| tag_item | 单个 Tag 容器 | bg-tag-item |

``` javascript
var opts_tag = {
  // ...
  class_name: {
    tag_list: 'bg-tag-list',
    tag_item: 'bg-tag-item'
  },
  // ...
};
```

----------

<span id="confirmKeycodes"></span>

#### confirmKeycodes 添加键码

定义哪些键盘键按下时添加 Tag

``` javascript
var opts_tag = {
  // ...
  confirmKeycodes: [13, 186, 188],
  // ...
};
```

默认值中，`13` 为回车键 <kbd>Enter</kbd>、`186` 为分号 <kbd>;</kbd>、`188` 为逗号 <kbd>,</kbd>。

----------

<span id="tpl"></span>

#### Tag 列表容器模板

此处主要定义 Tag 列表的容器

> 请留意模板与 selector 对象的关联

``` javascript
var opts_tag = {
  // ...
  tpl: '<div class="bg-tag-list"></div>'
  // ...
};
```
