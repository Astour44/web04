<?php

$g = $Goods->find($_GET['id']);
echo "<h1 class='ct'>{$g['name']}</h1>";
?>


<div class="all" style="display:flex">
    <div class="pp ct" style="width:66%">
        <img src="img/<?= $g['img']; ?>" style="width:90%">
        
    </div>
    <div class="pp" style="width:33%">
        <div style="border-bottom:2px solid white">分類</div>
        <div style="border-bottom:2px solid white">編號:<?= $g['no'] ?></div>
        <div style="border-bottom:2px solid white">價格:<?= $g['price'] ?></div>
        <div style="border-bottom:2px solid white">詳細說明:<?= $g['intro'] ?></div>
        <div>庫存量:<?= $g['stock'] ?></div>
    </div>
</div>
<div class="tt ct all">
    購買數量<input type="number" name="qt" id="qt" value="1" style="width:30px">
    <img src="icon/0402.jpg" onclick="buy(<?=$g['id'];?>)">
</div>

<script>
function buy(id){//點下去要帶到購物車那邊
// location.href="?do=buycart&id="+id+"&qt="+$("#qt").val();
location.href=`?do=buycart&id=${id}&qt=${$("#qt").val()}`;//這邊要用上引號
}
</script>