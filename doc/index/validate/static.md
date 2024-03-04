## 静态调用

如果需要使用内置的规则验证单个数据，可以使用静态调用的方式。

``` php
// 验证是否在某个范围
Validate::in('a', array('a','b','c')); // true
// 验证不在某个范围
Validate::notIn('a', array('a','b','c')); // true
// 验证是否大于某个值
Validate::gt(10, 8); // true
// 正则验证
Validate::regex(100, '\d+'); // true
```

----------

#### 格式验证

``` php
// 验证是否有效的日期
Validate::is('date', '2016-06-03'); // true
// 验证是否有效邮箱地址
Validate::is('email', 'baigo@qq.com'); // true
```

----------

#### 特殊格式验证

``` php
// 日期格式验证
Validate::dateFormat('2016-03-09', 'Y-m-d'); // true
// 时间格式验证
Validate::timeFormat('16:45:12', 'H:i:s'); // true
// 日期时间格式验证
Validate::dateTimeFormat('2016-03-09 16:45:12', 'Y-m-d H:i:s'); // true
```

> 注意：更多验证规则请查看 [内置规则](builtin.md)。

利用内置规则进行静态调用时，应将方法名改为 驼峰法（首字母小写），如：

``` php
Validate::notIn('a', array('a','b','c')); // true
```
