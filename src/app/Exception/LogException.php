<?php
namespace App\Exception;

use PhalApi\Exception as Phal_Exception;

/**
 * 异常记录日志类
 *
 * @author Meroc Chen <398515393@qq.com> 2017-11-26
 */
class LogException extends Phal_Exception {

  public function __construct($msg, $code, $type, $data) {

    $path =  API_ROOT . '/logs/exception_log';

    $datetime = date('Y-m-d H:i:s');

    error_log("{$code}: {$msg} 参数：{$data} 时间：{$datetime}\n", 3, $path);

    parent::__construct(

      \PhalApi\T("{$msg}", array('message' => $msg)), intval($code)

    );
  
  }

}
