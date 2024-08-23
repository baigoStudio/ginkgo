## 变量输出

在模板中输出变量的方法很简单，例如，在控制器的动作中给模板变量赋值：

``` php
$this->assign('name', 'ginkgo');
return $this->fetch();
```

然后就可以在模板中使用：

``` php
Hello, <?php echo $name; ?>！
```

运行的时候会显示： Hello, ginkgo！

输出根据变量类型有所区别，刚才输出的是字符串，下面是一个数组的例子：

``` php
$data['name']   = 'ginkgo';
$data['email']  = 'ginkgo@ginkgo';
$this->assign('data', $data);
```

在模板中可以用下面的方式输出：

``` php
Name：<?php echo $data['name']; ?>
Email：<?php echo $data['email']; ?>
```

