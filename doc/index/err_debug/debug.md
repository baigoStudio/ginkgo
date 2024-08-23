## 调试模式

ginkgo 有专门为开发过程而设置的调试模式，开启调试模式后，会牺牲一定的效率，但带来的方便和除错功能非常值得。

> 强烈建议在开发阶段始终开启调试模式，方便及时发现、解决问题。

调试模式默认是关闭的，可以修改配置文件开启调试模式。

``` php
'debug' => array( //调试
  'dump'  => true,
  'tag'   => 'div', //调试信息包含在标签内
  'class' => 'container p-5', //调试信息包含标签的 css 类名
),
```