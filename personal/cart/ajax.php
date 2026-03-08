<?php require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Sale\Basket;
use Bitrix\Main\Loader;

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

$sessid = $_POST["sessid"];
$basketItemId = $_POST["basketItemId"];
$quantity = $_POST["quantity"];
$action = $_POST["action"];

$response = [];
$response['DATA'] = [];

global $USER;

// Получаем ID корзины пользователя
$fUserId = CSaleBasket::GetBasketUserID();

// Получаем корзину текущего пользователя
$basket = Basket::loadItemsForFUser($fUserId, SITE_ID)->getOrderableItems();

if($action == 'updateQuantity'){
    $basketItem = $basket->getItemById($basketItemId);
    if ($basketItem) {
        // Изменяем количество
        $basketItem->setField('QUANTITY', $quantity);
        // Сохраняем изменения
        $basketItem->save();

        $response['SUCCESS'] = true;
        $response['DATA']['ITEMS'][$basketItemId]['PRICE'] = $basketItem->getPrice();
        $response['DATA']['ITEMS'][$basketItemId]['PRICE_FORMATED'] = FormatCurrency(
            $basketItem->getPrice(),
            $basketItem->getCurrency()
        );

        $response['DATA']['ITEMS'][$basketItemId]['PRICE_FORMATED'] = html_entity_decode($response['DATA']['ITEMS'][$basketItemId]['PRICE_FORMATED'] , ENT_QUOTES, 'UTF-8');
        $response['DATA']['ITEMS'][$basketItemId]['SUM_FULL_PRICE'] = $basketItem->getFinalPrice();
        $response['DATA']['ITEMS'][$basketItemId]['SUM_FULL_PRICE_FORMATED'] = FormatCurrency(
            $basketItem->getFinalPrice(),
            $basketItem->getCurrency()
        );
        $response['DATA']['ITEMS'][$basketItemId]['SUM_FULL_PRICE_FORMATED'] = html_entity_decode($response['DATA']['ITEMS'][$basketItemId]['SUM_FULL_PRICE_FORMATED'] , ENT_QUOTES, 'UTF-8');
        $response['DATA']['ITEMS'][$basketItemId]['QUANTITY'] = $quantity;
    }
}

if ($action == 'delete') {
    // Для удаления НЕ используем getOrderableItems(), чтобы получить полную корзину
    $basket = Basket::loadItemsForFUser($fUserId, SITE_ID);
    $basketItem = $basket->getItemById($basketItemId);

    if ($basketItem) {
        $result = $basketItem->delete();
        if ($result->isSuccess()) {
            $resultSave = $basket->save();

            if ($resultSave->isSuccess()) {
                $response['SUCCESS'] = true;
                $response['DATA']['DELETED_ITEM_ID'] = $basketItemId;
            } else {
                $response['ERRORS'] = $resultSave->getErrorMessages();
            }
        } else {
            $response['ERRORS'] = $result->getErrorMessages();
        }
    } else {
        $response['ERROR'] = 'Item not found in basket';
    }
}

if ($action == 'clearBasket') {

}

$basket = Basket::loadItemsForFUser($fUserId, SITE_ID)->getOrderableItems();

$response['DATA']['ALL_SUM'] = $basket->getPrice();
$response['DATA']['ALL_SUM_FORMATED'] = FormatCurrency(
    $basket->getPrice() ?: 0,
    "RUB"
);
$response['DATA']['ALL_SUM_FORMATED'] = html_entity_decode($response['DATA']['ALL_SUM_FORMATED'] , ENT_QUOTES, 'UTF-8');
$response['DATA']['ALL_VAT_SUM'] = $basket->getVatSum();
$response['DATA']['ALL_VAT_SUM_FORMATED'] = FormatCurrency(
    $basket->getVatSum() ?: 0,
    "RUB"
);
$response['DATA']['ALL_VAT_SUM_FORMATED'] = html_entity_decode($response['DATA']['ALL_VAT_SUM_FORMATED'] , ENT_QUOTES, 'UTF-8');

echo json_encode($response, JSON_UNESCAPED_UNICODE);