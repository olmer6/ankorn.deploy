<?php
require __DIR__ . "/handle.php";

use Bitrix\Main;
use Bitrix\Sale;
use comf5\amoIntegration\classes\amoIntegration;

function comf5_OnBeforeEventAdd($event, $lid, $arFields)
{
    if ($event == "COMF5_SEND") {
        try {
            $integration = new amoIntegration();
            $integration->start($arFields);
        } catch (\Throwable $th) {
            logger(['Throwable',$th->getMessage()]);
        }
    }
    if ($event == "FEEDBACK_FORM") {
        try {
            $data = [
                "form" => $arFields,
                "get" => $_GET,
                "cookie" => $_COOKIE,
            ];

            $integration = new amoIntegration();
            $integration->start($data);
        } catch (\Throwable $th) {
            logger(['Throwable',$th->getMessage()]);
        }
    }
}

function comf5_OnSaleOrderSaved($event)
{
    return;
    try {
        $basket = $event->getBasket();
        $orderId = $basket->getOrderId();
        $order = $basket->getOrder();
        logger($orderId);

        $fuserId = $basket->getFUserId();
        $resUser = Sale\Fuser::GetList(
            ($by = 'ID'),
            ($order = 'ASC'),
            ['=ID' => $fuserId],
            ['FIELDS' => ['ID']]
        );
        $arUser = $resUser->Fetch();
        logger($arUser);

        $arOrderProps = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderId));

        $data = [
            "order" => [
                "id" => $orderId,
                "price" => $order->getPrice(),
            ],
            "products" => [],
            "cookie" => $_COOKIE,
        ];

        foreach ($arOrderProps->arResult as $prop) {
            $data["order"][$prop["CODE"]] = $prop["PROXY_VALUE"];
        }

        $dbRes = CSaleBasket::GetList(
            array("SORT" => "ASC"),
            array("ORDER_ID" => $orderId),
            false,
            false,
            array("ID", "NAME", "QUANTITY", "PRICE", "PRODUCT_ID")
        );

        while ($arBasketItem = $dbRes->Fetch()) {
            $data["products"][$arBasketItem["PRODUCT_ID"]] = $arBasketItem;
        }

        logger(['$data', $data]);

//        $integration = new amoIntegration();
//        $integration->start($data);

    } catch (\Throwable $th) {
        logger(['Throwable',$th->getMessage()]);
    }


}