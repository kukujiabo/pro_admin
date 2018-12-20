<?php
/**
 * 统一初始化
 */

// 定义项目路径
defined('API_ROOT') || define('API_ROOT', dirname(__FILE__) . '/..');

// 引入composer
require_once API_ROOT . '/vendor/autoload.php';

// 时区设置
date_default_timezone_set('Asia/Shanghai');

// 引入DI服务
include API_ROOT . '/config/di.php';

//允许跨域请求
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: AX-TOKEN");

// 调试模式
if (\PhalApi\DI()->debug) {
    // 启动追踪器
    \PhalApi\DI()->tracer->mark();

}

//加载请求鉴权过滤器
\PhalApi\DI()->filter = "\\App\\Filter\\AuthorityFilter";

// 翻译语言包设定
\PhalApi\SL('zh_cn');

if (!function_exists('getallheaders')) { 
  
  function getallheaders() { 

    $headers = []; 

    foreach ($_SERVER as $name => $value) { 

      if (substr($name, 0, 5) == 'HTTP_') {

        $headers[str_replace(' ', '-', str_replace('_', ' ', substr($name, 5)))] = $value; 

      } 

    } 

    return $headers; 

  } 

}
