## 创建插件

首先需要确定插件是用来做什么的，然后就可以想办法为它起一个独一无二的名字。如果不确定名字是否被使用，可以通过搜索引擎来搜索一下。

大多数插件开发者为插件起的名字都能很直观地描述它的功能，例如：一个与天气有关的插件的名字中就应当包含“天气”两个字。

插件的名字可以由多个字词组成，推荐使用英文、数字、下划线。

----------

#### 目录

根据插件的名字，创建一个目录，目录必须由英文、数字组成，要注意重名的问题。

用户在安装插件的时候，会默认把插件安装到 `./extend/plugin/` 的目录下，如果两个插件的目录冲突，那就会发生不可预见的错误。

---------- 
 
#### 文件组成

目录中至少应当包含一个主文件，文件名必须以 `.class.php` 为后缀，文件名可以和目录同名，也可以在描述文件中定义。

根据需要，也可以把主文件拆分成多个文件，自行载入。

插件中可以包含一个描述文件，文件名必须为 `config.json`；

还可以包含选项文件 `opts.json`，同时，还可以根据开发者的要求生成 `opts_var.json` 文件。

另外还可以增加 Javascript、CSS、图片以及语言文件等。

| 名称 | 描述 |
| - | - |
| 类.class.php（必需） | 主文件 |
| config.json | 插件的描述 |
| opts.json | 插件的选项 |
| opts_var.json | 用户对选项的设置 |
| readme.txt | 说明文档 |
| license.txt | 授权说明 |
| 其他文件 | ... |

`0.1.1` 起由 `config.inc.php` 更改为 `config.json`，`opts.json` 更改为 `opts_var.json`，`opts.inc.php` 更改为 `opts.json`。
