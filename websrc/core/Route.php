<?php
namespace core;

/**
 * 路由处理类
 * 
 * 用法：
 * 
 * //运行某路由
 * Route::run('/',$_POST);
 * 
 * //自定义处理回调（会覆盖默认路由处理方式）
 * Route::add('/',function($params) { print_r($params); });
 * Route::run('/',$_POST);
 * 
 * @author fangl
 *
 */
class Route {
    
    static $_routes;
    
    /**
     * 将一个callable作为路由处理方法添加到路由表中，后添加的会覆盖新添加的。
     * @param string $route
     * @param callable $callable
     */
    static function add($route,callable $callable) {
        self::$_routes[$route] = $callable;
    }
    
    /**
     * 运行一个路由处理方法，首先查路由表，如果路由表中已经注册了一个处理方法，调用该处理方法。
     * 如果没有注册处理方法，则在web\ctrls命名空间下寻找相应的controller
     * 
     * @param string $route
     * @param array $params
     * @return mixed
     */
    static function run($route,$params=[]) {
        if(isset(self::$_routes[$route])) {
            $callable = self::$_routes[$route];
            return call_user_func_array($callable, [$params]);
        }
        else {
            $route = trim($route,'\\/');
            $routes = explode('/', $route);
            $routes = array_filter($routes);
            
            //默认controller的处理方法为index方法
            $action = 'index';
            
            //如果路由的层级大于2，则最后一个/后面的为请求的方法名，倒数第二个为controller名，文件名同控制器名，首字母大写
            if(count($routes) >= 2) {
                $action = $routes[count($routes)-1];
                $routes = array_slice($routes, 0, count($routes)-1);
                $routes[count($routes)-1] = ucfirst($routes[count($routes)-1]);
            }
            else if( count($routes) == 1) {
                //如果只传控制器名，调用默认处理方法
                $routes[0] = ucfirst($routes[0]);
            }
            else {
                //默认的控制器为Index，处理方法为index
                $routes = ['Index'];
            }
            
            $cls = 'web\\ctrls\\'.implode('\\',$routes);
            $callable = [new $cls,'_run'];
            return call_user_func_array($callable, [$action,$params]);
        }
    }
}