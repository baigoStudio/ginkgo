## ginkgo\Captcha

验证码

----------

### 类摘要

```php
namespace ginkgo;

class Captcha {
  // 属性
  public $chars = 'abdefhijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  public $secKey = 'ginkgo';
  public $config = array();

  protected static $instance;

  private $configThis = array(
    'length'    => 4,
    'expire'    => 1800,
    'font_file' => '',
    'font_size' => 20,
    'width'     => 0,
    'height'    => 0,
    'reset'     => true,
    'noise'     => true,
    'shadow'    => array(1, 2),
  );
  private $res_img;

  // 已弃用属性
  public $offset = array(1, 2);

  // 方法
  public static instance( [ array $config ] ) : object
  public create( [ string $id ] ) : object
  public check( [ string $id ] ) : bool

  protected __construct( [ array $config ] ) : object
  protected __clone()

  private createCode()
  private createBg()
  private createFont()
  private createNoise()
  private output() : object
  private authcode( string $str ) : string
  private fontProcess() : string

  // 已弃用方法
  public set( [ int $font_size = 20 [, int $length = 4 ]] )
}
```

----------

### 成员目录

| - | 权限 | 类型 | 描述 |
| - | - | - | - |
| 属性 | - | - | - |
| `$chars` | public | string | 字符池 |
| `$secKey` | public | string | 安全码 |
| [`$config`](#$config) | public | array | 配置 |
| `$instance` | protected | object static | 本类的实例 |
| [`$configThis`](#$config) | private | array | 默认配置 |
| `$captcha` | private | string | 验证码 |
| `$res_img` | private | resource | 图形资源 |
| 已弃用属性 | - | - | - |
| [`$offset`](#$offset) | public | array | 阴影偏移（`0.2.0` 起弃用） |
| 方法 | - | - | - |
| [instance()](#instance()) | public | static | 实例化方法 |
| [config()](#config()) | public | | 配置（`0.2.0` 新增） |
| [create()](#create()) | public | | 对外生成 |
| [check()](#check()) | public | | 验证 |
| __construct() | protected | | 同 [instance()](#instance()) |
| __clone() | protected | | 克隆，无实际功能，仅供限制为单例模式使用 |
| [createCode()](#createCode()) | private | | 生成验证码 |
| [createBg()](#createBg()) | private | | 生成图片及背景 |
| [createFont()](#createFont()) | private | | 生成文字 |
| [createNoise()](#createNoise()) | private | | 加入干扰 |
| [output()](#output()) | private | | 输出 |
| [authcode()](#authcode()) | private | | 加密 |
| [fontProcess()](#fontProcess()) | private | | 随机取得字体文件路径 |
| 已弃用方法 | - | - | - |
| [set()](#set()) | public | | 设置（`0.2.0` 起弃用） |

----------

<span id="$config"></span>

#### `$config` 配置，`$configThis` 默认配置

``` php
public $config;
private $configThis;
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| length | int | 4 | 验证码长度 |
| expire | int | 1800 | 过期时间 |
| font_file | string | | 字体文件的路径 |
| font_size | int | 20 | 字号 |
| width | int | 0 | 图片宽度 |
| height | int | 0 | 图片高度 |
| reset | bool | true | 验证成功后是否重置 |
| noise | bool | true | 是否加入干扰 |
| shadow | array | array(1, 2) | 阴影偏移（`0.2.0` 新增） |

----------

<span id="$offset"></span>

#### `$offset` 阴影偏移

`0.2.0` 起弃用

``` php
public $offset = array(1, 2);
```

结构

| 名称 | 类型 | 默认 | 描述 |
| - | - | - | - |
| 0 | int | 1 | X 轴偏移量（像素） |
| 1 | int | 2 | Y 轴偏移量（像素） |

----------

<span id="instance()"></span>

#### `instance()` 实例化

``` php
public static function instance( [ array $config ] ) : object
```

参数

* [`config`](#$config) 配置参数

返回

* 本类实例

----------

<span id="set()"></span>

#### `set()` 设置

`0.2.0` 起弃用

``` php
public function set( [ int $font_size = 20 [, int $length = 4 ]] )
```

参数

* `font_size` 字号
* `length` 验证码长度

返回

* 无

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

#### `create()` 对外生成

``` php
public function create( [ string $id ] ) : object
```

参数

* `id` 验证码 ID，一般用于多个验证码

返回

* 图片类型的 [ginkgo\Response](../response/index.md) 实例

----------

<span id="check()"></span>

#### `check()` 验证

``` php
public function check( [ string $id ] ) : bool
```

参数

* `id` 验证码 ID，一般用于多个验证码

返回

* 布尔值

----------

<span id="createCode()"></span>

#### `createCode()` 生成验证码

``` php
private function createCode()
```

参数

* 无

返回

* 无

----------

<span id="createBg()"></span>

#### `createBg()` 生成图片及背景

``` php
private function createBg()
```

参数

* 无

返回

* 无

----------

<span id="createFont()"></span>

#### `createFont()` 生成文字

``` php
private function createFont()
```

参数

* 无

返回

* 无

----------

<span id="createNoise()"></span>

#### `createNoise()` 加入干扰

``` php
private function createNoise()
```

参数

* 无

返回

* 无

----------

<span id="output()"></span>

#### `output()` 输出

``` php
private function output() : object
```

参数

* 无

返回

* 图片类型的 [ginkgo\Response](../response/index.md) 实例

----------

<span id="authcode()"></span>

#### `authcode()` 加密

``` php
private function authcode( string $str ) : string
```

参数

* `str` 字符串

返回

* 加密结果

----------

<span id="fontProcess()"></span>

#### `fontProcess()` 随机取得字体文件路径

``` php
private function fontProcess() : string
```

参数

* 无

返回

* 字体文件路径
