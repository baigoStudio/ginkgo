## ginkgo\Ubbcode

`0.1.1` 由 `Func::ubbcode()` 方法升级而来

Ubbcode

----------

### 类摘要

```php
namespace ginkgo;

class Ubbcode {
  // 属性
  public static $pairRules    = array('strong', 'code', 'del', 'kbd', 'u', 'i', 'blockquote', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');

  public static $singleRules  = array('hr', 'br');

  public static $replaceRules = array(
    'quote' => 'blockquote',
    'b'     => 'strong',
    'em'    => 'i',
    's'     => 'del',
  );

  public static $regexRules = array(
    '/\[url=([\-A-Za-z0-9+&@#\/%?\=~\_|!:,\.;]+[\-A-Za-z0-9+&@#\/%\=~\_|])\](.+)\[\/url\]/i' => '<a href="$1" target="_blank" title="$1">$2</a>',
    '/\[url\]([\-A-Za-z0-9+&@#\/%?\=~\_|!:,\.;]+[\-A-Za-z0-9+&@#\/%\=~\_|])\[\/url\]/i'      => '<a href="$1" target="_blank">$1</a>',
    '/\[img=([\-A-Za-z0-9+&@#\/%?\=~\_|!:,\.;]+[\-A-Za-z0-9+&@#\/%\=~\_|])\](.+)\[\/img\]/i' => '<img src="$1" alt="$2" title="$2">',
    '/\[img\]([\-A-Za-z0-9+&@#\/%?\=~\_|!:,\.;]+[\-A-Za-z0-9+&@#\/%\=~\_|])\[\/img\]/i'      => '<img src="$1">',
    '/\[color=(\w+)\](.+)\[\/color\]/i'      => '<span style="color:$1">$2</span>',
    '/\[bgcolor=(\w+)\](.+)\[\/bgcolor\]/i'  => '<span style="background-color:$1">$2</span>',
    '/\[size=(\d+)\](\d+)\[\/size\]/i'       => '<span style="font-size:$1">$2</span>',
    '/\[left](.+)\[\/left\]/i'               => '<span style="text-align:left">$1</span>', // since 0.2.4
    '/\[right](.+)\[\/right\]/i'             => '<span style="text-align:right">$1</span>', // since 0.2.4
    '/\[center](.+)\[\/center\]/i'           => '<span style="text-align:center">$1</span>', // since 0.2.4
  );

  public static $nl2br = true;

  // 方法
  public static addPair( mixed $pair )
  public static addSingle( mixed $single )
  public static addReplace( mixed $src [, string $dst ] )
  public static addRegex( mixed $src [, string $dst ] )
  public static stripCode( string $string ) : string
  public static convert( string $string ) : string
  public static getImages( string $string [, mixed $options [, mixed $filter [, mixed $stristr ]]] ) : array
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$pairRules` | public | static | 成对规则 |
| `$singleRules` | public | static | 单独规则 |
| `$replaceRules` | public | static | 替换规则 |
| `$regexRules` | public | static | 正则规则 |
| `$nl2br` | public | static | 是否采用 php 语言中 [`nl2br()`](https://www.php.net/manual/zh/function.nl2br) 函数转换换行符 `0.2.0` 新增 |
| 方法 | - | - | - |
| [addPair()](#addPair()) | public | static | 添加成对规则 |
| [addSingle()](#addSingle()) | public | static | 添加单独规则 |
| [addReplace()](#addReplace()) | public | static | 添加替换规则 |
| [addRegex()](#addRegex()) | public | static | 添加正则规则 |
| [stripCode()](#stripCode()) | public | static | 去除标签 |
| [convert()](#convert()) | public | static | 转换 ubbcode |
| [getImages()](#getImages()) | public | static | 获取图片 |

----------

<span id="addPair()"></span>

#### `addPair()` 添加成对规则

``` php
public static function addPair( mixed $pair )
```

参数

* `pair` 规则，支持两种类型：字符串时、数组，为数组时表示批量添加

返回

*  无

----------

<span id="addSingle()"></span>

#### `addSingle()` 添加单独规则

``` php
public static function addSingle( mixed $single )
```

参数

* `single` 规则，支持两种类型：字符串时、数组，为数组时表示批量添加

返回

*  无

----------

<span id="addReplace()"></span>

#### `addReplace()` 添加替换规则

``` php
public static function addReplace( mixed $replace [, string $dst ] )
```

参数

* `replace` 规则，支持两种类型：字符串时、数组，为数组时表示批量添加
* `dst` 替换目标

    当 `replace` 为字符串时，此参数为必需，为数组时自动忽略。

返回

*  无

----------

<span id="addRegex()"></span>

#### `addRegex()` 添加正则规则

``` php
public static function addRegex( mixed $regex [, string $dst ] )
```

参数

* `regex` 规则，支持两种类型：字符串时、数组，为数组时表示批量添加
* `dst` 替换目标

  当 `regex` 为字符串时，此参数为必需，为数组时自动忽略。

返回

*  无

----------

<span id="stripCode()"></span>

#### `stripCode()` 去除标签

``` php
public static function stripCode( string $string ) : string
```

参数

* `string` 原始字符串

返回

* 处理后的字符串

----------

<span id="convert()"></span>

#### `convert()` 转换 ubbcode

``` php
public static function convert( string $string ) : string
```

参数

* `string` 原始字符串

返回

* 处理后的字符串

----------

<span id="getImages()"></span>

#### `getImages()` 获取图片

``` php
public static function getImages( string $string [, mixed $options [, mixed $filter [, mixed $stristr ]]] ) : array
```

参数

* `string` 原始字符串
* `options` php 语言中 [`pathinfo()`](https://www.php.net/manual/zh/function.pathinfo) 函数的 `options` 参数
* `filter` 过滤参数（过滤包含指定字符的图片），支持两种类型：字符串时、数组，为数组时表示批量
* `include` 包含参数（取出包含指定字符的图片），支持两种类型：字符串时、数组，为数组时表示批量

返回

* 图片路径数组
