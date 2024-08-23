## 直接验证

如果需要使用内置的规则验证单个数据，可以使用直接验证的方式。

``` php
$validate = Validate::instance();

// 验证是否在某个范围
$validate->in('a', 'a,b,c'); // true
// 验证不在某个范围
$validate->notIn('a', 'a,b,c'); // false
// 验证是否大于某个值
$validate->gt(10, 8); // true
// 正则验证
$validate->regex(100, '\d+'); // true
```

----------

#### 格式验证

``` php
// 验证是否有效的日期
$validate->is('date', '2016-06-03'); // true
// 验证是否有效邮箱地址
$validate->is('email', 'ginkgo@ginkgo'); // true
```

----------

#### 特殊格式验证

``` php
// 日期格式验证
$validate->dateFormat('2016-03-09', 'Y-m-d'); // true
// 时间格式验证
$validate->timeFormat('16:45:12', 'H:i:s'); // true
// 日期时间格式验证
$validate->dateTimeFormat('2016-03-09 16:45:12', 'Y-m-d H:i:s'); // true
```

> 注意：更多验证规则请查看 [内置规则](builtin.md)。

利用内置规则进行直接验证时，应将方法名改为 驼峰法（首字母小写），如：

``` php
$validate->notIn('a', 'a,b,c'); // false
```
