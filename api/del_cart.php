<?php
session_start();
unset($_SESSION['cart'][$_POST['id']]);
//可以刪除陣列或是變數

?>