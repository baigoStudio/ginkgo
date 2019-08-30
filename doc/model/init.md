## 模型初始化

模型同样支持初始化，与控制器的初始化类似，可以定义模型初始化方法 `m_init`，具体如下

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

    //自定义初始化
    function m_init() {

    }
}
```
