## Ubbcode

`0.1.1` 由 `Func::ubbcode()` 方法升级而来

#### `convert()` 转换字符串

使用 `convert()` 方法解析 ubbcode，例如：

``` php
Ubbcode::convert('[b]字符[/b]');
```

上述例子将输出

``` markup
<b>字符</b>
```

默认支持的 UBBCODE，您还可以自行扩展

| 值 | 描述 | 备注 |
| - | - | - |
| [b]content[/b] | 加粗 | |
| [strong]content[/strong] | 加粗 | |
| [em]content[/em] | 斜体 | |
| [i]content[/i] | 斜体 | |
| [u]content[/u] | 下划线 | |
| [code]content[/code] | 代码 | |
| [del]content[/del] | 已被删除的文本 | |
| [s]content[/s] | 已被删除的文本 | `0.1.2` 新增 |
| [kbd]content[/kbd] | 键盘文本 | |
| [hr]| 水平线 | |
| [br] | 换行符 | |
| {:br} | 换行符 | `0.1.1` 弃用 |
| [blockquote]content[/blockquote] | 引用 | `0.1.1` 新增 |
| [quote]content[/quote] | 引用 | `0.1.2` 新增 |
| [url]网址[/url] | 链接 | `0.1.1` 新增 |
| [url=网址]说明[/url] | 链接 | `0.1.1` 新增 |
| [h1]content[/h1] | 标题（h1-h6） | `0.1.2` 新增 |
| [img]图片地址[/img] | 图片 | `0.1.2` 新增 |
| [img=图片地址]说明[/img] | 图片 | `0.1.2` 新增 |
| [color=色值]content[/color] | 文字颜色 | `0.1.2` 新增 |
| [bgcolor=色值]content[/bgcolor] | 背景颜色 | `0.1.2` 新增 |
| [size=字号]content[/size] | 文字大小 | `0.1.2` 新增 |

----------

#### `addPair()` 添加“成对规则”

本方法可以添加“成对规则”，例如：

``` php
// 添加
Ubbcode::addPair('h1');
Ubbcode::addPair('h2');

// 或者批量添加
$rule = array('h1', 'h2');
Ubbcode::addRules($rule);

echo Ubbcode::convert('[h1]大标题[/h1][h2]小标题[/h2]');
```
上述例子将输出

``` markup
<h1>大标题</h1><h2>小标题</h2>
```

----------

#### `addSingle()` 添加“单独规则”

本方法可以添加“单独规则”，例如：

``` php
// 添加
Ubbcode::addSingle('hr');
Ubbcode::addSingle('br');

// 或者批量添加
$rule = array('hr', 'br');
Ubbcode::addSingle($rule);

echo Ubbcode::convert('字符[hr]字符[br]');
```
上述例子将输出

``` markup
字符<hr>字符<br>
```

----------

#### `addReplace()` 添加“替换规则”

本方法可以添加“替换规则”，例如：

``` php
// 添加
Ubbcode::addReplace('head1', 'h1');
Ubbcode::addReplace('head2', 'h2');

// 或者批量添加
$rule = array(
  'head1' => 'h1',
  'head2' => 'h2',
);
Ubbcode::addReplace($rule);

echo Ubbcode::convert('[head1]大标题[/head1][head2]小标题[/head2]');
```
上述例子将输出

``` markup
<h1>大标题</h1><h2>小标题</h2>
```

----------

#### `addPreg()` 添加“正则规则”

本方法可以添加“正则规则”，例如：

``` php
// 添加
Ubbcode::addPreg('/\[iframe\](.+?)\[\/iframe\]/i', '<iframe src="$1"></iframe>');
Ubbcode::addPreg('/\[url\](.+?)\[\/url\]/i', '<a href="$1">$1</a>');

// 或者批量添加
$rule = array(
  '/\[iframe\](.+?)\[\/iframe\]/i' => '<iframe src="$1"></iframe>',
  '/\[url\](.+?)\[\/url\]/i' => '<a href="$1">$1</a>',
);
Ubbcode::addPreg($rule);

echo Ubbcode::convert('[iframe]网址[/iframe][url]网址[/url]');
```
上述例子将输出

``` markup
<iframe src="网址"></iframe><a href="网址">网址</a>
```

----------

#### `stripCode()` 移除所有代码

`0.1.2` 新增

本方法可以移除所有 ubbcode，如：

``` php
// 移除
echo Ubbcode::stripCode('[iframe]iFrame[/iframe][url]网址[/url][img]图片[/img]');
```
上述例子将输出

``` markup
iFrame网址
```

> 特别注意：[img] 标签将被全部移除，包括图片地址。

----------

#### `getImages()` 取得所有图片路径

`0.2.0` 新增

本方法可以从 `img` 标签中取出图片路径

使用示例：

``` php
// 获取
echo Ubbcode::getImages('[img]/www/htdocs/index.html[/img][img=/www/htdocs/123.jpg]测试图片[/img]');
```
上述例子将输出

``` php
array(
  0 => array(
    'dirname'   => '/www/htdocs',
    'basename'  => 'index.html',
    'extension' => 'html',
    'filename'  => 'index',
  ),
  1 => array(
    'dirname'   => '/www/htdocs',
    'basename'  => '123.jpg',
    'extension' => 'jpg',
    'filename'  => '123',
  ),
);
```

``` php
// 获取
echo Ubbcode::getImages('[img]/www/htdocs/index.html[/img][img=/www/htdocs/123.jpg]测试图片[/img]', PATHINFO_BASENAME);
```
上述例子将输出

``` php
array(
  0 => index.html',
  1 => '123.jpg',
);
```

`getImages()` 方法说明

``` php
function getImages( $string [, $options = '' [, $filter = '' [, $stristr = '' ]]] )
```

参数

* `string` 原始字符串

* `options` 返回类型

  如果没有指定，默认是返回全部的单元，可能的值如下：

  | 名称 | 类型 | 描述 |
  | - | - | - |
  | PATHINFO_DIRNAME | 预定义常量 | 目录 |
  | PATHINFO_BASENAME | 预定义常量 | 文件名（包含扩展名） |
  | PATHINFO_EXTENSION | 预定义常量 | 扩展名 |
  | PATHINFO_FILENAME | 预定义常量 | 文件名（无扩展名） |

* `filter` 过滤

  可以为字符串或一维数组，含有指定的字符的图片将被过滤

* `stristr` 包含

  可以为字符串或一维数组，必须含有指定的字符的图片才被获取

返回

* 数组
