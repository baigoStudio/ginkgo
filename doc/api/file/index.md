## ginkgo\File

文件系统

----------

### 类摘要

```php
namespace ginkgo;

class File {
  // 属性
  public $error;
  public $mimeRows = array();
  public $fileInfo = array(
    'name'      => '',
    'tmp_name'  => '',
    'ext'       => '',
    'mime'      => '',
    'size'      => 0,
  );

  protected static $instance;

  // 方法
  public static instance( [ array $config ] ) : object
  public static dirHas( string $path ) : bool
  public static fileHas( string $path ) : bool
  public dirList( string $path [, string $ext ] ) : array
  public dirMk( string $path ) : bool
  public dirCopy( string $src, string $dst ) : bool
  public dirDelete( string $path ) : bool
  public fileRead( string $path ) : string
  public fileMove( string $src, string $dst ) : bool
  public fileWrite( string $path, string $content [, bool $append = false ] ) : int
  public fileCopy( string $src, string $dst ) : bool
  public fileDelete( string $path ) : bool

  protected __construct( [ array $config ] )
  protected __clone()

  private errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$error` | public | string | 错误 |
| `$mimeRows` | public | array | MIME 池 |
| `$instance` | protected | object static | 本类实例 |
| `$fileInfo` | protected | array | 默认 $_FILES 结构 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [dirHas()](#dirHas()) | public | static | 文件夹是否存在 |
| [fileHas()](#fileHas()) | public | static | 文件是否存在 |
| [dirList()](#dirList()) | public | | 列出目录结构 |
| [dirMk()](#dirMk()) | public | | 创建目录 |
| [dirCopy()](#dirCopy()) | public | | 拷贝整个目录 |
| [dirDelete()](#dirDelete()) | public | | 递归删除整个目录 |
| [fileRead()](#fileRead()) | public | | 读取文件 |
| [fileMove()](#fileMove()) | public | | 移动文件（更名） |
| [fileWrite()](#fileWrite()) | public | | 写入文件 |
| [fileCopy()](#fileCopy()) | public | | 复制文件 |
| [fileDelete()](#fileDelete()) | public | | 删除文件 |
| __construct() | protected | | 构造函数，无实际功能，仅供限制为单例模式使用 |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [errRecord()](#errRecord()) | private | | 记录错误，`0.2.4` 新增 |

----------

<span id="$fileInfo"></span>

#### `$fileInfo` 默认 $_FILES 结构

``` php
public $fileInfo;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| name | string | | 原始文件名 |
| tmp_name | string | | 临时文件名 |
| ext | string | | 扩展名 |
| mime | string | | MIME |
| size | int | 0 | 文件大小 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance( [ array $config ] ) : object
```

参数

* `config` 配置参数

返回

* 本类的实例

----------

<span id="dirList()"></span>

#### `dirList()` 列出目录结构

``` php
public function dirList( string $path [, string $ext ] ) : array
```

参数

* `path` 路径
* `ext` 指定扩展名

返回

* 目录列表

----------

<span id="dirMk()"></span>

#### `dirMk()` 创建目录

``` php
public function dirMk( string $path ) : bool
```

参数

* `path` 路径

返回

* 布尔值

----------

<span id="dirCopy()"></span>

#### `dirCopy()` 拷贝整个目录

``` php
public function dirCopy( string $src, string $dst ) : bool
```

参数

* `src` 源路径
* `dst` 目的路径

返回

* 布尔值

----------

<span id="dirDelete()"></span>

#### `dirDelete()` 递归删除整个目录

``` php
public function dirDelete( string $path ) : bool
```

参数

* `path` 路径

返回

* 布尔值

----------

<span id="dirHas()"></span>

#### `dirHas()` 文件夹是否存在

``` php
public static function dirHas( string $path ) : bool
```

参数

* `path` 路径

返回

* 布尔值

----------

<span id="fileRead()"></span>

#### `fileRead()` 读取文件

``` php
public function fileRead( string $path ) : string
```

参数

* `path` 路径

返回

* 文件内容

----------

<span id="fileMove()"></span>

#### `fileMove()` 移动文件（更名）

``` php
public function fileMove( string $src, string $dst ) : bool
```

参数

* `src` 源路径
* `dst` 目的路径

返回

* 布尔值

----------

<span id="fileWrite()"></span>

#### `fileWrite()` 写入文件

``` php
public function fileWrite( string $path, string $content [, bool $append = false ] ) : int
```

参数

* `path` 路径
* `content` 内容
* `append` 是否追加

返回

* 写入字节数

----------

<span id="fileCopy()"></span>

#### `fileCopy()` 写入文件

``` php
public function fileCopy( string $src, string $dst ) : bool
```

参数

* `src` 源路径
* `dst` 目的路径

返回

* 布尔值

----------

<span id="fileDelete()"></span>

#### `fileDelete()` 删除文件

``` php
public function fileDelete( string $path ) : bool
```

参数

* `path` 路径

返回

* 布尔值

----------

<span id="fileHas()"></span>

#### `fileHas()` 文件是否存在

``` php
public static function fileHas( string $path ) : bool
```

参数

* `path` 路径

返回

* 布尔值


----------

<span id="errRecord()"></span>

#### `errRecord()` 记录错误

`0.2.4` 新增

``` php
private function errRecord( string $msg )
```

参数

* #msg 错误信息
