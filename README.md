ThinkPHP5 ealing
===============

基于ThinkPHP5 基础上开发的一个简单的restful api ，带权限验证等

> ThinkPHP5的运行环境要求PHP5.4以上。

详细开发文档参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─ealing             主程拓展目录
│  │  ├─behavior      	主程行为目录
│  │  ├─command      	主程cli命令目录
│  │  │     └─Package.php   快速生成server项目
│  │  ├─config      	配置目录
│  │  │     ├─config.php    主程参数配置文件
│  │  │     └─helper.php    主程助手函数文件
│  │  ├─controller      控制器目录
│  │  │     ├─admin     后端主框架目录
│  │  │     ├─v1        主程API版本1目录
│  │  │     ├─AuthApi.php   授权基类
│  │  │     ├─OpenApi.php   开放基类
│  │  │     ├─Oauth.php     授权验证
│  │  │     ├─Send.php      返回格式
│  │  │     └─...			其他基类
│  │  ├─lang            语言目录
│  │  │     ├─en_us.php     英文语言文件
│  │  │     └─zh_cn.php     中文语言文件
│  │  ├─model           模型目录
│  │  │     └─relations     关系模型目录
│  │  ├─route           路由目录
│  │  │     ├─admin.php     后台路由
│  │  │     └─web.php       前台路由
│  │  ├─services        服务目录
│  │  └─view        	视图目录（只有后端，前端都是API）
│  │
│  └─news         		新闻项目
│
├─config				配置文件
│  ├─command.php        cli命令扩展配置文件
│  ├─common.php         应用公共（函数）文件
│  ├─config.php         公共配置文件
│  ├─database.php       数据库配置文件
│  └─tags.php           应用行为扩展定义文件
│
├─database              数据文件
│  ├─migrations         数据迁移文件目录
│  └─seeds              基础数据导入文件目录
│
├─extend                扩展类库目录（可定义）
│
├─public                WEB目录（对外访问目录）
│  ├─h5                 H5版
│  ├─pc                 PC版
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─runtime               运行缓存目录
│
├─tests                 单元测试目录
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

## 安装项目

cd 到项目根目录

迁移数据

php think migrate:run

初始化数据

php think seed:run

## 快速创建一个拓展控制器

cd 到项目根目录

命令行 ：php think make:controller ealing/v1/Goods

修改路由，注册一个资源路由：在route.php加入下面一行代码：
Route::resource('v1/goods','ealing/v1.Goods'); 

## 其他说明

交流QQ群号：[484193834](http://shang.qq.com/wpa/qunwpa?idkey=b6f7b764cd876af1c39e8cdcb48d45063b1744a5ce3b4f903346da33923ac3a6)

## 版权信息

遵循Apache2开源协议发布，并提供免费使用。


更多细节参阅 [LICENSE.txt](LICENSE.txt)
