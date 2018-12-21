<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\GoodsDm;

/**
 * 商品接口
 *
 * @author: jiangzhangchan <jiangzhangchan@qq.com> 2017-12-28
 *
 */

class Goods extends BaseApi {

    public function getRules() {

        return $this->rules(array(

            '*' => array(
                'token'  => array('name' => 'token', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '管理员令牌'),
            ),

            'getDetail' => array(

                'goods_id' => 'goods_id|int|true||商品id',

            ),

            'getGoodsImages' => array(

                'goods_id' => 'goods_id|int|true||商品id',

                'sku_id' => 'sku_id|int|false||商品sku id',

            ),

            'getAttributeList' => array(

                'goods_id' => 'goods_id|int|true||商品id',

            ),

            'getAttributeValueList' => array(

                'goods_id' => 'goods_id|int|true||商品id',

            ),

            'getGoodsSkuList' => array(

                'goods_id' => 'goods_id|int|true||商品id',

                'active' => 'active|int|false||状态'

            ),

            'queryList' => array(

                'goods_name' => 'goods_name|string|false||商品名称',

                'provider_code' => 'provider_code|string|false||供应商编码'

                'shop_id' => 'shop_id|int|false||店铺id',

                'category_id' => 'category_id|int|false||商品分类id',

                'goods_number' => 'goods_number|string|false||商品编号',

                'state' => 'state|int|false||商品状态 0下架，1正常，10违规（禁售）',

                'index_show' => 'index_show|int|false||首页展示',

                'is_pinkage' => 'is_pinkage|int|false||是否包邮 1-是 2-否',

                'is_sku' => 'is_sku|int|false||规格类型 1-多规格 2-单规格',

                'no_code' => 'no_code|string|false||商品编码',

                'fields' => 'fields|string|false|*|查询字段',

                'order' => 'order|string|false||排序',

                'page' => 'page|int|true|1|页码',

                'page_size' => 'page_size|int|true|20|每页数据条数',

            ),

            'addSkuGoods' => array(

                'provider_code' => 'provider_code|string|false||供应商编码',

                'brand_id' => 'brand_id|int|true||品牌id',

                'goods_name' => 'goods_name|string|true||商品名称',

                'shop_id' => 'shop_id|int|false||店铺id',

                'goods_number' => 'goods_number|string|true||商品编号',

                'sign' => 'sign|string|true||商品提示',

                'signature' => 'signature|string|true||商品标签',

                'category_id' => 'category_id|int|true||商品分类id',

                'state' => 'state|int|true|0|商品状态 0下架，1正常，10违规（禁售）',

                'price' => 'price|float|false||本店售价（元）',

                'max_price' => 'max_price|float|true||本店售价（元）',

                'market_price' => 'market_price|float|true||市场售价（元）',

                'goods_weight' => 'goods_weight|float|true||重量（克）',

                'sales' => 'sales|int|false||销量（件 ）',

                'is_pinkage' => 'is_pinkage|int|false|1|是否包邮 1-是 2-否',

                'pinkage' => 'pinkage|string|false||快递公司（json格式字符串，如：[{"courier":"1","default":1,"freight":10},{"courier":"2","freight":5}]。courier为快递公司id，default为1表示默认快递公司，freight为运费，运费单位：元）',

                'stock' => 'stock|int|true||库存设置',

                'shape' => 'shape|int|false|1|减库存方式 1-拍下立减库存 2-付款减库存 3-永不减少库存',

                'goods_spec_format' => 'goods_spec_format|string|false||规格描述',

                'is_sku' => 'is_sku|int|false|2|规格类型 1-多规格 2-单规格',

                'attribute' => 'attribute|string|false||商品规格属性（json格式字符串，如：[{"attr_name":"规格1属性名称","attr_value":["属性1第1项规格","属性1第2项规格","属性1第3项规格"]},{"attr_name":"规格2属性名称","attr_value":["属性2第1项规格","属性2第2项规格","属性2第3项规格"]},{"attr_name":"规格3属性名称","attr_value":["属性3第1项规格","属性3第2项规格","属性3第3项规格"]}]。）',

                'goods_sku' => 'goods_sku|string|false||sku商品（json格式字符串，如：[{"sku":[{"attr_id":"规格1属性名称","attr_val":"属性1第1项规格"},{"attr_id":"规格2属性名称","attr_val":"属性2第1项规格"},{"attr_id":"规格3属性名称","attr_val":"属性3第1项规格"}],"stock":10,"price":10,"market_price":12,"goods_weight":1.2,"picture":"kasjdhfjskhdf.jpg","sku_name":"1111"},{"sku":[{"attr_id":"规格1属性名称","attr_val":"属性1第2项规格"},{"attr_id":"规格2属性名称","attr_val":"属性2第2项规格"},{"attr_id":"规格3属性名称","attr_val":"属性3第3项规格"}],"stock":10,"price":10,"market_price":12,"goods_weight":1.2,"picture":"kasjdhfjskhdf.jpg","sku_name":"heihei"}]。）',

                'introduction' => 'introduction|string|true||商品描述（商品简介，促销语）',

                'images' => 'images|string|true||商品图（json格式字符串，如：[{"img":"lsdhfjshgbojs.jpg","is_cover":2},{"img":"123123123.jpg"}]。img为图片地址，is_cover为2表示设为封面/主图）',
            
                'thumbnail' => 'thumbnail|string|false||商品缩略图',

                'description' => 'description|string|true||商品详情（图文）',

                'is_promotion' => 'is_promotion|int|false|1|促销秒杀 1-关闭 2-开启',

                'promotion_start_time' => 'promotion_start_time|string|false||促销开始日期',

                'promotion_end_time' => 'promotion_end_time|string|false||促销结束日期',

                'is_group' => 'is_group|int|false|1|拼团设置 1-关闭 2-开启',

                'group_day' => 'group_day|int|false||成团有效时间（单位：天，最大设置为3天）',

                'group_price' => 'group_price|float|false||拼团价',

                'group_number' => 'group_number|int|false||限定人数（最大限定人数为100人 ）',

                'is_bargain' => 'is_bargain|int|false|1|砍价设置 1-关闭 2-开启',

                'bargain_day' => 'bargain_day|int|false||砍价有效时间（单位：天，最大设置为5天）',

                'bargain_price' => 'bargain_price|float|false||砍后价格',

                'bargain_number' => 'bargain_number|int|false||砍价人数（最大限定人数为100人 ）',

                'is_recommend' => 'is_recommend|int|false|1|推荐到首页 1-关闭 2-开启',

                'cities' => 'cities|string|false||销售城市',

                'recommend_title' => 'recommend_title|string|false||推荐标题',

                'sort' => 'sort|int|false|0|排序，数字越大，排在越前面',

                'index_show' => 'index_show|int|false|0|首页展示'

            ),

            'editSkuGoods' => array(

                'goods_id' => 'goods_id|int|true||商品id',

                'brand_id' => 'brand_id|int|true||品牌id',

                'goods_name' => 'goods_name|string|true||商品名称',

                'sign' => 'sign|string|true||商品提示',

                'signature' => 'signature|string|true||商品标签',

                'shop_id' => 'shop_id|int|true||店铺id',

                'goods_number' => 'goods_number|string|true||商品编号',

                'category_id' => 'category_id|int|true||商品分类id',

                'state' => 'state|int|true|0|商品状态 0下架，1正常，10违规（禁售）',

                'price' => 'price|float|false||本店售价（元）',

                'max_price' => 'max_price|float|true||本店售价（元）',

                'market_price' => 'market_price|float|true||市场售价（元）',

                'goods_weight' => 'goods_weight|float|true||重量（克）',

                'sales' => 'sales|int|false||销量（件 ）',

                'is_pinkage' => 'is_pinkage|int|false|1|是否包邮 1-是 2-否',

                'pinkage' => 'pinkage|string|false||快递公司（json格式字符串，如：[{"courier":"1","default":1,"freight":10},{"courier":"2","freight":5}]。courier为快递公司id，default为1表示默认快递公司，freight为运费，运费单位：元）',

                'stock' => 'stock|int|true||库存设置',

                'shape' => 'shape|int|false|1|减库存方式 1-拍下立减库存 2-付款减库存 3-永不减少库存',

                'goods_spec_format' => 'goods_spec_format|string|false||规格描述',

                'is_sku' => 'is_sku|int|false|2|规格类型 1-多规格 2-单规格',

                'attribute' => 'attribute|string|false||商品规格属性（json格式字符串，如：[{"attr_name":"规格1属性名称","attr_value":["属性1第1项规格","属性1第2项规格","属性1第3项规格"]},{"attr_name":"规格2属性名称","attr_value":["属性2第1项规格","属性2第2项规格","属性2第3项规格"]},{"attr_name":"规格3属性名称","attr_value":["属性3第1项规格","属性3第2项规格","属性3第3项规格"]}]。）',

                'goods_sku' => 'goods_sku|string|false||sku商品（json格式字符串，如：[{"sku":[{"attr_id":"规格1属性名称","attr_val":"属性1第1项规格"},{"attr_id":"规格2属性名称","attr_val":"属性2第1项规格"},{"attr_id":"规格3属性名称","attr_val":"属性3第1项规格"}],"stock":10,"price":10,"market_price":12,"goods_weight":1.2,"picture":"kasjdhfjskhdf.jpg","sku_name":"1111"},{"sku":[{"attr_id":"规格1属性名称","attr_val":"属性1第2项规格"},{"attr_id":"规格2属性名称","attr_val":"属性2第2项规格"},{"attr_id":"规格3属性名称","attr_val":"属性3第3项规格"}],"stock":10,"price":10,"market_price":12,"goods_weight":1.2,"picture":"kasjdhfjskhdf.jpg","sku_name":"heihei"}]。）',

                'introduction' => 'introduction|string|true||商品描述（商品简介，促销语）',

                'images' => 'images|string|true||商品图（json格式字符串，如：[{"img":"lsdhfjshgbojs.jpg","is_cover":2},{"img":"123123123.jpg"}]。img为图片地址，is_cover为2表示设为封面/主图）',
            
                'thumbnail' => 'thumbnail|string|false||商品缩略图',

                'description' => 'description|string|true||商品详情（图文）',

                'is_promotion' => 'is_promotion|int|false|1|促销秒杀 1-关闭 2-开启',

                'cities' => 'cities|string|false||销售城市',

                'promotion_start_time' => 'promotion_start_time|string|false||促销开始日期',

                'promotion_end_time' => 'promotion_end_time|string|false||促销结束日期',

                'is_group' => 'is_group|int|false|1|拼团设置 1-关闭 2-开启',

                'group_day' => 'group_day|int|false||成团有效时间（单位：天，最大设置为3天）',

                'group_price' => 'group_price|float|false||拼团价',

                'group_number' => 'group_number|int|false||限定人数（最大限定人数为100人 ）',

                'is_bargain' => 'is_bargain|int|false|1|砍价设置 1-关闭 2-开启',

                'bargain_day' => 'bargain_day|int|false||砍价有效时间（单位：天，最大设置为5天）',

                'bargain_price' => 'bargain_price|float|false||砍后价格',

                'bargain_number' => 'bargain_number|int|false||砍价人数（最大限定人数为100人 ）',

                'is_recommend' => 'is_recommend|int|false|1|推荐到首页 1-关闭 2-开启',

                'recommend_title' => 'recommend_title|string|false||推荐标题',

                'sort' => 'sort|int|false|0|排序，数字越大，排在越前面',

                'index_show' => 'index_show|int|false||首页展示'

            ),

            'getGoodsAttributeCombineValueList' => array(
            
              'goods_id' => 'goods_id|int|true||商品id，必传'
            
            ),

            'onShelf' => array(
            
              'goods_id' => 'goods_id|int|true||商品id，必传'
            
            ),

            'offShelf' => array(
            
              'goods_id' => 'goods_id|int|true||商品id，必传'
            
            ),

            'delGoods' => array(
            
              'goods_id' => 'goods_id|int|true||商品id，必传'
            
            ),

            'getAllGoods' => array(
            
            
            ),

            'getSkuGoods' => array(
            
              'sku_name' => 'sku_name|string|false||sku名称'
            
            )

        ));

    }

    /**
     * 编辑商品（包含SUK）
     * @desc 编辑商品（包含SUK）
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function editSkuGoods() {

        $params = $this->retriveRuleParams(__FUNCTION__);

        return $this->dm->editSkuGoods($params);

    }

    /**
     * 添加商品（包含SUK）
     * @desc 添加商品（包含SUK）
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function addSkuGoods() {

        $regulation = array(

            'token' => 'required'

        );

        $params = $this->retriveRuleParams(__FUNCTION__);

        return $this->dm->addSkuGoods($params);

    }

    /**
     * 获取商品图片列表
     * @desc 获取商品图片列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getGoodsImages() {

        $regulation = array(

            'token' => 'required',

            'goods_id' => 'required',

        );

        $conditions = $this->retriveRuleParams(__FUNCTION__);

        \App\Verification($conditions, $regulation);

        return $this->dm->getGoodsImages($conditions);

    }

    /**
     * 获取商品属性列表
     * @desc 获取商品属性列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getAttributeList() {

        $regulation = array(

            'token' => 'required',

            'goods_id' => 'required',

        );

        $conditions = $this->retriveRuleParams(__FUNCTION__);

        \App\Verification($conditions, $regulation);

        return $this->dm->getAttributeList($conditions);

    }

    /**
     * 获取商品规格值模版列表
     * @desc 获取商品规格值模版列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getAttributeValueList() {

        $regulation = array(

            'token' => 'required',

            'goods_id' => 'required',

        );

        $conditions = $this->retriveRuleParams(__FUNCTION__);

        \App\Verification($conditions, $regulation);

        return $this->dm->getAttributeValueList($conditions);

    }

    /**
     * 获取sku商品列表
     * @desc 获取sku商品列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getGoodsSkuList() {

      $conditions = $this->retriveRuleParams(__FUNCTION__);

      return $this->dm->getGoodsSkuList($conditions);

    }

    /**
     * 查询商品详情
     * @desc 查询商品详情
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getDetail() {

      $regulation = array(

          'token' => 'required',

          'goods_id' => 'required',

      );

      $conditions = $this->retriveRuleParams(__FUNCTION__);

      \App\Verification($conditions, $regulation);

      return $this->dm->getDetail($conditions);

    }

    /**
     * 查询商品列表
     * @desc 查询商品列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function queryList() {

        $conditions = $this->retriveRuleParams(__FUNCTION__);

        $regulation = array(

            'token' => 'required',

        );

        \App\Verification($conditions, $regulation);

        return $this->dm->queryList($conditions);

    }

    /**
     * 查询商品列表
     * @desc 查询商品列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getGoodsAttributeCombineValueList() {
    
      return $this->dm->getGoodsAttributeCombineValueList($this->retriveRuleParams(__FUNCTION__));
    
    }

    /**
     * 上架商品
     * @desc 上架商品
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function onShelf() {
    
      return $this->dm->onShelf($this->retriveRuleParams(__FUNCTION__));
    
    }

    /**
     * 下架商品
     * @desc 下架商品
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function offShelf() {
    
      return $this->dm->offShelf($this->retriveRuleParams(__FUNCTION__));
    
    }

    /**
     * 删除商品
     * @desc 删除商品
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function delGoods() {

      return $this->dm->delGoods($this->retriveRuleParams(__FUNCTION__));
    
    }

    /**
     * 获取全部商品
     * @desc 获取全部商品
     *
     * @return int
     */
    public function getAllGoods() {
    
      return $this->dm->getAllGoods($this->retriveRuleParams(__FUNCTION__));
    
    }

    /**
     * 获取全部sku商品
     * @desc 获取全部sku商品
     *
     * @return array data
     */
    public function getSkuGoods() {
    
      return $this->dm->getSkuGoods($this->retriveRuleParams(__FUNCTION__));
    
    }

}
