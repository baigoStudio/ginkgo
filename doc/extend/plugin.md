## 插件

插件功能依赖 `ginkgo\Plugin` 类实现。

插件是一种程序，它可以通过系统预留的钩子，来向系统增加一些特定的功能。

不同的插件之间具有位置共同性，比如，有些插件的作用位置都是在应用执行前，有些插件都是在模板输出之后，我们把这些插件发生作用的位置称之为钩子，当应用程序运行到这个钩子的时候，就会被拦截下来，统一执行相关的插件。

插件的存在让二次开发者无需改动框架和应用，只需在外围通过扩展来改变或者增加一些功能。