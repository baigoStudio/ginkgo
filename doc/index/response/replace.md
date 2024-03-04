## 输出替换

支持对响应输出的内容进行替换，例如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;

class Index extends Ctrl {

  public function index() {
    $json = $this->json()

    // 单个设置
    $json->setReplace('name', 'ginkgo');
    $json->setReplace('email', 'ginkgo@qq.com');

    // 批量设置
    $replace = array(
      'name'  => 'ginkgo',
      'email' => 'ginkgo@qq.com',
    );

    $json->setReplace($replace);

    return $json;
  }

}
```

所有输出数据中的 name、email 都会被替换为 ginkgo 和 ginkgo@qq.com
