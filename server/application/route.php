<?php

use think\Route;

// user
Route::rule('signIn', 'user/Login/login', 'POST');
Route::rule('signUp', 'user/SignUp/signUp', 'POST');

// blog
Route::post('blog/publish', 'blog/Blog/published');
Route::get('blog/lists', 'blog/Blog/getBlogList');
Route::put('blog/update', 'blog/Blog/updateBlog');
Route::delete('blog/delete/:blogid', 'blog/Blog/deleteBlog');


// tag
Route::rule('tags', 'blog/Tag/getTags', 'GET');
Route::rule('tags', 'blog/Tag/addTag', 'POST');
Route::delete('tags', 'blog/Tag/delTag');

return [
    '__pattern__' => [
        'name' => '\w+',
    ]
];
