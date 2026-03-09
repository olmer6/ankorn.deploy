<?php require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Sale\Basket;
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale;
use Bitrix\Main\Localization\Loc;

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

// Только POST
if (!Context::getCurrent()->getRequest()->isPost()) {
    die(json_encode(['success' => false, 'error' => 'Method not allowed']));
}

$request = Context::getCurrent()->getRequest();

// Получаем данные из POST
$userName = trim($request->getPost('USER_NAME'));
$email = trim($request->getPost('EMAIL'));
$phone = trim($request->getPost('PHONE'));
$comment = trim($request->getPost('COMMENT'));

// валидация

if (empty($email)) {
    $errors['email'] = 'Email обязателен для заполнения';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Введите корректный email адрес';
}
// Валидация телефона (базовая)
if (empty($phone)) {
    $errors['phone'] = 'Телефон обязателен для заполнения';
} elseif (!preg_match('/^[0-9+\-\s\(\)]+$/', $phone)) {
    $errors['phone'] = 'Телефон содержит недопустимые символы';
}
if($errors) echo json_encode(['ERROR' => $errors]);

Loc::loadMessages(__FILE__);
$returned_result = [];

// ------------------------------------------------------------
// 1. Поиск или создание пользователя
// ------------------------------------------------------------
$userId = 0;
$user = new CUser;

// Ищем пользователя по логину (телефон)
$resUser = CUser::GetList(
    ($by = 'ID'),
    ($order = 'ASC'),
    ['=LOGIN' => $phone],
    ['FIELDS' => ['ID']]
);
if ($arUser = $resUser->Fetch()) {
    $userId = $arUser['ID'];
} else {
    // Пользователь не найден — создаём нового
    $password = randString(8); // генерируем пароль

    $fields = [
        'LOGIN' => $phone,
        'EMAIL' => $email,
        'NAME' => $userName,
        'PASSWORD' => $password,
        'CONFIRM_PASSWORD' => $password,
        'ACTIVE' => 'Y',
    ];

    $newUserId = $user->Add($fields);
    if ($newUserId) {
        $userId = $newUserId;
    } else {
        die(json_encode(['success' => false, 'error' => 'Ошибка создания пользователя: ' . $user->LAST_ERROR]));
    }
}

// ------------------------------------------------------------
// 2. Работа с корзиной
// ------------------------------------------------------------
$siteId = Context::getCurrent()->getSite();
$fuserId = Sale\Fuser::getId(); // ID корзины текущей сессии
$basket = Sale\Basket::loadItemsForFUser($fuserId, $siteId);

if ($basket->count() == 0) {
    die(json_encode(['success' => false, 'error' => 'Корзина пуста']));
}

// ------------------------------------------------------------
// 3. Создание заказа
// ------------------------------------------------------------
$order = Sale\Order::create($siteId, $userId);
$order->setBasket($basket);

// Устанавливаем комментарий к заказу
$order->setField('COMMENTS', $comment);

// Сохраняем заказ
$result = $order->save();
if (!$result->isSuccess()) {
    die(json_encode(['success' => false, 'error' => implode('; ', $result->getErrorMessages())]));
}

$orderId = $order->getId();

// ------------------------------------------------------------
// 4. Очистка корзины
// ------------------------------------------------------------
// Удаляем все позиции из корзины текущего пользователя (сессии)
//
/*
$basketItems = $basket->getBasketItems();
foreach ($basketItems as $item) {
    $item->delete(); // помечаем на удаление
}
$basket->save();
*/
// ------------------------------------------------------------
// 5. Ответ
// ------------------------------------------------------------

$returned_result['success'] = true;
$returned_result['order_id'] = $orderId;
$returned_result['message'] = 'Заказ успешно создан';


ob_start();
$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"to_post",
	[
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => [
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
			5 => "PROPS",
			6 => "DELETE",
			7 => "DELAY",
		],
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "Y",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"TEMPLATE_THEME" => "site",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => [
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
		],
		"COMPONENT_TEMPLATE" => "ankorn",
		"DEFERRED_REFRESH" => "N",
		"USE_DYNAMIC_SCROLL" => "Y",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "Y",
		"COLUMNS_LIST_EXT" => [
			0 => "PREVIEW_PICTURE",
			1 => "DELETE",
			2 => "DELAY",
			3 => "SUM",
		],
		"COLUMNS_LIST_MOBILE" => [
			0 => "PREVIEW_PICTURE",
			1 => "DELETE",
			2 => "SUM",
		],
		"TOTAL_BLOCK_DISPLAY" => [
			0 => "bottom",
		],
		"DISPLAY_MODE" => "extended",
		"PRICE_DISPLAY_MODE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"USE_PRICE_ANIMATION" => "Y",
		"LABEL_PROP" => [
		],
		"USE_PREPAYMENT" => "N",
		"CORRECT_RATIO" => "Y",
		"AUTO_CALCULATION" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"COMPATIBLE_MODE" => "Y",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_11" => "-",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_13" => "-",
		"ADDITIONAL_PICT_PROP_14" => "-",
		"ADDITIONAL_PICT_PROP_15" => "-",
		"ADDITIONAL_PICT_PROP_16" => "-",
		"ADDITIONAL_PICT_PROP_18" => "-",
		"ADDITIONAL_PICT_PROP_19" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"USE_GIFTS" => "N",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"__megasoft_hash" => "YTozOntpOjA7czozMjoiZjhhMjRmNGM3YmY0YTUxNWQwZTBiMzRkMTg1Y2JkMzQiO2k6MTtzOjE0OiIxMDkuMTYzLjIxNi4zMCI7aToyO3M6MTExOiJNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTQzLjAuMC4wIFNhZmFyaS81MzcuMzYiO30=.1766438673.021f5cee51d0973e59cf3968489fd98c429c260a328b464801b6f8adc58142a2"
	],
	false
);
$basketComposition = ob_get_clean();

ob_start();
?>
<h2>создан новый заказ</h2>
<p>Контактное лицо: <strong><?=$_POST['USER_NAME']?></strong></p>
<p>E-mail: <strong><?=$_POST['EMAIL']?></strong></p>
<p> Tелефон: <strong><?=$_POST['PHONE']?></strong></p>
<p>Комментарий:</p>
<p><strong><?=$_POST['COMMENT']?></strong></p>
<?php
$userData = ob_get_clean();

$arEventFields = [
    'USER_NAME' => $_POST['USER_NAME'],
    'EMAIL' => $_POST['EMAIL'],
    'PHONE' => $_POST['PHONE'],
    'COMMENT' => $_POST['COMMENT'],
    'BASKETCOMPOSITION' => $basketComposition,
    //COMF5 BEGIN
    'FORM_NAME' => "callPrice",
    //COMF5 END
    'USERDATA' => $userData,
];
$sendResult = CEvent::Send("FORM_ORDER_CREATE_ANCORN_SEND", 's1', $arEventFields);

if (mail("olmer6@yandex.ru","тема", "текст тела письма","From: info@ankorn.ru"))
    $mailResult = "Успешно передано функции mail, проверьте почту.";
else
    $mailResult = "Ошибка функции mail, обратитесь к хостеру.";

$returned_result['sendResult'] = $sendResult;
$returned_result['testMailResult'] = $mailResult;
echo json_encode($returned_result);

