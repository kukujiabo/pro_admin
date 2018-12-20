<?php
namespace App\Api;

// use PhalApi\Api;
// use App\Domain\GoodsCategoryDm;

/**
 * 商品分类接口
 *
 * @author: jiangzhangchan <jiangzhangchan@qq.com> 2018-01-02
 *
 */

class GoodsCategory extends BaseApi {

    public function getRules() {

        return $this->rules(array(

            'getAll' => array(

                'category_id' => 'category_id|int|false||商品分类id',

                'category_name' => 'category_name|string|false||商品分类名称',

                'short_name' => 'short_name|string|false||商品分类简称',

                'pid' => 'pid|int|false||父级id',

                'level' => 'level|int|false||分类等级',

                'is_visible' => 'is_visible|int|false||是否显示  1 显示 0 不显示',

                'attr_id' => 'attr_id|int|false||关联商品类型ID',

                'attr_name' => 'attr_name|string|false||关联类型名称',

                'keywords' => 'keywords|string|false||关键词',

                'description' => 'description|string|false||描述',

                'sort' => 'sort|int|false||种类',

                'category_pic' => 'category_pic|string|false||商品分类图片',

                'is_subclass' => 'is_subclass|int|false|2|是否显示子类别 1-是 2-否',

                'fields' => 'fields|string|false|*|查询字段',

                'order' => 'order|string|false||排序',

                'index_show' => 'index_show|int|false||首页展示'

            )

        ));

    }


    /**
     * 查询商品分类全部列表
     * @desc 查询商品分类全部列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return string msg 错误提示
     */
    public function getAll() {

        return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));

    }

}
