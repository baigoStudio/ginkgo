## 图片处理

图片处理功能由 `ginkgo\Image` 完成。

----------

#### 打开图片

假设当前入口文件目录下面有一个 image.png 文件

使用 `open()` 方法打开图片进行相关操作：

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');
```

----------

#### 获取图片信息

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

// 返回图片的宽度
$width = $image->width(); // 0.2.0 起废弃
$width = $image->getInfo('width'); // 0.2.0 新增

// 返回图片的高度
$height = $image->height(); // 0.2.0 起废弃
$height = $image->getInfo('height'); // 0.2.0 新增

// 返回图片的扩展名
$ext = $image->ext(); // 0.2.0 起废弃
$ext = $image->getInfo('ext'); // 0.2.0 新增

// 返回图片的 mime 类型
$mime = $image->mime(); // 0.2.0 起废弃
$mime = $image->getInfo('mime'); // 0.2.0 新增

// 返回图片的尺寸数组 0 图片宽度 1 图片高度
$size = $image->size(); // 0.2.0 起废弃
```

----------

#### 裁剪图片

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

//将图片裁剪为 300x300 并保存为 crop.png
$image->crop(300, 300)->save(false, 'crop.png');
```

支持从某个坐标开始裁剪，例如从（100, 30）开始裁剪：

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

$image->crop(300, 300, 100, 30)->save(false, 'crop.png');
```

----------

#### 生成缩略图

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

$image->thumb(150, 150)->save(false, 'thumb.png');
```

默认采用等比例缩放的方式生成，也支持裁切方式生成，如：

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

$image->thumb(150, 150, 'crop')->save(false, 'thumb.png');
```

缩略图的两种生成方式说明

![缩略图的两种生成方式说明](thumb.jpg){.img-fluid .bg-img}

支持批量生成缩略图，如：

``` php
use ginkgo\Image;

$image = Image::instance();

$image->open('./image.png');

$thumb = array(
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
$image->batThumb($thumb);
```

> 批量生成缩略图会自动调用 `save()` 方法。

----------

#### 图片保存

`save()` 方法可以实现图片保存

`save()` 方法说明

``` php
function save( [ $path = false [, $name = false [, $type = false [, $quality = 90 [, $interlace = true ]]]]] ) // 0.2.0 前
function save( [ $path = false [, $name = false [, $quality = 90 [, $interlace = true ]]]] ) // 0.2.0 及以后
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
