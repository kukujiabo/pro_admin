<?php
namespace App\Domain;

use App\Library\RedisClient;

/**
 * 管理员处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-02
 */
class AdminDm {

  protected $_admin;

  public function __construct() {
  
    $requestHeader = getallheaders();
  
    $auth = RedisClient::get('pro_admin_auth', $requestHeader['AX-TOKEN']);

    $this->_admin = $auth;

  }

  /**
   * 管理员登录
   */
  public function login($data) {
  
    return \App\request('App.Admin.Login', $data);
  
  }

  /**
   * 获取当前会话管理员信息
   */
  public function sessionAdminInfo() {

    $params = [

      'id' => $this->_admin->id
    
    ];
  
    return \App\request('App.Admin.sessionAdminInfo', $params);
  
  }

  public function addAcct($params) {

    return \App\request('App.Admin.AddAcct', $params);

  }

  public function listQuery($params) {

    return \App\request('App.Admin.ListQuery', $params);

  }

  public function getDetail($params) {

    return \App\request('App.Admin.GetDetail', $params);

  }

  public function editAcct($params) {

    return \App\request('App.Admin.EditAcct', $params);

  }

  public function updatePassword($params) {

    $params['id'] = $this->_admin->id;

    return \App\request('App.Admin.UpdatePassword', $params);

  }

  public function removeAccount($params) {

    return \App\request('App.Admin.RemoveAccount', $params);

  }

}
