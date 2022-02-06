<?php
use think\Db;

// 应用公共文件

/**
 * token 验证函数
 * $token cookie 取出的 token
 */

 function validateToken($token, $account)
 {
    $user = Db::table('user')->where('account', $account)->find();
    $tokenFromDB = $user ? $user['token'] : FALSE;
    if ($tokenFromDB && $token === $tokenFromDB) {
        return TRUE;
    } else {
        return FALSE;
    }
 }