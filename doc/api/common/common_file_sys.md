## ginkgo\common\File_Sys

文件系统抽象类，无法直接实例化

`0.3.0` 新增

----------

### 类摘要

```php
namespace ginkgo\common;

abstract class File_Sys {
  // 属性
  public $mimeRows = array();
  public $error;
  public $rule = 'md5';
  public $config = array();

  public $fileInfo = array(
    'name'     => '',
    'tmp_name' => '',
    'ext'      => '',
    'mime'     => '',
    'size'     => 0,
  );

  // 方法
  public config( array $config )
  public rule( string $rule )
  public getMime( string $path [, $mime = false ] ) : string
  public getExt( string $path [, $mime = false ] ) : string
  public getInfo( [ string $name ] ) : mixed
  public getError() : string
  public setMime( mixed $mime [, array $value ] )

  protected verifyFile( string $ext [, string $mime ] ) : bool
  protected genFilename( [ bool $name = true ] ) : string
  protected errRecord( string $msg )
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$mimeRows` | public | array | MIME 池 |
| `$error` | public | string | 错误 |
| `$rule` | public | string | 生成文件名规则（函数名） |
| `$config` | public | array | 配置 |
| `$fileInfo` | public | array | 文件信息 |
| 方法 | - | - | - |
| [config()](#config()) | public | | 配置 |
| [rule()](#rule()) | public | | 设置 MIME |
| [getMime()](#getMime()) | public | | 获取文件的 MIME 类型 |
| [getExt()](#getExt()) | public | | 获取文件的扩展名 |
| [getInfo()](#getInfo()) | public | | 获取文件信息 |
| [getError()](#getError()) | public | | 获取错误 |
| [setMime()](#setMime()) | public | | 设置生成文件名规则（函数名） |
| [genFilename()](#genFilename()) | protected | | 生成文件名 |
| [verifyFile()](#verifyFile()) | protected | | 验证是否为允许的文件 |
| [errRecord()](#errRecord()) | protected | | 记录错误，`0.2.4` 新增 |

----------

<span id="$config"></span>

#### `$config` 配置

``` php
public $config;
```

结构为空，仅提供兼容

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

<span id="config()"></span>

#### `config()` 配置

仅提供兼容

``` php
public function config( array $config )
```

参数

* [`config`](#$config) 配置参数

返回

* 无

----------

<span id="rule()"></span>

#### `rule()` 获取文件的扩展名

``` php
public function rule( string $rule )
```

参数

* `rule` 生成文件名规则（函数名）

返回

* 无

----------

<span id="getMime()"></span>

#### `getMime()` 获取文件的 MIME 类型

``` php
public function getMime( string $path [, $mime = false ] ) : string
```

参数

* `path` 路径
* `mime` 手动报告类型

返回

* MIME 类型

----------

<span id="getExt()"></span>

#### `getExt()` 获取文件的扩展名

``` php
public function getExt( string $path [, $mime = false ] ) : string
```

参数

* `path` 路径
* `mime` MIME 类型

返回

* MIME 类型

----------

<span id="getInfo()"></span>

#### `getInfo()` 获取文件信息

``` php
public function getInfo( [ string $name ] ) : mixed
```

参数

* `name` 名称

  为空时返回所有信息

返回

* 文件信息

----------

<span id="getError()"></span>

#### `getError()` 获取错误

``` php
protected function getError() : string
```

参数

* 无

返回

* 错误

----------

<span id="setMime()"></span>

#### `setMime()` 获取文件的扩展名

``` php
public function setMime( mixed $mime [, array $value ] )
```

参数

* `mime` MIME 类型

  支持两种类型：为字符串时表示配置名，为数组时表示批量添加

* `value` MIME 值数组

  当 `mime` 为字符串时为必须，当 `mime` 为数组时自动忽略

返回

* 无

----------

<span id="genFilename()"></span>

#### `genFilename()` 获取文件的扩展名

``` php
protected function genFilename( [ bool $name = true ] ) : string
```

参数

* `name` true 时按规则生成文件名，false 时使用原始文件名

返回

* 文件名

----------

<span id="verifyFile()"></span>

#### `verifyFile()` 验证是否为允许的文件

``` php
protected function verifyFile( string $ext [, string $mime ] ) : bool
```

参数

* `ext` 扩展名
* `mime` MIME

返回

* 布尔值


----------

<span id="errRecord()"></span>

#### `errRecord()` 记录错误

``` php
protected function errRecord( string $msg )
```

参数

* #msg 错误信息
