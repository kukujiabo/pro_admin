<?php
namespace App\Api;

/**
 * 管理员接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-02
 */
class Admin extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'login' => [
      
        'account' => 'account|string|true||管理员账号',

        'password' => 'password|string|true||管理员密码'

      ],

      'addAcct' => [

        'account' => 'account|string|true||管理员账号',

        'admin_name' => 'admin_name|string|true||管理员名称',

        'password' => 'password|string|true||密码',
          
        'pro_code' => 'pro_code|string|false||供应商编码',

        'role' => 'role|int|false||角色'

      ],

      'listQuery' => [

        'admin_name' => 'admin_name|string|false||管理员名称',

        'fields' => 'fields|string|false||字段',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数'

      ],

      'getDetail' => [

        'id' => 'id|int|true||管理员id'

      ],

      'editAcct' => [

        'id' => 'id|int|true||管理员id',

        'account' => 'account|string|false||管理员账号',

        'admin_name' => 'admin_name|string|false||管理员名称',

        'password' => 'password|string|false||密码',

        'pro_code' => 'pro_code|string|false||供应商编码',
        
        'role' => 'role|int|false||角色'

      ],

      'sessionAdminInfo' => [
      
 
      ],

      'updatePassword' => [

        'password' => 'password|string|true||新密码',

        'old_password' => 'old_password|string|true||旧密码'

      ],

      'removeAccount' => [

        'id' => 'id|int|true||账号id'

      ]
    
    ]);
  
  }

  /**
   * 管理员登录
   * @desc 管理员登录
   *
   * @return array auth
   */
  public function login() {
  
    return $this->dm->login($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 获取当前回话的管理员信息
   * @desc 获取当前回话的管理员信息
   *
   * @return array info
   */
  public function sessionAdminInfo() {
  
    return $this->dm->sessionAdminInfo();
  
  }

  /**
   * 新增账号
   * @desc 新增账号
   *
   * @return int id
   */
  public function addAcct() {

    return $this->dm->addAcct($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 查询账号列表
   * @desc 查询账号列表
   *
   * @return array list
   */
  public function listQuery() {

    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 查询管理员详情
   * @desc 查询管理员详情
   *
   * @return array data
   */
  public function getDetail() {

    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 编辑账号
   * @desc 编辑账号
   *
   * @return int num
   */
  public function editAcct() {

    return $this->dm->editAcct($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 更新密码
   * @desc 更新密码
   *
   * @return int num
   */
  public function updatePassword() {

    return $this->dm->update($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 删除账号
   * @desc 删除账号
   *
   * @return int num
   */
  public function removeAccount() {

    return $this->dm->removeAccount($this->retriveRuleParams(__FUNCTION__));

  }

}
