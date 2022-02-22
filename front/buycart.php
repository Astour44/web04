<?php
if (isset($_GET['id']) && isset($_GET['qt'])) {
    $_SESSION['cart'][$_GET['id']] = $_GET['qt']; //這邊會是id(陣列)接數量(數字)
    //dd($_SESSION['cart']);
}
if (!isset($_SESSION['mem'])) {
    to("?do=login");
    exit();
}
if (empty($_SESSION['cart'])) {
    echo "<h1 class='ct'>購物車無商品</h1>";
} else {
?>
    <h1 class="ct"><?= $_SESSION['mem']; ?>的購物車</h1>
    <table class="all">
        <tr class="tt ct">
            <td>編號</td>
            <td>商品</td>
            <td>數量</td>
            <td>庫存量</td>
            <td>單價</td>
            <td>小計</td>
            <td>刪除</td>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $id => $qt) { //qt是商品數量
            $item = $Goods->find($id); //這邊是從Goods的資料表抓出商品的id
            // echo "<pre>";
            // print_r($item);
            // echo "</pre>";
        ?>
            <tr class="pp ct">
                <td><?= $item['no']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $qt; ?></td>
                <td><?= $item['stock']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['price'] * $qt; ?></td>
                <td>
                    <!-- js刪除用remove  php用unset -->
                    <img src="icon/0415.jpg" alt="" onclick="delCart(<?=$id;?>)">
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <img src="icon/0411.jpg" onclick="location.href='index.php'">&nbsp;&nbsp;
        <img src="icon/0412.jpg" onclick="location.href='?do=checkout'">
    </div>
<?php
}
?>


<script>
function delCart(id){
    $.post("api/del_cart.php",{id},()=>{
        location.href='?do=buycart';
    })
}


</script>