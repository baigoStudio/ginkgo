## 独立验证

任何时候，都可以使用 `Validate` 类进行独立的验证操作，例如：

``` php
$validate = Validate::instance();

$rule = array(
    'user_id' => array(
        'require' => true,
        'format'  => 'int',
    ),
    'user_name' => array(
        'length' => '1,30',
        'format' => 'alpha_dash',
    ),
);

$validate->rule($rule);

$data = [
    'name'  => 'baigo',
    'email' => 'baigo@qq.com'
];
if (!$validate->verify($data)) {
    print_r($validate->getMessage());
}
```

