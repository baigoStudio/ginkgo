## ginkgo\validate

本目录保存验证规则及其相关的类。

#### 目录结构

```
project 应用部署目录
+-- ginkgo                        框架系统目录
|   +-- validate                  验证相关目录
|   |   +-- rule                  验证规则
|   |   |   +-- gk.class.php  内置规则
|   |   |   +--  ...              可扩展
|   |   |
|   |   +--  ...
|   |
|   +--  rule.class.php           规则基类
|   +--  ...
|
+--  ...
```

#### 扩展验证规则

验证在使用之前，需要进行初始化。可以通过定义配置参数的方式，在配置文件中添加：

``` php
'validate' => array(
  'rule_class' => 'ginkgo', // 验证类型为 ginkgo
  ...
),
```

验证目前只支持 ginkgo 类型，开发者可以自行扩展，扩展的验证规则文件请根据命名空间放置。

扩展的验证规则必须继承 `ginkgo/validate/Rule` 类

`rule_class` 参数支持完整命名空间定义，默认采用 `ginkgo\validate\rule` 作为命名空间，如果使用自己扩展的验证规则，可以配置为：

``` php
'validate' => array(
  'rule_class'   => 'org\validate\Rule',
  ...
);
```

表示采用 `org\validate\Rule` 类作为规则，而不是默认的 `ginkgo\validate\rule\ginkgo`。
