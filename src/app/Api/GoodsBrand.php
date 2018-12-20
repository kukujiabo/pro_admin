<?php
namespace App\Api;


/** 
 * 商品品牌接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-26
 */
class GoodsBrand extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(

      'listQuery' => array(
      
        'brand_name' => 'brand_name|string|false||品牌名称',
        'brand_code' => 'brand_code|string|false||品牌代码',
        'brand_state' => 'brand_state|int|false||品牌状态',
        'index_show' => 'index_show|int|false||首页展示',
        'category_id' => 'category_id|int|false||分类id',
        'all' => 'all|int|false|0|是否查询全部',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      )

    ));
  
  }
 
  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array data
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

}
