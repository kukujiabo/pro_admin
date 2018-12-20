<?php
namespace App;

use App\Library\VerifyReturn;
use App\Library\Verification;
use PhalApi\Exception;
use App\Library\ApiRequest;

/**
* 验证API接口返回信息
*/
function VerifyReturns($data) {

    try{

        if ($data) {
            
            return VerifyReturn::verifyData($data);

        } else {

            throw new \Exception("需要验证的信息不存在！");

        }

    } catch (\Exception $e){

        throw new Exception($e->getMessage(), 1007);

    }
    
}

/**
 * 验证字段
 * @param array $array 被验证的数组
 * @param array $data 验证的字段数组
 */
function Verification($array, $data) {

    try{

        Verification::index($array, $data);

    } catch (\Exception $e){

        throw new Exception($e->getMessage(), 1001);

    }

}

/**
 * 请求接口
 * @param string $service 接口名称
 * @param array $params 请求参数
 * @return array 
 */
function request($service, $params) {

    $obj = ApiRequest::request($service, $params);

    //VerifyReturns($obj);

    return $obj->getData();


}
