<?php
namespace App\Domain;

use App\SDK\PhalApiClient;

/**
 * 商品分类接口
 * @author: jiangzhangchan <jiangzhangchan@qq.com> 2018-01-02
 */
class GoodsCategoryDm {


  /**
   * 获取全部商品分类
   */
  public function getAll($params) {

    $client = PhalApiClient::create()->withHost("http://106.14.14.84:10016");

    $request = $client->reset()->withService('App.GoodsCategory.GetAll');
        
    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }


}
