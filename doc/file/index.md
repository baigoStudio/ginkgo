## 文件处理

文件处理功能由 `ginkgo\File` 类完成。

----------

#### 静态方法

`0.2.0` 新增

* `fileHas` 文件是否存在

  ``` php
  File::fileHas('./image/test.jpg');
  ```

* `dirHas` 文件是否存在

  ``` php
  File::dirHas('./image/');
  ```

----------

#### 基本操作

* 列出文件和目录

  ``` php
  $file = File::instance();

  $lists = $file->dirList('./image');
  ```

  列出所有 JPG 文件

  ``` php
  $file->dirList('./image', 'jpg');
  ```

* 创建文件夹

  ``` php
  $file->dirMk('./image');
  ```

* 复制目录

  ``` php
  $file->dirCopy('./src', './dst');
  ```

* 删除目录

  ``` php
  $file->dirDelete('./dir');
  ```

* 读取文件

  ``` php
  $content = $file->fileRead('./readme.txt');
  ```

* 写入文件

  ``` php
  $file->fileWrite('./readme.txt', $content);
  ```

* 移动（更名）文件

  ``` php
  $file->fileMove('./src.txt', './dst.txt');
  ```

* 复制文件

  ``` php
  $file->fileCopy('./src.txt', './dst.txt');
  ```

* 删除文件

  ``` php
  $file->fileDelete('./src.txt');
  ```

* 取得文件 MIME 类型 `0.2.0` 起废弃

  ``` php
  $mime = $file->getMime('./src.txt');
  ```

* 取得文件扩展名 `0.2.0` 起废弃

  ``` php
  $ext = $file->getExt('./src.txt');
  ```
