<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!check_bitrix_sessid()) die('Invalid session');

$productId = (int)$_REQUEST['id'];
if ($productId > 0) {
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    Add2BasketByProductID($productId, 1);
}


// Редирект в корзину
LocalRedirect('/personal/cart/');
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>