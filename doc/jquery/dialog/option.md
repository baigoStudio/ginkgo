## 配置

配置为一个 JSON 对象，大致形式及说明如下：

``` javascript
var opts_dialog = {
  selector: {
    // 选择器定义
  }
  btn_text: {
    // 按钮文字定义
  },
  tpl: '', // 对话框模板
  btn_tpl: '', // 按钮模板 1.0.1 新增
  input_tpl: '' // 输入框模板 1.0.1 新增
};
```

* [selector 选择器定义](#selector)
* [btn_text 按钮文字定义](#btn_text)
* [tpl 对话框模板](#tpl)
* [btn_tpl 按钮模板](#btn_tpl)
* [input_tpl 输入框模板](#input_tpl)

----------

<span id="selector"></span>

#### selector 选择器定义

| 对象 | 定义 | 默认值 | 备注 |
| - | - | - | - |
| modal | 对话框本体 | .bg-confirm-modal | |
| msg | 对话消息 | .bg-msg | |
| cancel | 取消按钮 | .bg-cancel | |
| confirm | 确认按钮 | .bg-confirm | |
| ok | OK 按钮 | .bg-ok | |
| group_confirm | 用于 confirm 的按钮组 | .bg-group-confirm | |
| group_alert | 用于 alert 的按钮组 | .bg-group-alert | `1.0.1` 弃用 |
| input_label | input 的说明 | .bg-input-label | `1.0.1` 新增 |
| input_control | input 的输入框 | .bg-input-control | `1.0.1` 新增 |

``` javascript
var opts_dialog = {
  // ...
  selector: {
    modal: '.bg-confirm-modal',
    msg: '.bg-msg',
    cancel: '.bg-cancel',
    confirm: '.bg-confirm',
    ok: '.bg-ok',
    group_confirm: '.bg-group-confirm',
    group_alert: '.bg-group-alert'
  },
  // ...
};
```

----------

<span id="btn_text"></span>

#### btn_text 按钮文字定义

| 对象 | 定义 | 默认值 |
| - | - | - |
| cancel | 取消按钮文字 | Cancel |
| confirm | 确定按钮文字 | Confirm |
| ok | 确定按钮文字 | OK |

``` javascript
var opts_dialog = {
  // ...
  btn_text: {
    cancel: 'Cancel',
    confirm: 'Confirm',
    ok: 'OK'
  },
  // ...
};
```

----------

<span id="tpl"></span>

#### tpl 对话框模板

此处主要定义显示提交结果的消息，用到 bootstrap 的 modal 组件

> 请留意模板与 selector 对象的关联

默认值

``` markup
<div class="modal bg-confirm-modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="bg-msg"></div>
      </div>
      <div class="modal-footer bg-footer"></div>
    </div>
  </div>
</div>
```
如：

``` javascript
var opts_dialog = {
  // ...
  tpl: '<div class="modal bg-confirm-modal">' +
    '<div class="modal-dialog modal-dialog-centered">' +
      '<div class="modal-content">' +
        '<div class="modal-body">' +
          '<p class="bg-msg"></p>' +
        '</div>' +
        '<div class="modal-footer bg-footer"></div>' +
      '</div>' +
    '</div>' +
  '</div>'
  // ...
};
```

----------

<span id="btn_tpl"></span>

#### btn_tpl 按钮模板

`1.0.1` 新增

此处主要定义按钮

> 请留意模板与 selector 对象的关联

默认值

``` javascript
var opts_dialog = {
  // ...
  btn_tpl: {
    alert: '<button type="button" class="btn btn-primary btn-sm bg-ok" data-dismiss="modal">OK</button>', // alert
    confirm: '<button type="button" class="btn btn-outline-secondary btn-sm bg-cancel bg-group-confirm" data-act="cancel">Cancel</button> <button type="button" class="btn btn-primary btn-sm bg-confirm bg-group-confirm" data-act="confirm">Confirm</button>' // confirm
  },
  // ...
};
```

----------

<span id="input_tpl"></span>

#### input_tpl 输入框模板

`1.0.1` 新增

此处主要定义输入框

> 请留意模板与 selector 对象的关联

默认值

``` javascript
var opts_dialog = {
  // ...
  input_tpl: '<div class="form-group"><label class="bg-input-label"></label><input type="text" class="form-control bg-input-control"></div>'
  // ...
};
```
