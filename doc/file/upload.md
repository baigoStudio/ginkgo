## 上传文件

上传文件功能由 `ginkgo\Upload` 完成，内置的上传是指上传到本地服务器，上传到远程或者第三方平台请查看 [杂项 -> FTP](../misc/ftp.md)，或另行扩展。

假设表单代码如下：

``` markup
<form action="/index/index/upload" enctype="multipart/form-data" method="post">
    <input type="file" name="image"> <br> 
    <input type="submit" value="上传"> 
</form>
```

控制器定义如下

``` php
namespace app\ctrl\index;

use ginkgo\Upload;

class Index {

    public function upload() {
        $upload = Upload::instance();
        
        // 获取表单上传文件 例如上传了 001.jpg
        $file = $upload->create('image');        
        
        if ($file) {
            // 移动到框架应用根目录 /uploads/ 目录下
            if ($upload->move('../uploads/', '001.jpg')) {
                print_r($file);
            } else {
                echo $upload->getError();
            }
        } else {
            // 上传失败获取错误信息
            echo $upload->getError();
        }
    }

}
```

`create` 方法在上传失败返回 false，上传成功返回一个数组，结构如下

``` php
array(
    'name'      => '001.jpg', // 原始文件名
    'tmp_name'  => '/tmp/php3zU3t5', // 临时文件
    'ext'       => 'jpg', // 扩展名
    'mime'      => 'image/jpeg', // MIME
    'size'      => 31059, // 文件大小
);
```

----------

#### 保存文件

`move` 方法说明

``` php
function move( string $dir [, string $name = true [, bool $replace = false]] )
```

参数

* `dir` 移动到指定目录
    
    建议使用完整路径
    
* `name` 保存为指定文件名
    
    可能的值
    
    | 值 | 描述 |
    | - | - |
    | true（默认值） | 自动生成 |
    | false | 使用原文件名 |
    | 字符串 | 指定文件名 |

* `replace` 是否覆盖

    如为 false，文件重名时将终止上传。

----------

#### 上传规则

默认情况下，会以微秒时间的 md5 编码为文件名，例如：

42a79759f284b767dfcb2a0197904287.jpg

我们可以指定上传文件的命名规则，使用 `rule` 方法即可，例如：

``` php
$upload->rule('sha1')->move('../uploads/');
```

如果你希望保留原文件名称，可以使用

``` php
$upload->move('../uploads/', false);
```

----------

#### 上传限制

上传限制可以通过配置文件定义

``` php
'var_extra' => array(
    'upload' => array(
        'limit_size'    => 200, // 上传尺寸
        'limit_unit'    => 'kb', // 尺寸单位（kb、mb、gb）
    ),    
    ...
),
```
        
也可以在实例化上传类时定义

``` php
$config = array(
    'limit_size'    => 200, // 上传尺寸
    'limit_unit'    => 'kb', // 尺寸单位（kb、mb、gb）
);

$upload = Upload::instance($config);
```

还可以通过方法定义，方法定义必须在 `create` 方法执行之前。

限制文件 MIME 类型

``` php
namespace app\ctrl\index;

use ginkgo\Upload;

class Index {

    public function upload() {
        $mime = array(
            'gif' => array(
                'image/gif',
            ),
            'jpg' => array(
                'image/jpeg',
                'image/pjpeg'
            ),
            'png' => array(
                'image/png',
                'image/x-png'
            ),
        );
        
        $upload = Upload::instance();
        $upload->setMime($mime);        
    }

}
```

限制文件大小

``` php
namespace app\ctrl\index;

use ginkgo\Upload;

class Index {

    public function upload() {
        $upload = Upload::instance();
        $upload->setLimit(10989);        
    }

}
```

> 优先级：方法定义 &gt; 初始化定义 &gt; 配置文件定义