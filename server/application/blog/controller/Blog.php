<?php
namespace app\blog\controller;
use think\Request;
use think\Db;

class Blog {

    // 发布博文
    public function published()
    {
        $data = input('post.');
        $title = $data['title'];
        $mdContent = $data['markdownContent'];
        $created = date("Y-m-d H:i:s");
        // 数组转为字符串
        $tagsArr2Str = implode(',', $data['tags']);
        $blog = ['title' => $title, 'tags' => $tagsArr2Str, 'mdContent' => $mdContent, 'created' => $created, 'views' => 0];

        $res = Db::table('blogs')->insert($blog);
        if ($res) {
            echo json_encode(['code' => 1, 'message' => 'published']);
        }
    }

    // 获取所有 博文
    public function getBlogList(Request $request)
    {
        $page = $request->param('page') ? $request->param('page') : 1;
        $limit = $request->param('limit') ? $request->param('limit') : 5;

        $res = Db::table('blogs')->page($page, $limit)->select();
        $all = Db::query("select * from blogs;");
        
        echo json_encode(['code' => 1, 'list' => $res, 'amount' => count($all)]);
    }

    // 更新 博文
    public function updateBlog()
    {
        $data = input('put.');
        $blog = $data['blog'];
        foreach ($blog as $key => $value) {
            if ($key === 'created') {
                // 设置更新时间
                $blog[$key] = date("Y-m-d H:i:s");
            }
            if ($key === 'tags') {
                // 数组转为字符串
                $blog[$key] = implode(',', $value);
            }
        }

        $res = Db::table('blogs')->where('id', $blog['id'])->update($blog);
        if ($res) {
            echo json_encode(['code' => 1, 'message' => 'update success']);
        }
    }

    // 删除 博文
    public function deleteBlog($blogid)
    {
        $res = Db::table('blogs')->where('id', $blogid)->delete();
        if ($res) {
            echo json_encode(['code' => 1, 'message' => 'delete success']);
        }
    }
}