<h1 class="ct">商品分類</h1>
<div class='ct'>新增大分類
    <input type="text" name="big" id="big">
    <button onclick="newType('big')">新增</button>
</div>
<div class='ct'>新增中分類
    <select name="parent" id="parent"></select>
    <input type="text" name="mid" id="mid">
    <button onclick="newType('mid')">新增</button>
</div>
<table class="all">
    <?php
    $bigs = $Type->all(['parent' => 0]);
    foreach ($bigs as $big) {
    ?>
        <tr class="tt ct">
            <td><?= $big['name']; ?></td>
            <td class="ct">
                <button onclick="edit(this,<?= $big['id'] ?>)">修改</button>
                <button onclick="del('type',<?= $big['id']; ?>)">刪除</button>
            </td>
        </tr>
        <?php
        $mids = $Type->all(['parent' => $big['id']]);
        if (count($mids) > 0) {
            foreach ($mids as $mid) {
        ?>
                <tr class="pp ct">
                    <td><?= $mid['name']; ?></td>
                    <td>
                        <button onclick="edit(this,<?= $mid['id'] ?>)">修改</button>
                        <button onclick="del('type',<?= $mid['id']; ?>)">刪除</button>
                    </td>
                </tr>
    <?php }
        }
    } ?>
</table>
<hr>
<h1 class="ct">商品管理</h1>
<div class="ct">
    <button onclick="location.href='?do=add_goods'">新增商品</button>
</div>
<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>庫存量</td>
        <td>狀態</td>
        <td>操作</td>
    </tr>
    <?php
    $goods = $Goods->all();
    foreach ($goods as $g) {
    ?>
        <tr class="pp ct">
            <td><?= $g['no']; ?></td>
            <td><?= $g['name']; ?></td>
            <td><?= $g['stock']; ?></td>
            <td><?= ($g['sh'] == 1) ? "販售中" : "已下架"; ?></td>
            <td>
            <button onclick="location.href='?do=edit_goods&id=<?=$g['id'];?>'">修改</button>
            <button onclick="del('goods',<?=$g['id'];?>)">刪除</button>
            <button onclick="show(this,<?=$g['id'];?>,1)">上架</button>
            <button onclick="show(this,<?=$g['id'];?>,0)">下架</button>

        </td>
        </tr>
    <?php
    }
    ?>
</table>


<script>
    $('#parent').load("api/get_type.php")

    // function newBig() {
    //     let big = $('#big').val();
    //     //這邊post是做Ajax
    //     $.post("api/save_big.php", {
    //         name: big
    //     }, (res) => {
    //         location.reload();
    //     })
    // }
    // function newMid() {
    //     let parent = $('#parent').vaule();
    //     let mid =$('#mid').vaule();
    //     $.post('api/svae_type.php',{name,parent},(res)=>{
    //         location.reload();
    //     })
    // }
    function show(dom,id,sh){
    $.post("api/save_goods.php",{id,sh},()=>{
        switch(sh){
            case 1:
                $(dom).parent().prev().text("販售中")
            break;
            case 0:
                $(dom).parent().prev().text("已下架")
            break;
        }

        //location.reload()
    })
}
    function newType(type) {
        let name, parent
        switch (type) {
            case 'big':
                name = $('#big').val();
                parent = 0;
                break;
            case 'mid':
                name = $('#mid').val()
                parent = $('#parent').val()
                break;
        }
        $.post("api/save_type.php", {
            name,
            parent
        }, (res) => {
            location.reload();
        })
    }

    function edit(dom, id) {

        let text = $(dom).parent().prev().text(); //text是要更改的舊大分類
        let name = prompt("請輸入要修改的分類文字", text) //con是新更改後的大分類,text是預設顯示舊的大分類

        //不是null表示有東西要修改
        if (name != null) {

            $.post("api/save_type.php", {
                id,
                name
            }, (res) => {
                location.reload();

                //補充
                //$dom().parent().pre().text(name);
                //$(`#paremt option[value='${id}'`).text

            })
        }
    }
</script>