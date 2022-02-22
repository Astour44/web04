<?php
include_once "../base.php";

$_POST['no']=date("Ymd").rand(100000.999999);
while(!empty($Ord->find(['no'=>$_POST['no']]))){
    //有存在同樣的訂單編號就會再重新產生
    //並且產生新的訂單編號會再確認一次是否有相同的編號
    //while在滿足條件就會斷掉(不確定次數) for會跑完要求的條件(確定次數)
    $_POST['no']=date("Ymd").rand(100000.999999);
};

$_POST['goods']=serialize($_SESSION['cart']);//轉成字串存進資料庫
$Ord->find($_POST);
?>