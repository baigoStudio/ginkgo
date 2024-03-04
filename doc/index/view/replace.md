## 输出替换

支持对视图输出的内容进行替换，例如：

``` php
namespace app\ctrl\index;

use ginkgo\Ctrl;
use ginkgo\View;

class Index extends Ctrl {

  public function index() {
    $view = View::instance();

    // 单个设置
    $view->setReplace('name', 'ginkgo');
    $view->setReplace('email', 'ginkgo@qq.com');

    // 批量设置
    $replace = array(
      'name'  => 'ginkgo',
      'email' => 'ginkgo@qq.com',
    );

    $view->setReplace($replace);

    return $this->fetch();
  }

}
```

模板中就可以使用 `{:变量名}` 的形式来输出值，如：

``` markup
<div>{:name}</div>
<div>{:email}</div>
```

以下为默认的输出替换

| 名称 | 描述 | 备注 |
| - | - | - |
| {\:URL_BASE} | 当前 URL 地址，不含 QUERY_STRING，包含域名。 | |
| {\:URL_ROOT} | 当前 URL 根目录，包含域名。 | |
| {\:DIR_ROOT} | 根目录 | `0.1.1` 新增 |
| {\:DIR_STATIC} | 静态文件目录 | |
| {\:ROUTE_ROOT} | 根路径 | |
| {\:ROUTE_PAGE} | 分页用的基本路径 | |

> 与 `响应 -> 输出替换` 不同的是，视图输出替换只对 `{:变量名}` 形式的字符有效，而响应输出替换对所有字符有效。
