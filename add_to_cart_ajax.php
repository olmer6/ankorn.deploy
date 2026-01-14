<?php
// Файл: /add_to_cart_ajax.php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

header('Content-Type: application/json; charset=utf-8');

// Проверяем сессию
if (!check_bitrix_sessid()) {
    echo json_encode(['success' => false, 'message' => 'Ошибка сессии']);
    die();
}

// Получаем параметры
$productId = (int)$_POST['id'] ?? (int)$_GET['id'] ?? 0;
$quantity = (int)($_POST['qty'] ?? $_GET['qty'] ?? 1);

if ($productId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Некорректный ID товара']);
    die();
}

// Подключаем модули
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

// Добавляем товар в корзину
Add2BasketByProductID($productId, $quantity);

// Успешный ответ
echo json_encode([
    'success' => true,
    'message' => 'Товар добавлен в корзину',
    'product_id' => $productId,
    'quantity' => $quantity
]);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>