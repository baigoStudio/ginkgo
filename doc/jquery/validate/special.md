##特殊情况

在日常使用中，可能会遇到一些特殊情况，此处提供一些解决示例。

----------

<span id="selector_types"></span>

#### 选择器类型

在日常使用中，可能会遇到表单 id、name 无法与验证规则匹配，这种情况通常出现在需要输入数组的表单中，下面是一个示例：

``` markup
<div>
  <input type="checkbox" name="allow[add]" value="1" id="allow_add" data-validate="allow">
  <label for="allow_add">
    添加
  </label>
</div>
<div>
  <input type="checkbox" name="allow[edit]" value="1" id="allow_edit" data-validate="allow">
  <label for="allow_edit">
    编辑
  </label>
</div>
<div>
  <input type="checkbox" name="allow[delete]" value="1" id="allow_delete" data-validate="allow">
  <label for="allow_delete">
    删除
  </label>
</div>
```

通常情况下，插件会根据表单 `id` 或 `name` 属性去匹配验证规则。

上述例子由于表单类型是 `checkbox`，所以 `id` 是三个，而规则是一个，因此无法根据 `id` 匹配验证规则，这种情况下，插件会根据 `name` 属性去匹配规则，而恰好此例的 `name` 属性是一个数组，与 JSON 的命名规则不匹配，因此必须有一种替代方法来匹配规则。

我们需要分两步来解决：

1. 请注意上述例子中的 `data-validate` 属性，此属性的值与验证规则相同
2. 在配置对象中定义 `selector_types` 对象，如：

``` javascript
var opts_validate = {
  rules: {
    allow: {
      require: true
    }
  },
  selector_types: {
    allow: 'validate'
  }
};
```

`selector_types` 对象用来定义每一条规则所对应的表单选择器，以便插件能够获取表单的值。

采用 `规则名: 选择器类型` 的方式定义，选择器类型可能的值如下：

1. validate
2. name
3. class
4. id

----------

<span id="extra_boxes"></span>

#### 额外消息

`3.0.3` 新增

在日常使用中，可能会遇到需要额外提示消息，这种情况通常出现在使用了 Tab 的表单中，下面是一个示例：

``` markup
<form name="comp_form" id="comp_form" action="submit.php">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#basic" data-toggle="tab" class="nav-link active">基本</a>
    </li>
    <li class="nav-item">
      <a href="#location" data-toggle="tab" class="nav-link">位置</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="basic">
      <div>
        <label>名称</label>
        <input type="text" name="c_name" id="c_name">
        <small id="msg_c_name"></small>
      </div>
    </div>
    <div class="tab-pane" id="location">
      <div>
        <label>地址</label>
        <input type="text" name="c_addr" id="c_addr">
        <small id="msg_c_addr"></small>
      </div>
    </div>
  </div>
</form>
```

通常情况下，假如表单验证不通过的话，提示消息会出现在 `id="msg_表单名"` 这种形式的元素中。

上述例子由于 `id="basic"` 的 Tab 处于激活状态，而 `id="location"` 的 Tab 是无法看到的，而此时假设 `id="c_addr"` 的域无法通过验证，则提示消息会显示在 `id="msg_c_addr"` 的元素中，而这个元素由于 `id="location"` 的状态，也是无法看到的，此时用户就无从得知错误的具体情况，因此必须有一种替代方法来解决。

我们需要分两步来解决：

1. 首先，在 `class="nav-link"` 的元素中添加一个用于显示额外消息的元素，即 `id="extra_msg_Tab 名"` 形式的表单

  ``` markup
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#basic" data-toggle="tab" class="nav-link active">
        基本
        <span id="extra_msg_base"></span>
      </a>
    </li>
    <li class="nav-item">
      <a href="#location" data-toggle="tab" class="nav-link">
        位置
        <span id="extra_msg_location"></span>
      </a>
    </li>
  </ul>
  ```

2. 在配置对象中定义 `extra_boxes` 对象，请注意与验证规则 `rules` 对应，如：

  ``` javascript
  var opts_validate = {
    rules: {
      c_name: {
        require: true
      },
      c_addr: {
        require: true
      }
    },
    extra_boxes: {
      c_name: '#extra_msg_base',
      c_addr: '#extra_msg_location'
    }
  };
  ```

`extra_boxes` 对象用来定义每一条规则所对应的额外消息元素，以便插件能够提供更丰富的错误提示。

采用 `规则名: 额外消息` 的方式定义，额外消息的类型可以是字符串，此时必须为消息元素的选择器，上述例子就是这种情况，也可以是一个对象，结构如下：

| 键名 | 描述 |
| - | - |
| selector | 选择器 |
| msg | 消息 |

上述例子也可以等效表达为：

``` javascript
var opts_validate = {
  rules: {
    c_name: {
      require: true
    },
    c_addr: {
      require: true
    }
  },
  extra_boxes: {
    c_name: {
      selector: '#extra_msg_base'
    },
    c_addr: {
      selector: '#extra_msg_location'
    }
  }
};
```
