<?php
namespace app\index\controller;

use think\controller;
use think\Request;
use think\Db;
use think\Cookie;

class SignUp {

    // 注册
    public function signUp()
    {
        $request = request();
        $data = $request->param();
        $account = $data['account'];
        $password = md5($data['password']);

        // post 方式提交的数据
        if (!request()->isPost()) return;

        // 查找是否存在用户
        $findRes= $this->findUser($data['account']);

        if ($findRes) {
            // 密码校验
            if ($findRes['password'] === $password) {
                echo json_encode(['code' => '1', 'message' => '您已注册，将直接登录']);
            } else {
                echo json_encode(['code' => '0', 'message' => '用户名已存在']);
            }
            return;
        }
        // token
        $token = request()->token('__token__', 'tang1');

        // 注入的数据
        $inject = ['account' => $account, 'password' => $password, 'token' => $token];

        // 插入数据
        $res = Db::table('user')->insert($inject, true);

        if ($res) {
            // 设置Cookie 有效期为 3600秒
            Cookie::set('__token__', $token, 3600);
            echo json_encode(['code' => 1, 'message' => '注册成功', 'token' => $token]);
        } else {
            echo json_encode(['code' => 0, 'message' => '注册失败，请稍后再试。']);
        }
    }

    // 查找用户名，返回结果
    public function findUser($account)
    {
        $res = Db::table('user')->where('account', $account)->find();
        
        return $res;
    }

}