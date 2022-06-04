## CURD

可以在模型类中直接调用数据库方法，无需实例化数据库类。

----------

#### 查询数据

查询一条数据：

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

  function read($id) {
    $user = $this->where('id', '=', $id)->find();
  }

}
```

查询数据集使用：

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

  function lists($status) {
    $select = array(
      'user_id',
      'user_name',
    );
    $users = $this->where('status', '=', $status)->select($select);
  }
}
```

详细使用方法请查看 [数据库 -> CURD](../database/curd.md)。

----------

#### 添加数据

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

  function insert() {
    $data = array(
      'foo' => 'bar',
      'bar' => 'foo',
    );
    $userId = $this->insert($data);
  }

}
```

详细使用方法请查看 [数据库 -> CURD](../database/curd.md)。

----------

#### 更新数据

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

  function update($id) {
    $data = array(
      'foo' => 'bar',
      'bar' => 'foo',
    );
    $count = $this->where('id', '=', $id)->update($data);
  }

}
```

详细使用方法请查看 [数据库 -> CURD](../database/curd.md)。

----------

#### 删除数据

``` php
namespace app\model\index;

use ginkgo\Model;

class Index extends Model {

  function delete($id) {
    $count = $this->where('id', '=', $id)->delete();
  }

}
```

详细使用方法请查看 [数据库 -> CURD](../database/curd.md)。
