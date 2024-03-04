## 配置

配置为一个 JSON 对象，大致形式及说明如下：

``` javascript
var opts_submit = {
  ajax_url: '', // 提交地址，默认由表单 action 属性定义
  timeout: 30000, // ajax 提交超时
  class_content: {
    // 消息样式定义
  },
  msg_text: {
    // 消息定义
  },
  selector: {
    // 选择器定义
  }
  modal: {
    // 对话框定义
  },
  jump: {
    // 跳转定义
  },
  replaces: '' // 替换定义
};
```

* [class_content 消息样式定义](#class_content)
* [class_icon 图标样式定义](#class_icon)
* [msg_text 消息定义](#msg_text)
* [selector 选择器定义](#selector)
* [modal 对话框定义](#modal)
* [jump 跳转定义](#jump)
* [replaces 替换定义](#replaces)

----------

<span id="class_content"></span>

#### class_content 消息样式定义

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | text-info |
| err | 出错时 | text-danger |
| success | 成功时 | text-success |

``` javascript
var opts_submit = {
  // ...
  class_content: {
    submitting: 'text-info',
    err: 'text-danger',
    success: 'text-success'
  },
  // ...
}
```

----------

<span id="class_icon"></span>

#### class_icon 图标样式定义

`2.1.4` 起废弃

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | spinner-grow spinner-grow-sm |
| err | 出错时 | fas fa-exclamation-triangle |
| success | 成功时 | fas fa-check-circle |

``` javascript
var opts_submit = {
  // ...
  class_icon: {
    submitting: 'spinner-grow spinner-grow-sm',
    err: 'fas fa-exclamation-triangle',
    success: 'fas fa-check-circle'
  },
  // ...
}
```

----------

<span id="msg_text"></span>

#### msg_text 消息定义

此处定义与表单相关的选择器

| 对象 | 定义 | 默认值 |
| - | - | - |
| submitting | 正在提交时 | Submitting ... |
| err | 出错时 | Error |

``` javascript
var opts_submit = {
  // ...
  msg_text: {
    submitting: 'Submitting ...',
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
| submit_btn | 提交按钮 | [type="submit"] |
| empty_input | 需要清空的表单 | :password |
| jump_link | 跳转链接 | .bg-jump |

``` javascript
var opts_submit = {
  // ...
  selector: {
    submit_btn: '[type="submit"]',
    empty_input: ':password',
    jump_link: '.bg-jump'
  },
  // ...
}
```

----------

<span id="modal"></span>

#### modal 对话框定义

此处主要定义显示提交结果的对话框，用到 bootstrap 的 modal 组件

| 对象 | 定义 | 默认值 |
| - | - | - |
| tpl | 对话框模板 | |
| selector | 相关选择器 | |
| btn_text | 按钮文字 | |
| delay | 对话框停留时间 | 5000 |

tpl 对话框模板

> 请留意模板与 selector 对象的关联

默认值

``` markup
<div class="modal fade bg-submit-modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex justify-content-between align-items-end">
        <p class="lead bg-content">
          <span class="bg-icon mr-2"></span>
          <span class="bg-msg"></span>
        </p>
        <p class="bg-jump"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm bg-close" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-primary btn-sm bg-ok">OK</a>
      </div>
    </div>
  </div>
</div>
```

selector 对象

| 对象 | 定义 | 默认值 |
| - | - | - |
| modal | 对话框选择器 | .bg-submit-box |
| content | 内容选择器 | .bg-content |
| icon | 图标选择器 | .bg-icon |
| msg | 消息选择器 | .bg-msg |
| close | 关闭按钮选择器 | .bg-close |
| ok | 确定按钮选择器 | .bg-ok |

btn_text 对象

| 对象 | 定义 | 默认值 |
| - | - | - |
| close | 关闭按钮文字 | Close |
| ok | 确定按钮文字 | OK |

``` javascript
var opts_submit = {
  // ...
  modal: {
    selector: {
      modal: '.bg-submit-modal',
      content: '.bg-content',
      icon: '.bg-icon',
      msg: '.bg-msg',
      close: '.bg-close',
      ok: '.bg-ok'
    },
    btn_text: {
      close: 'Close',
      ok: 'OK'
    },
    tpl: '<div class="modal fade bg-submit-modal">' +
      '<div class="modal-dialog modal-dialog-centered">' +
        '<div class="modal-content">' +
          '<div class="modal-body d-flex justify-content-between align-items-end">' +
            '<p class="lead bg-content">' +
              '<span class="bg-icon mr-2"></span>' +
              '<span class="bg-msg"></span>' +
            '</p>' +
            '<p class="bg-jump"></p>' +
          '</div>' +
          '<div class="modal-footer">' +
            '<button type="button" class="btn btn-outline-secondary btn-sm bg-close" data-dismiss="modal">Close</button>' +
            '<a href="#" class="btn btn-primary btn-sm bg-ok">OK</a>' +
          '</div>' +
        '</div>' +
      '</div>' +
    '</div>',
    delay: 5000
  },
  // ...
}
```

----------

<span id="jump"></span>

#### jump 跳转定义

此处用来定义提交成功后的调转，url 或 text 对象为空时，整个定义无效，页面不会跳转。

| 对象 | 定义 | 默认值 |
| - | - | - |
| url | 跳转地址 | |
| text | 跳转显示文字 | |
| icon | 跳转图标 | spinner-grow spinner-grow-sm |
| attach_key | 跳转附加参数名（服务器返回的参数名） | |
| delay | 停留时间 | 3000 |

attach_key 说明

当定义了此对象，如服务器的返回结果中有与此一致的对象，则会以 `attach_key={:attach_value}` 的形式附加到 url 后，{:attach_value} 为服务器返回的值。

``` javascript
var opts_submit = {
  // ...
  jump: {
    url: '',
    text: '',
    icon: 'spinner-grow spinner-grow-sm',
    attach_key: '',
    delay: 3000
  },
  // ...
}
```

----------

<span id="replaces"></span>

#### replaces 替换定义

`2.1.3` 新增

此处用来定义提交成功后，替换 html 元素。

当提交成功后，有时候我们需要用服务器返回的参数去替换页面中的 html 元素，此处的设置将非常有用。

本对象可以是字符串，也可以是一个对象，以下为定义例子：

``` javascript
var opts_submit = {
  // ...
  replace: 'uid',
  // ...
}
```

以下定义等效：

``` javascript
var opts_submit = {
  // ...
  replace: ['uid', 'name'],
  // ...
}

var opts_submit = {
  // ...
  replace: {
    uid: true,
    name: true
  },
  // ...
}
```

以下定义等效：

``` javascript
var opts_submit = {
  // ...
  replace: {
    uid: {
      selector: '#uid',
      attr: 'value'
    },
    name: {
      selector: '#name',
      attr: 'value'
    }
  },
  // ...
}

var opts_submit = {
  // ...
  replace: [
    {
      key: 'uid',
      selector: '#uid',
      attr: 'value'
    },
    {
      key: 'name',
      selector: '#name',
      attr: 'value'
    }
  ],
  // ...
}
```

| 对象 | 定义 | 描述 |
| - | - | - |
| key | 服务器返回的参数名 | 如此对象未定义，默认为 JSON 键名 |
| selector | 被替换对象的选择器 | 如此对象未定义，默认为 `#key` 的形式 |
| attr | 欲替换对象的属性 | 默认为 `value` |

下面的例子中，提交成功后，假如服务返回参数里面有 `uid` 这个参数，那么插件会将选择器为 `#uid` 的元素的值替换为服务器返回的 `uid`。

``` javascript
var opts_submit = {
  // ...
  replaces: [
    {
      key: 'uid',
      selector: '#uid',
      attr: 'value'
    }
  ]
  // ...
}
```
