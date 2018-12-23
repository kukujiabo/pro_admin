<?php
namespace App\Domain;

use App\SDK\PhalApiClient;

/**
 * 商品接口
 * @author: jiangzhangchan <jiangzhangchan@qq.com> 2017-12-28
 */
class GoodsDm {

  /**
   * 添加商品（包含SUK）
   */
  public function addSkuGoods($data) {

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.Goods.AddSkuGoods');

    foreach($data as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 编辑商品（包含SUK）
   */
  public function editSkuGoods($data) {

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.Goods.EditSkuGoods');

    foreach($data as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取商品列表
   */
  public function queryList($params) {

    $params['way'] = 2;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.Goods.QueryList');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取商品详情
   */
  public function getDetail($params) {

    $params['way'] = 2;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.Goods.GetDetail');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取商品图片列表
   */
  public function getGoodsImages($params) { // App.GoodsImages.GetAll
    
    $params['way'] = 2;

    $params['status'] = 1;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.GoodsImages.GetAll');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取商品属性列表
   */
  public function getAttributeList($data) { // App.GoodsAttribute.GetAll

    $params['way'] = 2;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.GoodsAttribute.GetAll');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  
  }

  /**
   * 获取商品规格值模版列表
   */
  public function getAttributeValueList($data) { // App.GoodsAttributeValue.GetAll

    $params['way'] = 2;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.GoodsAttributeValue.GetAll');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取sku商品列表
   */
  public function getGoodsSkuList($data) { // App.GoodsSku.GetAll
    
    $params['way'] = 2;

    $client = PhalApiClient::create()->withHost("http://127.0.0.1:9002");

    $request = $client->reset()->withService('App.GoodsSku.GetAll');

    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout(3000);

    $response = $request->request();

    return $response->getData();
  
  }

  /**
   * 获取商品规格 + 规格值列表
   */
  public function getGoodsAttributeCombineValueList($data) {
  
    $data['active'] = 1;

    /**
     * 获取规格列表
     */
    $attributes = self::getAttributeList($data);

    if (empty($attributes)) {
    
      return null;
    
    }

    /**
     * 获取规格值列表
     */
    $attributeValues = self::getAttributeValueList($data);

    /**
     * 拼接属性列表
     */
    foreach($attributes as $key => $attribute) {
    
      if (!$attribute['values']) {
      
        $attribute['values'] = array();

      }

      foreach($attributeValues as $attributeValue) {
      
        if ($attributeValue['attr_id'] == $attribute['attr_id']) {
        
          array_push($attribute['values'], $attributeValue);
        
        }
      
      }

      $attributes[$key] = $attribute;
    
    }

    return $attributes;
  
  }

  /**
   * 上架商品
   */
  public function onShelf($params) {
  
    $data = array(
    
      'goods_id' => $params['goods_id'],

      'state' => 1
    
    );

    return \App\request('App.Goods.Update', $data);
  
  }

  /**
   * 下架商品
   */
  public function offShelf($params) {
  
    $data = array(
    
      'goods_id' => $params['goods_id'],

      'state' => 0
    
    );

    return \App\request('App.Goods.Update', $data);
  
  }

  /**
   * 删除商品
   */
  public function delGoods($params) {
  
    return \App\request('App.Goods.DelGoods', $params);
  
  }

  public function getAllGoods($params) {
  
    return \App\request('App.Goods.GetAllGoods', $params); 
  
  }

  public function getSkuGoods($params) {
  
    return \App\request('App.GoodsSku.GetAll', $params); 
  
  }

}
