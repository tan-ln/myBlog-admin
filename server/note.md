# 数据库
## 查询
- find() 查询一条
Db::table('')->where('name', 'eq', 'ta')->find()
- select() 查询所有

- 原生
Db::query("select ...")

## 获取参数
1. input('post.') 获取以 post 方式传递的所有
> input('param.') 所有、数组方式返回
2. $request->param('name') 

# 数组
`['1' => 'a', '2' => 'b']`

### 创建数组
`array('a', 'ab')`   

### 遍历数组
1. for 循环
**只能用于遍历，纯索引数组**
```php
for ($i; $i < $l; $i++) {

}
```
2. foreach 
**可以遍历任何类型的数组**
```php
 $arr = array(1,2,3,"one"=>4,5,6,7);
   foreach($arr as $value){
  echo "{$value}<br>";
 }
 foreach($arr as $key => $value){
  echo "{$key}==>{$value}<br>";
 }
```

### 插入 push
`array_push($arr, $a, $b);`
向 数组 $arr 尾部 插入 一个或多个

- count($arr) === length

- sort($arr)

# 对象
`->` 调用对象的属性或方法

```php
class Test {
    public $a;
    private $b;
    protected $c;

    public function __construct ($aa, $bb) {

    }

    public function baz() {
        echo $this->$a;
    }
}

$test = new Test(1, 2);
echo $test->baz()

```

# 路由 `app\route.php`
                     模块/控制器/方法
Route::rule('tags', 'blog/Tag/getTags', 'GET');

# input 助手函数

# Cookie::set('name', $value, $time)

# 数组和字符串转换
```php
$array = explode(separator, $string); 
$string = implode(glue, $array);
```