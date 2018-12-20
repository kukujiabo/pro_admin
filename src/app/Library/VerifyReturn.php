<?php
namespace App\Library;


/**
 * 验证API接口返回信息
 *
 * @author: jiangzhangchan <jiangzhangchan@qq.com> 2017-10-30
 *
 */
class VerifyReturn {

  /**
   * 验证API接口返回信息
   */
  public function verifyData($data) {
    
    if ($data->getRet() != 200) {

      throw new \Exception($data->getMsg().'，错误码：'.$data->getRet());

    }

    return $data->getData();
  
  }

}
