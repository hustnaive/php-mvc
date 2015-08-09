<?php
namespace core;

/**
 * 自动加载器，遵循psr-4规范
 * @author fangl
 *
 */
class Autoloader {

    static $_namespaces = [
        'web' => 'src',
    ];

    /**
     * 增加命名空间到路径的映射（以帮助自动加载器能够找到对应的路径）
     * 注意对应的代码里面的命名空间要和声明一致，否则即使文件正确引入，也会报找不到类文件错误
     * @param string $namespace 命名空间（只接受一个字符串）
     * @param string $path 命名空间对应的路径
     */
    static function addNameSpace($namespace,$path) {
        self::$_namespaces[trim($namespace,'\\/')] = trim($path,'\\/');
    }

    /**
     * 获取命名空间的加载路径，如果命名空间不存在，返回原值
     * @param string $namespace
     * @return Ambigous <unknown, multitype:string , string>
     */
    static function getPath($namespace) {
        return isset(self::$_namespaces[$namespace])?self::$_namespaces[$namespace]:$namespace;
    }

    /**
     * 自动加载回调函数
     * @param string $clsname
     */
    static function autoload($clsname) {
        $clsname = trim($clsname,'\\/');
        $clspath = explode('\\',$clsname);
        $clspath[0] = self::getPath($clspath[0]);
        require APP_ROOT.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,$clspath).'.php';
    }
}

//注册自动加载
spl_autoload_register(__NAMESPACE__.'\Autoloader::autoload');
