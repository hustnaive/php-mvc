<?php
namespace core;

class Route {
    
    static $_routes;
    
    static function add($route,$callable) {
        if(is_callable($callable)) {
            self::$_routes[$route] = $callable;
        }
        else throw new \Exception('arg 2 must be an callable');
    }
    
    static function run($route,$params=[]) {
        if(isset(self::$_routes[$route])) {
            $callable = self::$_routes[$route];
            return call_user_func_array($callable, $params);
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