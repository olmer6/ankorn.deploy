<?php require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Sale\Basket;
use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale;
use Bitrix\Main\Localization\Loc;
use local\util\ankornOrder\dataValidator;
use local\util\ankornOrder\FormDataHandler;

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

Loc::loadMessages(__FILE__);
$returned_result = [];

// Только POST
if (!Context::getCurrent()->getRequest()->isPost()) {
    die(json_encode(['success' => false, 'ERROR' => 'Method not allowed']));
}


$request = Context::getCurrent()->getRequest();

// Получаем данные из POST
$userName = trim($request->getPost('USER_NAME'));
$companyName = trim($request->getPost('COMPANY_NAME'));
$email = trim($request->getPost('EMAIL'));
$phone = trim($request->getPost('PHONE'));
$comment = trim($request->getPost('COMMENT'));
$companyDetails = $request->getFile('COMPANY_DETAILS');
$ArchiveFile = $request->getFile('ARCHIVE_FILE');

if($companyDetails){
    $companyDetailsFileID = FormDataHandler::fileSave(fileDetails:$companyDetails,directory: 'companyDetails');
    $companyDetailsFileURL = $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($companyDetailsFileID);
}
if($companyDetails){
    $ArchiveFileFileID = FormDataHandler::fileSave(fileDetails:$ArchiveFile,directory: 'archiveFile');
    $ArchiveFileURL = $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($ArchiveFileFileID);
}

// валидация
$dataValidator = new DataValidator();
$dataValidator->validate(
    $userName,
    $email,
    $phone,
    $companyDetails,
    $ArchiveFile,
);

// собираем корзины для почтовых событий
$basketComposition = FormDataHandler::getToPostCartHtml($APPLICATION);

//COMF5 BEGIN
$Comf5BasketComposition = FormDataHandler::getToComf5CartHtml($APPLICATION);
//COMF5 END

// закончили собирать корзины для почтовых событий
// ------------------------------------------------------------
// 1. Поиск или создание пользователя
// ------------------------------------------------------------

$userId = FormDataHandler::getUserId(userName:$userName, email:$email, phone:$phone);
/*
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
*/
// ------------------------------------------------------------
// 2. Работа с корзиной
// ------------------------------------------------------------
$siteId = Context::getCurrent()->getSite();
$fuserId = Sale\Fuser::getId(); // ID корзины текущей сессии
$basket = Sale\Basket::loadItemsForFUser($fuserId, $siteId);

if ($basket->count() == 0) {
    die(json_encode(['SUCCESS' => false, 'ERROR' => ["basket_empty" => 'Корзина пуста']]));
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
    die(json_encode(['SUCCESS' => false, 'ERROR' => implode('; ', $result->getErrorMessages())]));
}
$orderId = $order->getId();

// ------------------------------------------------------------
// 4. Очистка корзины
// ------------------------------------------------------------
// Удаляем все позиции из корзины текущего пользователя (сессии)
//
$basketItems = $basket->getBasketItems();
//COMF5 BEGIN
$f5Basket = [
    "price" => $basket->getPrice(),
    "products" => []
];
//COMF5 END
foreach ($basketItems as $item) {
    //COMF5 BEGIN
    $f5Basket['products'][$item->getProductId()] = [
        'NAME' => $item->getField('NAME'),
        'PRICE' => $item->getPrice(),
        'QUANTITY' => $item->getQuantity(),
        'PRODUCT_ID' => $item->getProductId(),
    ];
    //COMF5 END
    $item->delete(); // помечаем на удаление
}
$basket->save();

// ------------------------------------------------------------
// 5. Ответ
// ------------------------------------------------------------

$returned_result['success'] = true;
$returned_result['order_id'] = $orderId;
$returned_result['message'] = 'Заказ успешно создан';

ob_start();
?>
    <h2>создан новый заказ</h2>
    <p>Контактное лицо: <strong><?=$_POST['USER_NAME']?></strong></p>
    <p>E-mail: <strong><?=$_POST['EMAIL']?></strong></p>
    <p> Tелефон: <strong><?=$_POST['PHONE']?></strong></p>
    <p>Комментарий:</p>
    <p><strong><?=$_POST['COMMENT']?></strong></p>
<?php if($companyDetailsFileURL){?>Файл реквизитов компании: <a href="<?=$companyDetailsFileURL?>"><?=$companyDetailsFileURL?></a><?php };?>
<?php if($ArchiveFileURL){?>Архив с дополнительными материалами: <a href="<?=$ArchiveFileURL?>"><?=$ArchiveFileURL?></a><?php };?>
<?php
$userData = ob_get_clean();

$arEventFields = [
    'USER_NAME' => $_POST['USER_NAME'],
    'COMPANY_NAME' => $_POST['COMPANY_NAME'],
    'EMAIL' => $_POST['EMAIL'],
    'PHONE' => $_POST['PHONE'],
    'COMMENT' => $_POST['COMMENT'],
    'BASKETCOMPOSITION' => $basketComposition,
    'USERDATA' => $userData,
    'COMPANY_DETAILS_FILE_URL' => $companyDetailsFileURL,
    'ARCHIVE_FILE_URL' => $ArchiveFileURL,
];
$sendResult = CEvent::Send("FORM_ORDER_CREATE_ANCORN_SEND", 's1', $arEventFields);

$returned_result['sendResult'] = $sendResult;
//$returned_result['testMailResult'] = $mailResult;
$returned_result['SUCCESS'] = TRUE;
//$returned_result['ERROR'] = 'Неизвестная ошибка';
echo json_encode($returned_result);

//COMF5 BEGIN
//$Comf5arEventFields = [
//    'AUTHOR' => $_POST['USER_NAME'],
//    'COMPANY_NAME' => $_POST['COMPANY_NAME'],
//    'AUTHOR_EMAIL' => $_POST['EMAIL'],
//    'PHONE' => $_POST['PHONE'],
//    'TEXT' => $_POST['COMMENT'].$Comf5BasketComposition,
//    'FORM_NAME' => "callPrice",
//    'COMPANY_DETAILS_FILE_URL' => $companyDetailsFileURL,
//    'ARCHIVE_FILE_URL' => $ArchiveFileURL,
//];

$Comf5arEventFields = [
    "order" => [
        "id" => $orderId,
        "price" => $f5Basket['price'],
        'CONTACT_PERSON' => $_POST['USER_NAME'],
        'EMAIL' => $_POST['EMAIL'],
        'PHONE' => $_POST['PHONE'],
        'comment' => $_POST['COMMENT'],
        'COMPANY_NAME' => $_POST['COMPANY_NAME'],
    ],
    'products' => $f5Basket['products'],
    'cookie' => $_COOKIE,
    'COMPANY_DETAILS_FILE_URL' => $companyDetailsFileURL,
    'ARCHIVE_FILE_URL' => $ArchiveFileURL,
];
$sendResult = CEvent::Send("COMF5_SEND", 's1', $Comf5arEventFields);
//COMF5 END