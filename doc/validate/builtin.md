## 内置规则

系统内置了一些常用的验证规则，可以满足大部分的验证需求，包括：

* [常规验证](#common)
* [长度和区间验证](#length)
* [属性比较](#comparison)
* [格式验证](#format)
* [特殊格式验证](#special)
* [filter 验证](#filter)
* [正则验证](#regex)

----------

<span id="common"></span>

#### 常规验证

> require

验证某个属性必须，例如：

``` php
$rule = array(
  'name' => array(
    'require' => true,
  ),
);
```

> accepted

验证某个属性是否为为 yes, on, 或是 1。这在确认 "服务条款" 是否同意时很有用，例如：

``` php
$rule = array(
  'name' => array(
    'accepted' => true,
  ),
);
```

----------

<span id="length"></span>

#### 长度和区间验证

> in

验证某个属性的值是否在某个范围，例如：

``` php
$rule = array(
  'name' => array(
    'in' => '1,2,3',
  ),
);
```

> not_in

验证某个属性的值不在某个范围，例如：

``` php
$rule = array(
  'name' => array(
    'not_in' => '1,2,3',
  ),
);
```

> between

验证某个属性的值是否在某个区间，例如：

``` php
$rule = array(
  'name' => array(
    'between' => '25,60',
  ),
);
```

> not_between

验证某个属性的值不在某个区间，例如：

``` php
$rule = array(
  'name' => array(
    'not_between' => '20,30',
  ),
);
```

> length

验证某个属性的值的长度是否在某个范围，例如：

``` php
$rule = array(
  'name' => array(
    'length' => '4,25',
  ),
);
```

> min

验证某个属性的值的最小长度，例如：

``` php
$rule = array(
  'name' => array(
    'min' => 4,
  ),
);
```

> max

验证某个属性的值的最大长度，例如：

``` php
$rule = array(
  'name' => array(
    'max' => 25,
  ),
);
```

> after

验证某个属性的值是否在某个日期之后，例如：

``` php
$rule = array(
  'name' => array(
    'after' => '2016-3-18',
  ),
);
```

> before

验证某个属性的值是否在某个日期之前，例如：

``` php
$rule = array(
  'name' => array(
    'before' => '2016-3-18',
  ),
);
```

> expire

验证某个属性是否在某个有效日期之内，例如：

``` php
$rule = array(
  'name' => array(
    'expire' => '2016-2-1,2016-10-01',
  ),
);
```

----------

<span id="comparison"></span>

#### 属性比较

> confirm

验证某个属性是否和另外一个属性的值一致，例如：

``` php
$rule = array(
  'password' => array(
    'require' => true,
  ),
  'password_confirm' => array(
    'confirm' => true,
  ),
);
```

系统会自动验证 password_confirm 与 password 是否一致。

该规则是自动验证的，只要在需要验证的属性名后加上 <kdb>_confirm</kbd>，也可以指定需要验证的属性名，例如：

``` php
$rule = array(
  'password' => array(
    'require' => true,
  ),
  'repassword' => array(
    'confirm' => 'password',
  ),
);
```

> different

验证某个属性是否和另外一个属性的值不一致，例如：

``` php
$rule = array(
  'account' => array(
    'require' => true,
  ),
  'account_different' => array(
    'different' => true,
  ),
);
```

该规则与 confirm 类似，只要在需要验证的属性名后加上 <kdb>_different</kbd>，也可以指定需要验证的属性名，例如：

``` php
$rule = array(
  'account' => array(
    'require' => true,
  ),
  'reaccount' => array(
    'different' => 'account',
  ),
);
```

> gt 或 &gt;

验证是否大于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'gt' => 100,
  ),
  'num' => array(
    '>' => 100,
  ),
);
```

> egt 或 >=

验证是否大于等于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'egt' => 100,
  ),
  'num' => array(
    '>=' => 100,
  ),
);
```

> lt 或 &lt;

验证是否小于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'lt' => 100,
  ),
  'num' => array(
    '<' => 100,
  ),
);
```

> elt 或 <=

验证是否小于等于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'elt' => 100,
  ),
  'num' => array(
    '<=' => 100,
  ),
);
```

> eq、= 或 same

验证是否等于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'eq' => 100,
  ),
  'num' => array(
    '=' => 100,
  ),
  'num' => array(
    'same' => 100,
  ),
);
```

> neq、&lt;&gt; 或 !=

验证是否不等于某个值，例如：

``` php
$rule = array(
  'score' => array(
    'neq' => 100,
  ),
  'num' => array(
    '<>' => 100,
  ),
  'num' => array(
    '!=' => 100,
  ),
);
```

----------

<span id="format"></span>

#### 格式验证

格式验证只需设置 format 参数

``` php
$rule = array(
  'name' => array(
    'format' => 'number',
  ),
);
```

format 参数可选如下值

| 值 | 描述 | 备注 |
| - | - | - |
| number | 纯数字 | 不包含负数和小数点 |
| int | 整数 | |
| float | 浮点数 | |
| bool | 布尔值 | |
| email | Email | |
| array | 数组 | |
| date | 有效日期 | |
| time | 有效时间 | 会对值进行 `strtotime` 后判断 |
| date_time | 有效日期时间 | 会对值进行 `strtotime` 后判断 |
| alpha | 字母 | |
| alpha_number | 字母与纯数字 | |
| alpha_dash | 字母、数字、连字符（<kbd>-</kbd>）与下划线（<kbd>_</kbd>） | |
| chs | 中文 | |
| chs_alpha | 中文与字母 | |
| chs_alpha_number | 中文、字母与纯数字 | |
| chs_dash | 中文、字母、数字、连字符（<kbd>-</kbd>）与下划线（<kbd>_</kbd>） | |
| url | URL 地址 | |
| ip | IP 地址 | 含 `IPv4` 与 `IPv6` |

----------

<span id="special"></span>

#### 特殊格式验证

以下规则为验证值是否为指定的格式，如：

假设规则为 `Y-m-d`

表单输入值为 `2019-05-06` 时，验证通过

表单输入值为 `19-05-06` 或 `May. 6, 2019` 验证不通过

> date_format

验证某个属性的值是否为指定格式的日期，例如：

``` php
$rule = array(
  'create_time' => array(
    'date_format' => 'Y-m-d',
  ),
);
```

> time_format

验证某个属性的值是否为指定格式的时间，例如：

``` php
$rule = array(
  'create_time' => array(
    'time_format' => 'H:i:s',
  ),
);
```

> date_time_format

验证某个属性的值是否为指定格式的日期时间，例如：

``` php
$rule = array(
  'create_time' => array(
    'date_time_format' => 'Y-m-d H:i:s',
  ),
);
```

----------

<span id="filter"></span>

#### filter 验证

支持使用 `filter_var` 进行验证，例如：

``` php
$rule = array(
  'ip' => array(
    'filter' => FILTER_VALIDATE_IP,
  ),
);
```

----------

<span id="regex"></span>

#### 正则验证

支持直接使用正则验证，例如：

``` php
$rule = array(
  'zip' => array(
    'regex' => '\d{6}',
  ),
);
```
