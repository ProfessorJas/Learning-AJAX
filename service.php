<?php
header("Content-Type: text/plain; charset=utf-8");
$staff = array
    (
        array("name" => "a", "number" => "101", "gender" => "M", "job" => "Manager"),
        array("name" => "b", "number" => "102", "gender" => "M", "job" => "Tech Leader"),
        array("name" => "amigo", "number" => "103", "gender" => "F", "job" => "Software Engineer")
    );

// 判断如果是get请求，就进行全文搜索；如果是post，就新建
// $_SERVER是一个超全局变量，在一个脚本的全部作用域中都可用，不用使用global关键字
// $_SERVER["REQUEST_METHOD"]返回访问页面使用的请求方法
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    search();
} else if($_SERVER["REQUEST_METHOD"] == "POST") {
    create();
}

// search employee through employee id
function search() {
    // 检查是否有员工编号的参数
    // isset检查变量是否设置，empty判断值为否为空
    // 超全局变量$_GET 和 $_POST 用于收集表单数据
    if (!isset($_GET["number"]) || empty($_GET["number"])) {
        echo "参数错误";
        return;
    }

    // 函数之外申明的变量拥有Global作用域，只能在函数以外进行访问。
    // global关键词用于访问函数内的全局变量
    global $staff;

    // 获取number参数
    $number = $_GET["number"];
    $result = "没有找到员工。";

    // 遍历$staff多维数组，查找key为number的员工是否存在，如果存在，就修改返回结果
     foreach($staff as $value) {
        if ($value["number"] == $number) {
            $result = "找到员工：员工编号：".$value["number"]."，员工姓名：".$value["name"]."，员工性别：".$value["gender"]."，员工职位：".$value["job"];
            break;
        }
     }

     echo $result;
}

// 创建员工
function create() {
    // 判断信息是否填写完全
    if (!isset($_POST["name"]) || empty($_POST["name"])
        || !isset($_POST["number"]) || empty($_POST["number"])
        || !isset($_POST["gender"]) || empty($_POST["gender"])
        || !isset($_POST["job"]) || empty($_POST["job"])) {
            echo "参数错误，员工信息填写不全";
            return;
    }

    // TODO: 获取POST表单数据并保存到数据库

    // 提示保存成功
    echo "员工：".$_POST["name"]."信息保存成功";
}
    
?>