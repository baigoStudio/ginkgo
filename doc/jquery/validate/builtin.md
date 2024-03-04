## 验证规则

所有验证规则都在此设置，每个字段一个对象

``` javascript
var opts_validate = {
  rules: {
    tag_name: {
      require: true, // 验证类型
      format: 'alpha_dash' // 验证格式
    },
    tag_note: {
      length: '1,30' // 验证类型
    },
    tag_status: {
      require: true
    },
    // 更多规则...
  },
  // 更多配置...
};
```

* [常规验证](#common)
* [长度和区间验证](#length)
* [字段比较](#comparison)
* [格式验证](#format)
* [特殊格式验证](#special)
* [正则验证](#regex)
* [ajax 验证](#ajax)

----------

<span id="common"></span>

#### 常规验证

> require

验证某个字段必须，例如：

``` javascript
rules: {
  name: {
    require: true,
  },
},
```

> accepted

验证某个字段是否为为 yes, on, 或是 1。这在确认 "服务条款" 是否同意时很有用，例如：

``` javascript
rules: {
  name: {
    accepted: true,
  },
},
```

----------

<span id="length"></span>

#### 长度和区间验证

> in

验证某个字段的值是否在某个范围，例如：

``` javascript
rules: {
  name: {
    in: '1,2,3',
  },
},
```

> not_in

验证某个字段的值不在某个范围，例如：

``` javascript
rules: {
  name: {
    not_in: '1,2,3',
  },
},
```

> between

验证某个字段的值是否在某个区间，例如：

``` javascript
rules: {
  name: {
    between: '25,60',
  },
},
```

> not_between

验证某个字段的值不在某个区间，例如：

``` javascript
rules: {
  name: {
    not_between: '20,30',
  },
},
```

> length

验证某个字段的值的长度是否在某个范围，例如：

``` javascript
rules: {
  name: {
    length: '4,25',
  },
},
```

> min

验证某个字段的值的最小长度，例如：

``` javascript
rules: {
  name: {
    min: 4,
  },
},
```

> max

验证某个字段的值的最大长度，例如：

``` javascript
rules: {
  name: {
    max: 25,
  },
},
```

> after

验证某个字段的值是否在某个日期之后，例如：

``` javascript
rules: {
  name: {
    after: '2016-3-18',
  },
},
```

> before

验证某个字段的值是否在某个日期之前，例如：

``` javascript
rules: {
  name: {
    before: '2016-3-18',
  },
},
```

> expire

验证某个字段是否在某个有效日期之内，例如：

``` javascript
rules: {
  name: {
    expire: '2016-2-1,2016-10-01',
  },
},
```

----------

<span id="comparison"></span>

#### 字段比较

> confirm

验证某个字段是否和另外一个字段的值一致，例如：

``` javascript
rules: {
  password: {
    require: true,
  },
  password_confirm: {
    confirm: true,
  },
},
```

系统会自动验证 password_confirm 与 password 是否一致。

该规则是自动验证的，只要在需要验证的字段名后加上 <kdb>_confirm</kbd>，也可以指定需要验证的字段名，例如：

``` javascript
rules: {
  password: {
    require: true,
  },
  repassword: {
    confirm: 'password',
  },
},
```

> different

验证某个字段是否和另外一个字段的值不一致，例如：

``` javascript
rules: {
  account: {
    require: true,
  },
  account_different: {
    different: true,
  },
},
```

该规则与 confirm 类似，只要在需要验证的字段名后加上 <kdb>_different</kbd>，也可以指定需要验证的字段名，例如：

``` javascript
rules: {
  account: {
    require: true,
  },
  reaccount: {
    different: 'account',
  },
},
```

> gt 或 &gt;

验证是否大于某个值，例如：

``` javascript
rules: {
  score: {
    gt: 100,
  },
  num: {
    '>': 100,
  },
},
```

> egt 或 >=

验证是否大于等于某个值，例如：

``` javascript
rules: {
  score: {
    egt: 100,
  },
  num: {
    '>=': 100,
  },
},
```

> lt 或 &lt;

验证是否小于某个值，例如：

``` javascript
rules: {
  score: {
    lt: 100,
  },
  num: {
    '<': 100,
  },
},
```

> elt 或 <=

验证是否小于等于某个值，例如：

``` javascript
rules: {
  score: {
    elt: 100,
  },
  num: {
    '<=': 100,
  },
},
```

> eq、= 或 same

验证是否等于某个值，例如：

``` javascript
rules: {
  score: {
    eq: 100,
  },
  num: {
    '=': 100,
  },
  num_1: {
    same: 100,
  },
},
```

> neq、&lt;&gt; 或 !=

验证是否不等于某个值，例如：

``` javascript
rules: {
  score: {
    neq: 100,
  },
  num: {
    '<>': 100,
  },
  num_1: {
    '!=': 100,
  },
},
```

----------

<span id="format"></span>

#### 格式验证

格式验证只需设置 format 参数

``` javascript
rules: {
  name: {
    format: 'number',
  },
},
```

format 参数可选如下值

| 值 | 描述 |
| - | - |
| number | 纯数字（不包含负数和小数点） |
| int | 整数 |
| float | 浮点数 |
| bool | 布尔值 |
| email | Email |
| array | 数组 |
| date | 有效日期 |
| time | 有效时间 |
| date_time | 有效日期时间 |
| alpha | 字母 |
| alpha_number | 字母与纯数字 |
| alpha_dash | 字母、数字、连字符（<kbd>-</kbd>）与下划线（<kbd>_</kbd>） |
| chs | 中文 |
| chs_alpha | 中文与字母 |
| chs_alpha_number | 中文、字母与纯数字 |
| chs_dash | 中文、字母、数字、连字符（<kbd>-</kbd>）与下划线（<kbd>_</kbd>） |
| url | URL 地址 |
| ip | IP 地址（含 IPv4 与 IPv6） |

----------

<span id="special"></span>

#### 特殊格式验证

以下规则为验证值是否为指定的格式，如：

假设规则为 `Y-m-d`

表单输入值为 `2019-05-06` 时，验证通过

表单输入值为 `19-05-06` 或 `May. 6, 2019` 验证不通过

> date_format

验证某个字段的值是否为指定格式的日期，例如：

``` javascript
rules: {
  create_time: {
    date_format: 'Y-m-d',
  },
},
```

> time_format

验证某个字段的值是否为指定格式的时间，例如：

``` javascript
rules: {
  create_time: {
    time_format: 'H:i:s',
  },
},
```

> date_time_format

验证某个字段的值是否为指定格式的日期时间，例如：

``` javascript
rules: {
  create_time: {
    date_time_format: 'Y-m-d H:i:s',
  },
},
```

----------

<span id="regex"></span>

#### 正则验证

支持直接使用正则验证，例如：

``` javascript
rules: {
  zip: {
    regex: '\d{6}',
  },
},
```

----------

<span id="ajax"></span>

#### ajax 验证

基本用法，例如：

``` javascript
rules: {
  zip: {
    require: true,
    ajax: {
      url: 'ajax.json'
    }
  },
},
```

上述例子会使用 `ajax.json?zip={:value}` 形式的 URL 进行验证。

URL 中的 `zip` 参数默认为规则名，`{:value}` 为表单值。

服务器返回

`3.0.2` 起，服务器返回的参数名改为可选，以下例子为默认值。

插件接受 json 对象的返回，如：

``` javascript
{
  msg: '验证成功', // 消息
  error_msg: '' // 错误信息，当此对象未定义或为空时，则视为验证成功
  error: '' // 3.0.2 以前
}
```

高级用法，例如：

``` javascript
rules: {
  zip: {
    require: true,
    ajax: {
      key: 'zipcode',
      attach: {
        selectors: ['#cate', '#parent'],
        keys: ['cate', 'parent']
      },
      url: 'ajax.json'
    }
  },
},
```

上述例子会使用 `ajax.json?zipcode={:value}&cate={:cate}&parent={:parent}` 形式的 URL 进行验证。

URL 中的 `zipcode` 参数由 `key` 对象定义。

`attach` 对象为附加查询，其中：

* `selectors` 定义的为表单选择器
* `keys` 定义的为参数名

他们会以 `{:参数名}={:选择器的值}` 的形式附加到 URL 中。
