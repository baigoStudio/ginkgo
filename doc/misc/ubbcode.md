## Ubbcode

0.1.1 新增

#### `convert` 转换字符串

使用 convert 方法解析 ubbcode，例如：

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
| [kbd]content[/kbd] | 键盘文本 | |
| [hr]| 水平线 | |
| [br] | 换行符 | |
| {:br} | 换行符 | 0.1.1 废弃 |
| [blockquote]content[/blockquote] | 引用 | 0.1.1 新增 |
| [url]网址[/url] | 链接 | 0.1.1 新增 |
| [url=网址]说明[/url] | 链接 | 0.1.1 新增 |

----------

#### `addPair` 添加“成对规则”

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

#### `addSingle` 添加“单独规则”

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

#### `addReplace` 添加“替换规则”

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

#### `addPreg` 添加“正则规则”

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

echo Ubbcode::convert('[iframe]网址[iframe][url]网址[url]');
```
上述例子将输出

``` markup
<iframe src="网址"></iframe><a href="网址"></a>
```
