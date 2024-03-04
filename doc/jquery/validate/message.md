## 消息定义

验证的错误消息需要结合多种方式，如果没有定义，则显示默认消息。

----------

<span id="field"></span>

#### attr_names 属性名定义

以下是一个示例

``` javascript
var opts_validate = {
  rules: {
    name: {
      require: true,
      max: 25
    },
    age: {
      between: '1,120',
      format: 'number'
    },
    email: {
      format: 'email'
    }
  }
};

$(document).ready(function(){
  // 初始化
  obj_form = $('#form_id').baigoValidate(opts_validate);

  // 验证
  obj_form.verify();
});
```

假设表单输入的值为

```
name  => 'ginkgo'
age   => 121
email => 'ginkgo@qq.com'
```

在表单下方的消息容器中会输出

  age must between 1 - 120

可以给 `age` 表单设置中文名，例如：

``` javascript
var opts_validate = {
  rules: {
    // ...
  },
  attr_names: {
    age: '年龄',
  },
  // ...
}
```

会输出

  年龄 must between 1 - 120

----------

<span id="message"></span>

#### type_msg 验证消息定义

继续上一个例子，可以给输出消息设置中文，例如：

``` javascript
var opts_validate = {
  rules: {
    // ...
  },
  attr_names: {
    age: '年龄',
  },
  type_msg: {
    between: '{:attr} 只能在 {:rule} 之间',
    require: '{:attr} 是必须的'
  },
  // ...
};
```

会输出

  年龄 只能在 1 - 120 之间

----------

<span id="format"></span>

#### format_msg 格式消息定义

另一个例子：

``` javascript
var opts_validate = {
  rules: {
    name: {
      require: true,
      max: 25
    },
    age: {
      between: '1,120',
      format: 'number'
    },
    email: {
      format: 'email'
    }
  }
};

$(document).ready(function(){
  // 初始化
  obj_form = $('#form_id').baigoValidate(opts_validate);

  // 验证
  obj_form.verify();
});
```

假设表单输入的值为

```
name  => 'ginkgo'
age   => 111
email => 'ginkgo#qq.com'

```

会输出

  email not a valid email address

可以给格式消息设置中文，例如：

``` javascript
var opts_validate = {
  rules: {
    // ...
  },
  attr_names: {
    email: '邮箱'
  },
  format_msg: {
    email: '{:attr} 不是合法的 E-mail 地址'
  },
  // ...
};
```

会输出

  邮箱 不是合法的 E-mail 地址

----------

#### delimiter 规则消息定界符

上述几个例子可能有开发者注意，当规则中包含逗号 <kbd>,</kbd> 时，输出消息时会被替换成连字符 <kbd>-</kbd>，如果想要替换成其他字符，可以通过配置的 `delimiter` 对象进行定义，默认为 <kbd>-</kbd>。

``` javascript
var opts_validate = {
  delimiter: ' - ',
  // ...
};
```
