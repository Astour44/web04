<?php include_once "base.php";

if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}
$user = $Admin->find(['acc' => $_SESSION['admin']]);
// echo "<pre>";
// print_r($user['pr']);
// echo "</pre>";
$right = unserialize($user['pr']);
// echo "<pre>";
// print_r($right);
// echo "</pre>";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0057)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>┌精品電子商務網站」</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css">
    <script src="./js/js.js"></script>
    <script src="./js/jquery.js"></script>
</head>

<body>
    <iframe name="back" style="display:none;"></iframe>
    <div id="main">
        <div id="top">
            <a href="index.php">
                <img src="./icon/0416.jpg">
            </a>
            <img src="./icon/0417.jpg">
        </div>
        <div id="left" class="ct">
            <div style="min-height:400px;">
                <a href="?do=admin">管理權限設置</a>
                <?= (in_array(1, $right)) ? "<a href='?do=th'>商品分類與管理</a>" : ""; ?>
                <!-- 從$right找到1 -->
                <?= (in_array(2, $right)) ? "<a href='?do=order'>訂單管理</a>" : ""; ?>
                <?= (in_array(3, $right)) ? "<a href='?do=mem'>會員管理</a>" : ""; ?>
                <?= (in_array(4, $right)) ? "<a href='?do=bot'>頁尾版權管理</a>" : ""; ?>
                <?= (in_array(5, $right)) ? "<a href='?do=news'>最新消息管理</a>" : ""; ?>
                <a href="?do=logout" style="color:#f00;">登出</a>
                <!-- <a href="javascript:logout('admin')" style="color:#f00;">登出</a> -->
                <!-- 也可以這樣寫 這樣back/logout的檔案就可以刪掉-->
            </div>
        </div>
        <div id="right">
            <?php
            $do = $_GET["do"] ?? 'admin';
            //??意思是如果變數存在且不為null就會返回否則返回第二個值
            //如果$_GET["do"]存在且不是null的話就會返回自身的值
            //但若不存在會返回'admin'
            $file = 'back/' . $do . ".php";
            if (file_exists($file)) {
                include $file;
            } else {
                //echo "檔案不存在";
                include "back/admin.php";
            }


            ?>
        </div>
        <div id="bottom" style="line-height:70px; color:#FFF; background:url(icon/bot.png);" class="ct">
            <?= $Bot->find(1)['bottom']; ?></div>
    </div>

</body>

</html>