## 赋值

如果需要在模板中输出变量，首先必须进行赋值操作，赋值有下面几种方式：

----------

#### `assign()` 方法

```php
namespace app\ctrl\index;

class Index extends ginkgo\Ctrl {

  public function index() {
    // 模板变量赋值
    $this->assign('name', 'ginkgo');
    $this->assign('email', 'ginkgo@ginkgo');

    $data = array(
      'name'  => 'ginkgo',
      'email' => 'ginkgo@ginkgo'
    );
    // 或者批量赋值
    $this->assign($data);

    // 模板输出
    return $this->fetch();
  }

}
```

----------

#### 传入参数方法

`fetch()` 及 `display()` 方法均可传入模版变量，例如

```php
namespace app\ctrl\index;

class Index extends ginkgo\Ctrl {

  public function name() {
    return $this->fetch('name', 'name', 'ginkgo');
  }

  public function email() {
    $data = array(
      'name'  => 'ginkgo',
      'email' => 'ginkgo@ginkgo'
    );

    return $this->fetch('email', $data);
  }

  public function test() {
    return $this->display('test', 'name', 'ginkgo');
  }

  public function abc() {
    $data = array(
      'name'  => 'ginkgo',
      'email' => 'ginkgo@ginkgo'
    );

    return $this->display('abc', $data);
  }

}
```
