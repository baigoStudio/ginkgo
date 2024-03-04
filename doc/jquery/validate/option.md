## 配置

配置为一个 JSON 对象，大致形式及说明如下：

``` javascript
var opts_validate = {
  rules: {
    // 验证规则
  },
  attr_names: {
    // 字段名定义
  },
  type_msg: {
    // 验证消息定义
  },
  format_msg: {
    // 格式消息定义
  },
  selector_types: {
    // 选择器类型
  }
  msg: {
    // 错误消息
  },
  box: {
    // 全局消息容器
  },
  field_selector: {
    // 字段相关选择器
  },
  class_name: {
    // 类名
  },
  result_obj: {
    // 服务器返回参数 3.0.2 起
  },
  extra: {
    // 额外消息
  },
  extra_boxes: {
    // 额外消息容器
  },
  scene: {
    // 验证场景
  },
  timeout: 30000, // ajax 验证超时
  delimiter: ' - ' // 规则定界符，用于替换规则中的逗号 ,
};
```

* [rules 验证规则](builtin.md)，必需
* [attr_names 字段名定义](message.md#field)
* [type_msg 验证消息定义](message.md#message)
* [format_msg 格式消息定义](message.md#format)
* [selector_types 选择器类型](special.md#selector_types)
* [msg 错误消息](#msg)
* [box 全局消息容器](#box)
* [field_selector 字段相关选择器](#field_selector)
* [class_name 类名](#class_name)
* [result_obj 服务器返回参数](#result_obj) `3.0.2` 起
* [extra 额外消息](#extra) `3.0.3` 起
* [extra_boxes 额外消息容器](special.md#extra_boxes) `3.0.3` 起
* [scene 验证场景](#scene) `3.1.0` 起

----------

<span id="msg"></span>

#### msg 错误消息

| 对象 | 定义 | 默认值 |
| - | - | - |
| loading | ajax 方式验证时正在验证的消息 | Loading |
| ajax_err | ajax 验证时服务器出错的消息 | Error |

``` javascript
var opts_validate = {
  // ...
  msg: {
    loading: 'Loading',
    ajax_err: 'Error'
  },
  // ...
};
```

----------

<span id="box"></span>

#### box 全局消息容器

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| tpl | 容器模板 | |
| selector | 相关选择器 | |
| class_name | 容器的 css 类名 | alert-danger `3.1.0` 起废弃 |
| class_icon | 图标的 css 类名 | fas fa-exclamation-circle `3.1.0` 起废弃 |
| msg | 全局消息 | Input error |
| delay | 容器显示时间 | 5000 |

tpl 容器模板

> 请留意模板与 selector 对象的关联

``` markup
<div class="alert alert-danger alert-dismissible"><span class="bg-msg"></span><button type="button" class="close" data-dismiss="alert">&times;</button></div>
```

selector 对象

| 对象 | 定义 | 默认值 |
| - | - | - |
| box | 容器选择器 | .bg-validate-box |
| content | 内容选择器 | .bg-content `3.1.0` 起废弃 |
| icon | 图标选择器 | .bg-icon `3.1.0` 起废弃 |
| msg | 消息选择器 | .bg-msg |

``` javascript
var opts_validate = {
  // ...
  box: {
    selector: {
      box: '.bg-validate-box',
      msg: '.bg-msg'
    },
    msg: 'Input error',
    tpl: '<div class="alert alert-danger alert-dismissible"><span class="bg-msg"></span><button type="button" class="close" data-dismiss="alert">&times;</button></div>',
    delay: 5000
  },
  // ...
};
```

----------

<span id="field_selector"></span>

#### field_selector 字段相关选择器

此处定义与字段相关的选择器

| 对象 | 定义 | 默认值 |
| - | - | - |
| prefix_msg | 消息容器前缀 | #msg_ |
| prefix_group | 表单组前缀 | #group_ |

``` javascript
var opts_validate = {
  // ...
  field_selector: {
    prefix_msg: '#msg_',
    prefix_group: '#group_'
  },
  // ...
};
```

----------

<span id="class_name"></span>

#### class_name 类名

此处定义与字段相关的选择器

| 对象 | 定义 | 默认值 | 备注 |
| - | - | - | - |
| input | 表单类名 | success: 'is-valid', err: 'is-invalid' | |
| msg | 消息容器类名 | success: 'valid-feedback', err: 'invalid-feedback', loading: 'text-info' | |
| group | 表单组类名 | success: 'text-success', err: 'text-danger' | `3.0.3` 新增 |
| attach | 等效于 group 对象 | | 即将弃用 |

``` javascript
var opts_validate = {
  // ...
  class_name: {
    input: {
      success: 'is-valid',
      err: 'is-invalid'
    },
    msg: {
      success: 'valid-feedback',
      err: 'invalid-feedback',
      loading: 'text-info'
    },
    group: { // 3.0.2 及之前版本为 attach
      success: 'text-success',
      err: 'text-danger'
    }
  },
  // ...
};
```

----------

<span id="result_obj"></span>

#### result_obj 服务器返回参数

`3.0.2` 新增

此处定义服务器返回的参数名

| 对象 | 定义 | 默认值 |
| - | - | - |
| error_msg | 错误消息参数名 | 错误信息，当此对象未定义或为空时，则视为验证成功 |
| msg | 消息参数名 | 消息 |

``` javascript
var opts_validate = {
  // ...
  result_obj: {
    error_msg: 'error_msg',
    msg: 'msg'
  },
  // ...
};
```

----------

<span id="extra"></span>

#### extra 额外消息

`3.0.3` 新增

此处定义的选择器、类名都可以和 tpl 对象的默认值相对应

| 对象 | 定义 | 默认值 |
| - | - | - |
| tpl | 容器模板 | `3.1.0` 起废弃 |
| selector | 相关选择器 | `3.1.0` 起废弃 |
| class_name | 容器的 css 类名 | bg-validate-extra |
| class_icon | 图标的 css 类名 | fas fa-exclamation-circle `3.1.0` 起废弃 |
| msg | 全局消息 | Input error `3.1.0` 起废弃 |
| delay | 容器显示时间 | 5000 |

``` javascript
var opts_validate = {
  // ...
  extra: {
    class_name: 'bg-validate-extra',
    delay: 5000
  },
  // ...
};
```

----------

<span id="scene"></span>

#### scene 验证场景

`3.1.0` 新增

支持定义场景，便于验证不同场景下的数据。通常使用如下方式

``` javascript
var opts_validate = {
  rules: {
    user_name: {
      length: '1,30',
      format: 'alpha_dash'
    },
    user_mail: {
      max: 300,
      format: 'email'
    },
    user_ids: {
      require: true
    },
    act: {
      require: true
    },
    // 更多规则...
  },
  scene: {
    submit: [ 'user_name', 'user_mail' ],
    status: [ 'user_ids', 'act' ],
    delete: [ 'user_ids' ]
  }
  // 更多配置...
};
```

在需要进行验证的地方调用 `scene()` 方法

``` javascript
$(document).ready(function(){
  obj_form = $('#form_id').baigoValidate(opts_validate);
  obj_form.scene('submit');
  obj_form.verify();
});
```

----------
