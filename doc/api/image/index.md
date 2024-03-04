## ginkgo\Image

图片处理

----------

### 类摘要

```php
namespace ginkgo;

use ginkgo\common\File_Sys;

class Image extends File_Sys {
  // 属性
  public $quality = 90;
  public $thumbs  = array();
  public $infoDst = array();

  public $fileInfo = array(
    'width'    => 0,
    'height'   => 0,
    'name'     => '',
    'ext'      => '',
    'mime'     => '',
    'path'     => '',
  );

  protected static $instance;

  private $mimeRowsThis = array(
    'gif' => array(
      'image/gif',
    ),
    'jpg' => array(
      'image/jpeg',
      'image/pjpeg'
    ),
    'jpeg' => array(
      'image/jpeg',
      'image/pjpeg'
    ),
    'jpe' => array(
      'image/jpeg',
      'image/pjpeg'
    ),
    'png' => array(
      'image/png',
      'image/x-png'
    ),
    'bmp' => array(
      'image/bmp',
      'image/ms-bmp',
      'image/x-bmp',
      'image/x-bitmap',
      'image/x-xbitmap',
      'image/x-win-bitmap',
      'image/x-windows-bmp',
      'image/x-ms-bmp',
      'application/bmp',
      'application/x-bmp',
      'application/x-win-bitmap'
    ),
  );

  private $res_imgSrc;
  private $res_imgDst;
  private $imageExts;

  // 继承的属性
  public $mimeRows = array();
  public $error;
  public $rule = 'md5';

  protected $obj_file;

  // 方法
  public static instance( [ array $mimeRows ] ) : object
  public config( array $mimeRows )
  public open( string $path ) : mixed
  public stamp( string $stamp [, array $font [, mixed $size = false [, mixed $posi = false [, int $angle = 0 [, int $pct = 100 ]]]]] ) : object
  public crop( int $width, int $height [, int $x_src = 0 [, int $y_src = 0 [, mixed $width_src = false [, mixed $height_src = false ]]]] ) : object
  public thumb( [ int $width = 100 [, int $height = 100 [, string $type = 'ratio' ]]] ) : object
  public output( [ mixed $path = null [, mixed $mime = false [, mixed $quality = false [, int $interlace = 1 ]]]] ) : bool
  public save( [ mixed $dir = false [, mixed $name = false [, mixed $quality = false [, int $interlace = 1 ]]]] ) : bool
  public batThumb( array $thumbRows ) : bool
  public getThumbs() : array

  protected __construct( [ array $mimeRows ] ) : object
  protected __clone()

  protected verifyFile( string $ext [, string $mime ] ) : bool

  private openProcess( string $path ) : mixed
  private createImgBg( int $width, int $height [, mixed $mime = false [, bool $transparent = true [, bool $savealpha = true ]]] ) : mixed
  private imgSizeProcess( string $path ) : array
  private txtStampInit( array $font, string $string ) : array
  private stampSizeProcess( array $size, array $stamp ) : array
  private stampPosiProcess( array $posi, resouce $imgDst ) : array
  private colorProcess( mixed $color ) : array
  private rgbProcess( array $color ) : array
  private genFilename( [ bool $name = true ] ) : string
  private dstProcess( string $path [, string $width = '' [, string $height = '' [, string $type = '' ]]] ) : array
  private thumbSizeProcess( int $width_dst, int $height_dst [, string $type = 'ratio' ] ) : array
  private ptToPx( int $pt ) : int
  private fontProcess() : string

  // 继承的方法
  public rule( string $rule )
  public getMime( string $path [, $mime = false ] ) : string
  public getExt( string $path [, $mime = false ] ) : string
  public getInfo( [ string $name ] ) : mixed
  public getError() : string
  public setMime( mixed $mime [, array $value ] )

  protected genFilename( [ bool $name = true ] ) : string
  protected errRecord( string $msg ) // since 0.2.4
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$thumbs` | public | array | 缩略图 |
| [`$fileInfo`](#$fileInfo) | public | array | 原始图片信息 |
| `$infoDst` | public | array | 目的图片信息 |
| `$instance` | protected | object static | 本类实例 |
| `$mimeRowsThis` | private | array | 默认图片 MIME |
| `$res_imgSrc` | private | resource | 原始图片资源 |
| `$res_imgDst` | private | resource | 目的图片资源 |
| `$imageExts` | private | array | 图片扩展名 |
| 继承的属性 | - | - | `0.3.0` 迁移至 ginkgo\common\File_Sys |
| `$mimeRows` | public | array | MIME 池 |
| `$error` | public | string | 错误 |
| `$rule` | public | string | 生成文件名规则（函数名） |
| [`$obj_file`](../file/index.md) | protected | object | 文件对象 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [config()](#config()) | public | | 配置 |
| [open()](#open()) | public | | 打开一个图片文件 |
| [stamp()](#stamp()) | public | | 水印 |
| [crop()](#crop()) | public | | 裁切图片 |
| [thumb()](#thumb()) | public | | 生成缩略图 |
| [output()](#output()) | public | | 输出图片 |
| [save()](#save()) | public | | 保存图片 |
| [batThumb()](#batThumb()) | public | | 批量生成缩略图 |
| [getThumbs()](#getThumbs()) | public | | 获取缩略图 |
| [getMime()](#getMime()) | public | | 获取 MIME 类型 |
| [getExt()](#getExt()) | public | | 获取扩展名 |
| [getInfo()](#getInfo()) | public | | 获取文件信息 |
| [getError()](#getError()) | public | | 获取错误 |
| [rule()](#rule()) | public | | 设置生成文件名规则 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [verifyFile()](#verifyFile()) | protected | | 验证是否为允许的文件 |
| [openProcess()](#openProcess()) | private | | 打开图片处理 |
| [createImgBg()](#createImgBg()) | private | | 创建图片背景 |
| [imgSizeProcess()](#imgSizeProcess()) | private | | 图片类型检测处理 |
| [txtStampInit()](#txtStampInit()) | private | | 文字水印初始化 |
| [stampSizeProcess()](#stampSizeProcess()) | private | | 水印尺寸处理 |
| [stampPosiProcess()](#stampPosiProcess()) | private | | 水印位置处理 |
| [colorProcess()](#colorProcess()) | private | | 颜色处理 |
| [rgbProcess()](#rgbProcess()) | private | | RGB 处理 |
| [dstProcess()](#dstProcess()) | private | | 目的处理 |
| [thumbSizeProcess()](#thumbSizeProcess()) | private | | 缩略图尺寸处理 |
| [ptToPx()](#ptToPx()) | private | | PT 转 PX |
| [fontProcess()](#fontProcess()) | private | | 随机获取字体文件 |
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

<span id="$fileInfo"></span>

#### `$fileInfo` 原始图片信息

``` php
public $fileInfo;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| name | string | | 原始文件名 |
| ext | string | | 扩展名 |
| mime | string | | MIME |
| width | int | 0 | 宽度 |
| height | int | 0 | 高度 |
| path | string | | 路径 |

----------

<span id="instance()"></span>

#### `instance()` 实例化方法

``` php
public static function instance() : object
```

参数

* 无

返回

* 本类的实例

----------

<span id="config()"></span>

#### `config()` 配置

``` php
public function config( array $mimeRows )
```

参数

* `mimeRows` 图片 MIME

返回

* 无

----------

<span id="open()"></span>

#### `open()` 打开一个图片文件

``` php
public function open( string $path ) : mixed
```

参数

* `path` 路径

返回

* 成功返回图片信息和资源，失败返回 false

----------

<span id="stamp()"></span>

#### `stamp()` 水印

``` php
public function stamp( string $stamp [, array $font [, mixed $size = false [, mixed $posi = false [, int $angle = 0 [, int $pct = 100 ]]]]] ) : object
```

参数

* `stamp` 文字或水印图片路径，

    当本参数为路径且图片文件不存在，或 `font` 参数不为空时代表文字水印

* [`font`](#txtStampInit()) 字体
* [`size`](#stampSizeProcess()) 水印尺寸
* [`posi`](#stampPosiProcess()) 水印位置
* `angle` 水印旋转角度，0 - 360 之间
* `pct` 水印透明度，0 - 100 之间，0 代表透明，100 代表不透明

返回

* 本类的实例

----------

<span id="crop()"></span>

#### `crop()` 裁切图片

``` php
public function crop( int $width, int $height [, int $x_src = 0 [, int $y_src = 0 [, mixed $width_src = false [, mixed $height_src = false ]]]] ) : object
```

参数

* `width` 目的宽度
* `height` 目的高度
* `x_src` 原始图片的 x 点
* `y_src` 原始图片的 y 点
* `width_src` 源宽度
* `height_src` 源高度

返回

* 本类的实例

----------

<span id="thumb()"></span>

#### `thumb()` 生成缩略图

``` php
public function thumb( [ int $width = 100 [, int $height = 100 [, string $type = 'ratio' ]]] ) : object
```

参数

* `width` 目的宽度
* `height` 目的高度
* `type` ratio 代表按比例缩小，crop 代表裁切

返回

* 本类的实例

----------

<span id="output()"></span>

#### `output()` 输出图片

``` php
public function output( [ mixed $path = null [, mixed $mime = false [, mixed $quality = false [, int $interlace = 1 ]]]] ) : bool
```

参数

* `path` 路径，为 null 是代表直接输出
* `mime` 生成图片 MIME 类型，为 false 代表根据源图生成
* `quality` 图片质量，0 - 100 之间，仅对 jpg 和 png 有效，数字越大质量越好
* `interlace` jpg 隔行扫描

返回

* 输出是否成功

----------

<span id="save()"></span>

#### `save()` 保存图片

``` php
public function save( [ $path = false [, $name = false [, $type = false [, $quality = 90 [, $interlace = true ]]]]] ) : bool // 0.2.0 前
public function save( [ $path = false [, $name = false [, $quality = 90 [, $interlace = true ]]]] ) : bool // 0.2.0 及以后
```

参数

* `path` 保存目录

  此参数为 false 时，与原图片同目录。

* `name` 文件名

  此参数为 false 时，系统会自动生成。

* `type` 保存类型 `0.2.0` 弃用

  如 `name` 参数指定了扩展名，则系统将按照扩展名类型保存，此参数自动失效。

  可能的值

  | 值 | 描述 |
  | - | - |
  | false（默认值） | 系原图片相同 |
  | jpe | JPG 图片 |
  | jpg | JPG 图片 |
  | jpeg | JPG 图片 |
  | pjpeg | JPG 图片 |
  | gif | GIF 图片 |
  | png | PNG 图片 |
  | x-png | PNG 图片 |
  | bmp | BMP 图片 |
  | x-ms-bmp | BMP 图片 |
  | x-windows-bmp | BMP 图片 |

* `quality` 图片质量

  仅对 JPG 有效，默认为 90

* `interlace` 是否设置隔行扫描

  仅对 JPG 有效，默认为 true

  > 设置隔行扫描的情况下，浏览时是从上到下逐行显示，否则图片是由模糊到清晰整个显示。

返回

* 布尔值

----------

<span id="batThumb()"></span>

#### `batThumb()` 批量生成缩略图

> 批量生成缩略图会自动调用 `save()` 方法。

``` php
public function batThumb( array $thumbRows ) : bool
```

参数

* `thumbRows` 缩略图列表，例如：

  ``` php
  $thumbRows = array(
    array(
      'thumb_width'   => 100,
      'thumb_height'  => 100,
      'thumb_type'    => 'ratio',
    ),
    array(
      'thumb_width'   => 150,
      'thumb_height'  => 200,
      'thumb_type'    => 'crop',
    ),
  );
  ```

返回

* 布尔值

----------

<span id="getThumbs()"></span>

#### `getThumbs()` 获取缩略图

``` php
public function getThumbs() : array
```

参数

* 无

返回

* 批量生成的缩略图列表

----------

<span id="openProcess()"></span>

#### `openProcess()` 打开图片处理

``` php
private function openProcess( string $path ) : mixed
```

参数

* `path` 图片路径

返回

* 成功返回图片信息和资源，失败返回 false

----------

<span id="createImgBg()"></span>

#### `createImgBg()` 创建图片背景

``` php
private function createImgBg( int $width, int $height [, mixed $mime = false [, bool $transparent = true [, bool $savealpha = true ]]] ) : mixed
```

参数

* `width` 目的宽度
* `height` 目的高度
* `mime` 生成图片 MIME 类型，为 false 代表根据源图生成
* `transparent` 是否设为透明背景，仅对 png 与 gif 有效
* `savealpha` 是否保留 Alpha 通道，仅对 png 有效

返回

* 图片资源

----------

<span id="verifyFile()"></span>

#### `verifyFile()` 验证是否为允许的文件

``` php
private function verifyFile( string $ext [, string $mime ] ) : bool
```

参数

* `ext` 扩展名
* `mime` MIME

返回

* 布尔值

----------

<span id="imgSizeProcess()"></span>

#### `imgSizeProcess()` 图片类型检测处理

``` php
private function imgSizeProcess( string $path ) : array
```

参数

* `path` 图片路径

返回

* 图片信息，详见 [$fileInfo](#$fileInfo)

----------

<span id="txtStampInit()"></span>

#### `txtStampInit()` 文字水印初始化

``` php
private function txtStampInit( array $font, string $string ) : array
```

参数

* `font` 字体，可以为数字或数组，为数字时代表字号（pt），为数组时结构如下

  | 键名 | 类型 | 描述 |
  | - | - | - |
  | size | int | 字号（pt） |
  | [color](#colorProcess()) | mixed | 颜色 |
  | file | string | 字体文件 |

* `string` 文字内容

返回

* 初始化数组

----------

<span id="stampSizeProcess()"></span>

#### `stampSizeProcess()` 水印尺寸处理

``` php
private function stampSizeProcess( array $size, array $stamp ) : array
```

参数

* `size` 水印尺寸，如为空，系统会根据字号或者水印图片自动计算

  | 键名 | 类型 | 描述 |
  | - | - | - |
  | width | mixed | 水印宽度 |
  | height | mixed | 水印高度 |

* `stamp` 水印初始信息，通常此参数由系统根据字号或者水印图片自动计算

  | 键名 | 类型 | 描述 |
  | - | - | - |
  | width | mixed | 水印宽度 |
  | height | mixed | 水印高度 |

返回

* 尺寸数组

----------

<span id="stampPosiProcess()"></span>

#### `stampPosiProcess()` 水印位置处理

``` php
private function stampPosiProcess( array $posi, resouce $imgDst ) : array
```

参数

* `posi` 水印位置

  可以为字符串、数字、或数组

  * 字符串例子：<kbd>lt</kbd> 左上、<kbd>rt</kbd> 右上、<kbd>lb</kbd> 左下、<kbd>rb</kbd> 右下
  * 数字：<kbd>10</kbd> 离上边和左边各 10px、<kbd>-10</kbd> 离右边和下边各 10px
  * 数组：`array(10,10)` 离上边和左边各 10px、`array(-10,-10)` 离右边和下边各 10px、`array(10,-10)` 离上边和右边各 10px、`array('x' => 10, 'y' => 10)` 离上边和左边各 10px

* `imgDst` 目标图片资源

返回

* 位置数组

----------

<span id="colorProcess()"></span>

#### `colorProcess()` 颜色处理

``` php
private function colorProcess( mixed $color ) : array
```

参数

* `color` 颜色值

  可以为字符串或数组，以下例子均代表白色

  * 字符串例子：<kbd>rgb(255,255,255)</kbd>、<kbd>(255,255,255)</kbd>、<kbd>255,255,255</kbd>、<kbd>#FFFFFF</kbd>、<kbd>FFFFFF</kbd>
  * 数组例子：`array(255,255,255)`、`array(0xFF,0xFF,0xFF)`

返回

* 颜色 RGB 数组

----------

<span id="rgbProcess()"></span>

#### `rgbProcess()` RGB 处理

``` php
private function rgbProcess( array $color ) : array
```

参数

* `color` 颜色，必须为数组，以下例子均代表白色

  `array(255,255,255)`、`array(0xFF,0xFF,0xFF)`

返回

* 颜色 RGB 数组

----------

<span id="dstProcess()"></span>

#### `dstProcess()` 目的处理

``` php
private function dstProcess( string $path [, string $width = '' [, string $height = '' [, string $type = '' ]]] ) : array
```

参数

* `path` 路径
* `width` 宽度
* `height` 高度
* `type` ratio 代表按比例缩小，crop 代表裁切

返回

* 目的数组

----------

<span id="thumbSizeProcess()"></span>

#### `thumbSizeProcess()` 缩略图尺寸处理

``` php
private function thumbSizeProcess( int $width_dst, int $height_dst [, string $type = 'ratio' ] ) : array
```

参数

* `width_dst` 目的宽度
* `height_dst` 目的高度
* `type` ratio 代表按比例缩小，crop 代表裁切

返回

* 缩略图数组

----------

<span id="ptToPx()"></span>

#### `ptToPx()` PT 转 PX

``` php
private function ptToPx( int $pt ) : int
```

参数

* `pt` 字号（pt）

返回

* 字号（px）

----------

<span id="fontProcess()"></span>

#### `fontProcess()` 随机获取字体文件

``` php
private function fontProcess() : string
```

参数

* 无

返回

* 随机返回字体文件路径
