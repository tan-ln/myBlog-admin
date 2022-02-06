<?php
namespace app\blog\controller;
use think\Request;
use think\Db;

class Tag {
    // 获取所有 标签
    public function getTags()
    {
        $res = Db::table('tags')->select();
        $tags = [];
        if ($res) {
            for ($i = 0; $i < count($res); $i++) {
                array_push($tags, $res[$i]['tag']);
            }
        }
        // echo json_encode($tags);
        echo json_encode(['code' => 1, 'tags' => $tags]);
    }

    // 添加 标签
    public function addTag($tagName)
    {
        $res = Db::table('tags')->insert(['tag' => $tagName]);
        $res_arr = $res ? ['code' => 1, 'message' => 'insert success'] : ['code' => 0];
        echo json_encode($res_arr);
    }

    public function delTag()
    {
        $data = input('delete.');
        $tag = $data['tag'];
        
        $res = Db::table('tags')->where('tag', $tag)->delete();
        if ($res) {
            echo json_encode(['code' => 1, 'message' => '删除成功']);
        } else {
            echo json_encode(['code' => 0, 'message' => '删除失败']);
        }
    }
}