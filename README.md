php-mvc是什么？
---
这个项目是我自己的一个实验性项目，用于向大家介绍从0开始编写一个自己的mvc框架所需要的知识以及过程。

要点梗概
---
* 从URL映射到某个php文件或者类的那点事儿
	* 从浏览器输入一段url，是如何经过http传输，服务器解析，到最后被php处理并定位到某个php代码文件的？
	* PHP的autoload介绍
	* modulename/controllername/actionname，这种url路由背后的实现原理是什么？
	* 一个最小的路由解析引擎实现url到某个php文件的路由映射是怎么样的？
* 我们看到的东西背后PHP都在做什么
	* http协议、web服务器、cgi程序的工作原理；http的无状态与web的会话保持 — cookie与session
	* web的实质是html/css/js等资源通过互联网的产生、传输和可视化。
	* PHP的职责是根据业务需求处理与用户交互的逻辑，产生html — PHP模板渲染技术机制介绍，实现一个最简单的模板渲染引
* 写SQL是个体力活
	* PHP如何接收用户的数据
	* 与数据库协作：数据持久化与pdo
	* 用户数据过滤、验证、参数绑定、防sql注入
	* 如何解放生产力：ORM技术介绍，实现一个最简单的ORM框架
* 高级一点，整合框架，并保证其灵活可扩展
	* PHP-MVC框架的三大核心功能点：路由解析引擎（C）、模板渲染引擎（V）、ORM框架（M）
	* 事件驱动与组件编程（Yii的设计思想）
	* 放弃固步自封，拥抱变化吧！（DSL的思考，对理想的编程框架的思考）

快速开始
---

对于开发环境，推荐使用[xampp](http://sourceforge.net/projects/xampp/files/)。只需要下载后，将本项目中的websrv里面的代码拷贝至xampp/apache/htdocs中，就可以开始玩了。

不过，我还是建议你在htdocs中直接创建一个php-mvc目录，然后，执行`git clone git@github.com:hustnaive/php-mvc.git`，将本仓库clone到本地。这样，你以后就会发现对于你的测试非常方便。

当然，如果你对php和apache/nginx已经非常熟悉了，你可以按照你熟悉的方式去部署代码，在后面的叙述中，你的访问地址不会和我严格一致，请大家自己注意。

对于每个阶段的内容，我会打一个tag，如果你是将项目整个clone到本地，那么你就可以`git checkout tagname`实际的到每个阶段的节点去查看当时的完整代码。

如果你跟我一样在研究docker，你也可以基于docker开始，参考`Docker开始`。

Docker开始
---

* 执行`git clone git@github.com:hustnaive/php-mvc.git`，将代码库clone到本地
* 执行`cd path/to/php-mvc`进入到代码目录
* 执行`docker build -t imgname .`生成docker镜像
* 执行`docker run -d --name aliasname -p 8080:80 imgname`运行容器
* 浏览器访问`http://boot2docker-ip:8080`访问站点

如果你希望实时的在容器中看到你的修改而不必重新构建的话，你可以将第四步执行如下命令：

	docker run -d --name aliasname -p 8080:80 -v path/to/php-mvc/websrc/core:/var/www/core -v path/to/php-mvc/websrc/src:/var/www/src -v path/to/php-mvc/websrc/web:/var/www/html



目录结构
---

	php-mvc/
		|- taglogs/	每个版本的实验记录，说明，以tagname-xxx命名
		|- websrc/	所有源代码目录
			|-- core/ 核心框架代码
			|-- src/ 站点源代码目录
			|-- web/ 站点webroot目录
				|-- index.php 站点启动脚本（注意apache需要启动mode_rewrite）
		|- README.md 本说明文档
		|- Dockerfile 自动构建脚本


修改日志
---

* 0.1 pathinfo基础介绍



