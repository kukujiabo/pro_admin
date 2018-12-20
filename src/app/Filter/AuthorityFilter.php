<?php
namespace App\Filter;

use PhalApi\Filter;
use PhalApi\Exception;
use App\Library\RedisClient;

class AuthorityFilter implements Filter {

    CONST WRONG_REQUEST = 500001;

    CONST EXPIRE_SESSION = 500002;

    /**
     * 请求权限校验
     */
    public function check() {

      if (strtoupper($_SERVER['REQUEST_METHOD']) == 'OPTIONS') {

        echo '请求错误！';
      
        exit;
      
      }

      if (\PhalApi\DI()->config->get('app.env') == 'pro') {

        /**
         * 白名单请求放行
         */
        if (in_array(\PhalApi\DI()->request->get('service'), \PhalApi\DI()->config->get('app.service_whitelist'))) {
        
          return;
        
        }

        /**
         * 正式环境下要对请求的头部信息进行校验
         * 获取请求的所有头部信息
         */

        $headers = \getallheaders();

        if (!$headers['AX-TOKEN'] || strlen($headers['AX-TOKEN']) != 64) {
        
          /**
           * AX-TOKEN 不存在时，请求为无效请求
           */

          throw new Exception('错误的请求！', AuthorityFilter::WRONG_REQUEST);
        
        } else {

          /**
           * AX-TOKEN 存在时，校验该令牌是否有效
           */
        
          $auth = RedisClient::get('pro_admin_auth', $headers['AX-TOKEN']);

          if ( !$auth || ($auth['session_time'] - time()) > 1800 )  {
          
            throw new Exception('会话已失效，请重新登录！', AuthorityFilter::EXPIRE_SESSION);
          
          } else {

            /**
             * 校验通过，刷新token有效时间
             */
          
            $auth['session_time'] = time();

            RedisClient::set('pro_admin_auth', $headers['AX-TOKEN'], $auth);
          
          }
        
        }

      }

    }

}
