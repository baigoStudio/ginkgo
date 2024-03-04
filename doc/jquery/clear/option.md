## 配置

配置为一个 JSON 对象，大致形式及说明如下：

``` javascript
var opts_submit = {
  ajax_url: '', // 提交地址，默认由表单 action 属性定义
  timeout: 30000, // ajax 提交超时
  class_msg: {
    // 消息样式定义
  },
  class_icon: {
    // 图标样式定义
  },
  msg: {
    // 消息定义
  },
  selector: {
    // 选择器定义
  },
  tpl: '' // 容器模板
};
```

* [class_msg 消息样式定义](#class_msg)
* [class_icon 图标样式定义](#class_icon)
* [msg 消息定义](#msg)
* [selector 选择器定义](#selector)
* [tpl 容器模板](#tpl)

----------

<span id="class_msg"></span>

#### class_msg 消息样式定义

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | text-info |
| err | 出错时 | text-danger |
| success | 成功时 | text-success |

``` javascript
var opts_submit = {
  // ...
  class_msg: {
    submitting: 'text-info',
    err: 'text-danger',
    success: 'text-success'
  },
  // ...
}
```

----------

<span id="class_icon"></span>

#### class_icon 全局消息容器

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | spinner-grow spinner-grow-sm |
| err | 出错时 | fas fa-times-circle |
| success | 成功时 | fas fa-check-circle |

``` javascript
var opts_submit = {
  // ...
  class_icon: {
    submitting: 'spinner-grow spinner-grow-sm',
    err: 'fas fa-times-circle',
    success: 'fas fa-check-circle'
  },
  // ...
}
```

----------

<span id="msg"></span>

#### msg 消息定义

此处定义与表单相关的选择器

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | Submitting ... |
| complete | 清理完毕时 | Complete |
| err | 出错时 | Error |

``` javascript
var opts_submit = {
  // ...
  msg: {
    submitting: 'Submitting ...',
    complete: 'Complete',
    err: 'Error'
  },
  // ...
}
```

----------

<span id="selector"></span>

#### selector 选择器定义

| 对象 | 定义 | 默认值 |
| - | - | - |
| content | 消息容器 | .bg-clear |
| progress | 进度条 | .bg-progress |
| msg | 消息 | .bg-jump |
| msg_content | 消息内容 | .bg-msg-content |

``` javascript
var opts_submit = {
  // ...
  selector: {
    content: '.bg-clear',
    progress: '.bg-progress',
    msg: '.bg-msg',
    icon: '.bg-icon',
    msg_content: '.bg-msg-content'
  },
  // ...
}
```

----------

<span id="tpl"></span>

#### tpl 容器模板

此处主要定义显示提交结果的消息，用到 bootstrap 的 progress 组件

> 请留意模板与 selector 对象的关联

默认值

``` markup
<div class="bg-clear my-3 collapse">
  <div class="mb-3">
    <div class="bg-progress progress">
      <div class="progress-bar progress-bar-info progress-bar-striped active"></div>
    </div>
  </div>
  <div>
    <div class="bg-msg">
      <span class="bg-icon"></span>
      <span class="bg-msg-content"></span>
    </div>
  </div>
</div>
```
如：

``` javascript
var opts_submit = {
  // ...
  tpl: '<div class="bg-clear my-3 collapse">' +
    '<div class="mb-3">' +
      '<div class="bg-progress progress">' +
        '<div class="progress-bar progress-bar-info progress-bar-striped active"></div>' +
      '</div>' +
    '</div>' +
    '<div>' +
      '<div class="bg-msg">' +
        '<span class="bg-icon"></span> ' +
        '<span class="bg-msg-content"></span> ' +
      '</div>' +
    '</div>' +
  '</div>',
  // ...
}
```
