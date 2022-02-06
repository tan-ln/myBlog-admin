<?php
namespace app\user\controller;
use think\controller;
use think\Request;
use think\Db;
use think\Cookie;

class Login {

    public function login($account, $password)
    {
        // 验证 token
        // $token = Cookie::get('__token__');
        // if ($token) {
        //     $res = validateToken($token, $account);
        //     if ($res) {
        //         echo json_encode(['code' => '1', 'message' => 'login from token']);
        //         return;
        //     }
        // }

        $pwd = md5($password);

        // 数据库验证
        $result = $this->checkLogin($account, $pwd);
        echo json_encode($result);
    }

    function checkLogin($account, $pwd)
    {
        // 查找用户
        $res = Db::table('user')->where('account', $account)->find();
        if ($res) {
            // 密码校验
            if ($res['password'] === $pwd) {
                // token
                $token = request()->token('__token__', 'tang1');
                // 设置Cookie 有效期为 3600秒
                Cookie::set('__token__', $token, 3600);
        
                return ['code' => '1', 'message' => '登录成功', 'token' => $token];
            } else {
                return ['code' => '0', 'message' => '密码错误'];
            }
        } else {
            return ['code' => '0', 'message' => '用户不存在'];
        }
    }

}