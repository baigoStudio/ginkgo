## 聚合查询

可以在模型类中直接调用数据库方法，无需实例化数据库类。

| 方法 | 参数 | 描述 |
| - | - |
| count | 可选，统计的字段名 | 统计数量 |
| max | 必须，统计的字段名 | 求最大值 |
| min | 必须，统计的字段名 | 求最小值 |
| avg | 必须，统计的字段名 | 求平均值 |
| sum | 必须，统计的字段名 | 求和 |

----------

用法示例：

获取用户数：

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

    function count() {        
        return $this->count();
    }

}
```

或者根据字段统计：

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

    function count($field) {        
        return $this->count($field);
    }

}
```

> 详细使用方法请查看 [数据库 -> 聚合查询](../database/aggregate.md)。
