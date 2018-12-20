<?php
namespace App\Domain;

use App\SDK\PhalApiClient;

/**
 * 商品品牌处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-26
 */
class GoodsBrandDm {


  /**
   * 列表查询
   *
   * @param array $data
   *
   * @return array list
   */
  public function listQuery($params) {

    $client = PhalApiClient::create()->withHost("http://106.14.14.84:10016");

    $request = $client->reset()->withService('App.GoodsBrand.listQuery');
        
    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }


}
