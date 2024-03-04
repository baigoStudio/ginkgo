## HTML 处理

HTML 处理功能由 `ginkgo\Html` 类完成，如：

``` php
use ginkgo\Html;

$str = '<div>test</div>'

echo Html::encode($html);
```

输出结果

  &lt;div&gt;test&lt;/div&gt;

----------

#### 静态方法

`encode()` HTML 编码

``` php
function encode( $html )
```

参数

* `html` HTML 代码

返回

* 编码后的字符串

----------

`decode()` HTML 解码

``` php
function decode( $string )
```

参数

* `string` 待解码的字符串

返回

* HTML 代码

----------

<span id="fillImg"></span>

`fillImg()` 将 HTML 内的图片 URL 补充完整

`0.2.0` 新增

``` php
function fillImg( $content, $baseUrl )
```

参数

* `content` HTML 内容
* `baseUrl` 基本 URL

返回

* 图片具备完整的 URL 的 HTML 内容，如：

  HTML 为 &lt;div&gt;&lt;img src=&quot;./image/logo.png&quot;&gt;&lt;/div&gt;
  基本 URL 为 https://www.baigo.net，
  补充完整后为 &lt;div&gt;&lt;img src=&quot;https://www.baigo.net/image/logo.png&quot;&gt;&lt;/div&gt;

----------

#### 过滤 HTML 标签

例如：过滤所有 HTML 标签

``` php
use ginkgo\Html;

$html = Html::instance();

$str = '<div>test</div>'

echo $html->stripTag($str);
```
输出结果

``` markup
test
```

如果要保留指定的标签，可以这样：

``` php
use ginkgo\Html;

$html = Html::instance();

$tagAllow = array('h1', 'p');

$html->setTagAllow($tagAllow);

$str = '<div><p>test</p></div>'

$html->stripTag($str);
```
输出结果

``` markup
<p>test</p>
```

----------

#### 过滤 HTML 属性

例如：过滤所有 HTML 属性

``` php
use ginkgo\Html;

$html = Html::instance();

$str = '<div id="test">test</div>'

echo $html->stripAttr($str);
```

输出结果

``` markup
<div>test</div>
```

如果要保留指定的属性，可以这样：

``` php
use ginkgo\Html;

$html = Html::instance();

$attrAllow = array('id', 'class');

$html->setAttrAllow($attrAllow);

$str = '<div id="test" title="test">test</div>'

echo $html->stripAttr($str);
```
输出结果

``` markup
<div id="test">test</div>
```

还可以设置特例，保留特殊标签的特殊属性：

``` php
use ginkgo\Html;

$html = Html::instance();

$attrExcept = array(
  'a'    => array('href', 'class'), //保留 a 标签的 href、class 属性
  'span' => array('class')          //保留 span 标签的 class 属性
);

$html->setAttrExcept($attrExcept);

$str = '<div id="test" title="test"><a href="#" id="test_href">test</a></div>'

echo $html->stripAttr($str);
```
输出结果

``` markup
<div><a href="#">test</a></div>
```

忽略标签，即不对这些标签进行过滤：

``` php
use ginkgo\Html;

$html = Html::instance();

$attrIgnore = array('a', 'span'); // 不对这些标签进行过滤

$html->setAttrIgnore($attrIgnore);

$str = '<div id="test" title="test"><a href="#" id="test_href">test</a></div>'

echo $html->stripAttr($str);
```
输出结果

``` markup
<div><a href="#" id="test_href">test</a></div>
```
