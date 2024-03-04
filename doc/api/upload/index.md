## ginkgo\Upload

文件上传处理

----------

### 类摘要

```php
namespace ginkgo;

use ginkgo\common\File_Sys;

class Upload extends File_Sys {
  // 属性
  public $config    = array();
  public $limitSize = 0;

  protected static $instance;

  private $configThis     = array(
    'limit_size'    => 200,
    'limit_unit'    => 'kb',
  );

  // 继承的属性
  public $mimeRows = array();
  public $error;
  public $rule = 'md5';

  public $fileInfo = array(
    'name'      => '',
    'tmp_name'  => '',
    'ext'       => '',
    'mime'      => '',
    'size'      => 0,
  );

  protected $obj_file;

  // 方法
  public static instance( [ array $config ] ) : object
  public config( array $config )
  public create( string $name ) : mixed
  public limit( [ mixed $size = false ] ) : int
  public move( string $dir [, $name = true [, $replace = true ]] ) : mixed

  protected __construct( array $config ) : object
  protected __clone()

  private errorProcess( int $error_no )

  // 继承的方法
  public rule( string $rule )
  public getMime( string $path [, $mime = false ] ) : string
  public getExt( string $path [, $mime = false ] ) : string
  public getInfo( [ string $name ] ) : mixed
  public getError() : string
  public setMime( mixed $mime [, array $value ] )

  protected verifyFile( string $ext [, string $mime ] ) : bool
  protected genFilename( [ bool $name = true ] ) : string
  protected errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| [`$config`](#$config) | public | array | 配置 |
| `$limitSize` | public | int | 允许上传大小 |
| `$instance` | protected | object static | 本类实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| 继承的属性 | - | - | `0.3.0` 迁移至 ginkgo\common\File_Sys |
| `$mimeRows` | public | array | MIME 池 |
| `$error` | public | string | 错误 |
| `$rule` | public | string | 生成文件名规则（函数名） |
| `$fileInfo` | public | array | 默认 $_FILES 结构 |
| [`$obj_file`](../file/index.md) | protected | object | 文件对象 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [create()](#create()) | public | | 创建上传对象 |
| [limit()](#limit()) | public | | 设置、获取大小限制 |
| [move()](#move()) | public | | 移动文件 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [errorProcess()](#errorProcess()) | private | | 错误处理 |
| 继承的方法 | - | - | `0.3.0` 迁移至 ginkgo\common\File_Sys |
| [rule()](../common/common_file_sys.md#rule()) | public | | 设置 MIME |
| [getMime()](../common/common_file_sys.md#getMime()) | public | | 获取文件的 MIME 类型 |
| [getExt()](../common/common_file_sys.md#getExt()) | public | | 获取文件的扩展名 |
| [getInfo()](../common/common_file_sys.md#getInfo()) | public | | 获取文件信息 |
| [getError()](../common/common_file_sys.md#getError()) | public | | 获取错误 |
| [setMime()](../common/common_file_sys.md#setMime()) | public | | 设置生成文件名规则（函数名） |
| [genFilename()](../common/common_file_sys.md#genFilename()) | protected | | 生成文件名 |
| [verifyFile()](../common/common_file_sys.md#verifyFile()) | protected | | 验证是否为允许的文件 |
| [errRecord()](../common/common_file_sys.md#errRecord()) | protected | | 记录错误，`0.2.4` 新增 |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

`0.2.0` 新增

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| limit_size | int | 200 | 允许上传大小 |
| limit_unit | string | kb | 允许上传单位 |

----------

<span id="config()"></span>

#### `config()` 配置

`0.2.0` 新增

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="create()"></span>

#### `create()` 创建上传对象

``` php
public function create( string $name ) : mixed
```

参数

* `name` 上传 file 类型表单的名称

返回

* 成功则返回文件信息，失败返回 false

----------

<span id="limit()"></span>

#### `limit()` 设置、获取大小限制

``` php
public function limit( [ mixed $size = false ] ) : int
```

参数

* `size` 文件大小尺寸

    为空时返回大小，否则设置大小

返回

* 大小尺寸

----------

<span id="move()"></span>

#### `move()` 移动文件

``` php
public function move( string $dir [, $name = true [, $replace = true ]] ) : mixed
```

参数

* `dir` 指定目录
* `name` 文件名，true 为自动生成, false 为原始文件名, 字符串为指定文件名
* `replace` 是否覆盖

返回

* 成功返回文件路径，失败返回 false

----------

<span id="errorProcess()"></span>

#### `errorProcess()` 错误处理

``` php
private function errorProcess( int $error_no )
```

参数

* `error_no` 错误号

返回

* 无
