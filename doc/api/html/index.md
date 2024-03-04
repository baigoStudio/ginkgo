## ginkgo\Html

HTML 处理

----------

### 类摘要

```php
namespace ginkgo;

class Html {
  // 属性
  public $html          = '';
  public $tagAllow      = array();
  public $tagIgnore     = array();
  public $tagSingle     = array('meta', 'link', 'base', 'br', 'hr', 'input', 'img'); // since 0.3.1
  public $tagInNest     = array(); // since 0.3.1
  public $attrAllow     = array();
  public $attrExcept    = array();

  protected static $instance;

  // 方法
  public static instance() : object
  public static encode( string $string ) : string
  public static decode( string $string [, string $spec ] ) : string
  public static fillImg( string $content, string $baseUrl ) : string
  public stripTag( string $html ) : string
  public stripAttr( string $html ) : string
  public fixTag( [ string $html = '' [, string $type = 'nest' [, bool $lowerTag = true ]]] ) : string // since 0.3.1
  public setTagAllow( mixed $tag )
  public setTagIgnore( mixed $tag )
  public setAttrAllow( mixed $attr )
  public setAttrExcept( mixed $tag [, mixed $attr ] )

  protected __construct()
  protected __clone()

  private tagAllowProcess() : string
  private findEle() : mixed
  private findAttr( array $nodeRows ) : array
  private removeAttr( array $nodeRows )
  private isAttrExcept( string $ele_name, string $attr_name ) : bool
  private createAttr( string $new_attrs, string $name, string $value ) : string
  private matchTag( string $ele [, $lowerTag = true ] ) : array
  private protect( string $html ) : string
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$html` | public | string | HTML 源代码 |
| [`$tagAllow`](#$tagAllow) | public | array | 允许保留的标签 |
| [`$tagIgnore`](#$tagIgnore) | public | array | 忽略标签 |
| [`$tagSingle`](#$tagSingle) | public | array | 单闭合标签 `0.3.1` 新增 |
| [`$tagInNest`](#$tagInNest) | public | array | 嵌套模式时，需要就近闭合的标签 `0.3.1` 新增 |
| [`$attrAllow`](#$attrAllow) | public | array | 允许保留的属性 |
| [`$attrExcept`](#$attrExcept) | public | array | 特例 |
| [`$instance`] | protected | object static | 本类实例 |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化 |
| [encode()](#encode()) | public | static | HTML 编码 |
| [decode()](#decode()) | public | static | HTML 解码 |
| [fillImg()](#fillImg()) | public | static | 补全 HTML 标签的图片地址部分 |
| [stripTag()](#stripTag()) | public | | 剔除标签 |
| [stripAttr()](#stripAttr()) | public | | 剔除属性 |
| [fixTag()](#fixTag()) | public | | 修复未闭合标签 `0.3.1` 新增 |
| [setTagAllow()](#setTagAllow()) | public | | 设置允许的标签 |
| [setTagIgnore()](#setTagIgnore()) | public | | 设置忽略的标签 |
| [setAttrAllow()](#setAttrAllow()) | public | | 设置允许的属性 |
| [setAttrExcept()](#setAttrExcept()) | public | | 设置特例 |
| __construct() | protected | | 构造函数，无实际功能，仅供限制为单例模式使用 |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [tagAllowProcess()](#tagAllowProcess()) | private | | 处理保留标签 |
| [findEle()](#findEle()) | private | | 搜索需要处理的元素 |
| [findAttr()](#findAttr()) | private | | 搜索属性 |
| [removeAttr()](#removeAttr()) | private | | 移除属性 |
| [isAttrExcept()](#isAttrExcept()) | private | | 判断是否特例 |
| [createAttr()](#createAttr()) | private | | 创建属性 |
| [matchTag()](#matchTag()) | private | | 匹配标签 |
| [protect()](#protect()) | private | | 特殊字符转义 |

----------

<span id="$tagAllow"></span>

#### `$tagAllow` 允许保留的标签

``` php
public $tagAllow;
```

一维数组，例如：

``` php
array('p', 'div');
```

----------

<span id="$tagIgnore"></span>

#### `$tagIgnore` 忽略标签

``` php
public $tagIgnore;
```

一维数组，例如：

``` php
array('span', 'img');
```

----------

<span id="$tagSingle"></span>

#### `$tagSingle` 单闭合标签

``` php
public $tagSingle;
```

一维数组，默认值：

``` php
array('meta', 'link', 'base', 'br', 'hr', 'input', 'img');
```

----------

<span id="$tagInNest"></span>

#### `$tagInNest` 嵌套模式时，需要就近闭合的标签

``` php
public $tagInNest;
```

一维数组，例如：

``` php
array('div', 'p');
```

----------

<span id="$attrAllow"></span>

#### `$attrAllow` 允许保留的属性

``` php
public $attrAllow;
```

一维数组，例如：

``` php
array('id', 'class', 'title')
```

----------

<span id="$attrExcept"></span>

#### `$attrExcept` 特例

``` php
public $attrExcept;
```

二维数组，键名表示标签，值表示属性，例如：

``` php
array(
  'a'    => array('href', 'class'),
  'span' => array('class'),
);
```

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

<span id="encode()"></span>

#### `encode()` HTML 编码

``` php
public static function encode( string $string ) : string
```

参数

* `string` HTML 代码

返回

* 编码后的 HTML

----------

<span id="decode()"></span>

#### `decode()` HTML 解码

``` php
public static function decode( string $string [, string $spec ) : string
```

参数

* `string` 待解码的字符
* `spec` 特殊处理

  可能的值

  | 值 | 描述 |
  | - | - |
  | 空（默认值） | 不作处理 |
  | json 或 json_safe | 转换 json 特殊字符 |
  | url | 转换 url 特殊字符 |
  | selector  | 转换 选择器 特殊字符 |
  | date_time 或 datetime | 转换 日期时间 特殊字符 |
  | rgb | 转换 rgb 值 特殊字符 |

返回

* 解码后的 HTML

----------

<span id="fillImg()"></span>

#### `fillImg()` 补全 HTML 标签的图片地址部分

``` php
public static function fillImg( string $content, string $baseUrl ) : string
```

参数

* `content` HTML 内容
* `baseUrl` 基本路径

返回

* 处理后的 HTML

----------

<span id="stripTag()"></span>

#### `stripTag()` 剔除标签

``` php
public function stripTag( string $html ) : string
```

参数

* `html` HTML 代码

返回

* 处理后的 HTML

----------

<span id="stripAttr()"></span>

#### `stripAttr()` 剔除属性

``` php
public function stripAttr( string $html ) : string
```

参数

* `html` HTML 代码

返回

* 处理后的 HTML

----------

<span id="fixTag()"></span>

#### `fixTag()` 剔除属性

``` php
public function fixTag( [ string $html = '' [, string $type = 'nest' [, bool $lowerTag = true ]]] ) : string
```

参数

* `html` HTML 代码
* `type` 补全模式
* `lowerTag` 是否把 TAG 转为小写

返回

* 处理后的 HTML

----------

<span id="setTagAllow()"></span>

#### `setTagAllow()` 设置允许的标签

``` php
public function setTagAllow( mixed $tag )
```

参数

* [`tag`](#$tagAllow) 标签，字符串或一维数组

返回

* 无

----------

<span id="setTagIgnore()"></span>

#### `setTagIgnore()` 设置忽略的标签

``` php
public function setTagIgnore( mixed $tag )
```

参数

* [`tag`](#$tagIgnore) 标签，字符串或一维数组

返回

* 无

----------

<span id="setAttrAllow()"></span>

#### `setAttrAllow()` 设置允许的属性

``` php
public function setAttrAllow( mixed $attr )
```

参数

* [`attr`](#$attrAllow) 属性，字符串或一维数组

返回

* 无

----------

<span id="setAttrExcept()"></span>

#### `setAttrExcept()` 设置特例

``` php
public function setAttrExcept( mixed $tag [, mixed $attr ] )
```

参数

* `tag` 标签，字符串或数组

  为字符串时表示标签，为数组时，结构参照 [`$attrExcept`](#$attrExcept)

* `attr` 属性 `0.2.0` 新增

  当 `tag` 为字符串时为必须，值可以是字符串或一维数组，当 `tag` 为数组时自动忽略。

返回

* 无

----------

<span id="tagAllowProcess()"></span>

#### `tagAllowProcess()` 处理保留标签

``` php
private function tagAllowProcess() : string
```

参数

* 无

返回

* HTML 元素

----------

<span id="findEle()"></span>

#### `findEle()` 搜索需要处理的元素

``` php
private function findEle() : mixed
```

参数

* 无

返回

* 需要处理的元素

----------

<span id="findAttr()"></span>

#### `findAttr()` 搜索属性

``` php
private function findAttr( array $nodeRows ) : array
```

参数

* `nodeRows` 属性节点

返回

* 属性节点

----------

<span id="removeAttr()"></span>

#### `removeAttr()` 获取文件的扩展名

``` php
private function removeAttr( array $nodeRows )
```

参数

* `nodeRows` 属性节点

返回

* 无

----------

<span id="isAttrExcept()"></span>

#### `isAttrExcept()` 判断是否特例

``` php
private function isAttrExcept( string $ele_name, string $attr_name )
```

参数

* `ele_name` 元素
* `attr_name` 属性

返回

* 布尔值

----------

<span id="createAttr()"></span>

#### `createAttr()` 创建属性

``` php
private function createAttr( string $new_attrs, string $attr, string $value ) : string
```

参数

* `new_attrs` 新属性
* `attr` 属性
* `value` 属性值

返回

* HTML 片段

----------

<span id="matchTag()"></span>

#### `matchTag()` 匹配标签

``` php
private function matchTag( string $ele [, $lowerTag = true ] ) : array
```

参数

* `ele` 元素
* `lowerTag` 是否把 TAG 转为小写

返回

* 匹配结果

  | 键名 | 类型 | 描述 |
  | - | - | - |
  | type | string | 标签类型 |
  | tag_src | string | 原始标签 |
  | tag_dst | string | 根据 `$lowerTag` 参数转换后的标签 |

----------

<span id="protect()"></span>

#### `protect()` 特殊字符转义

``` php
private function protect( string $html ) : string
```

参数

* `html` HTML 代码

返回

* 处理后的 HTML
