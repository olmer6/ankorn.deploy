<?php
require __DIR__ . "/handle.php";

use Bitrix\Main;
use Bitrix\Sale;
use comf5\amoIntegration\classes\amoIntegration;

function comf5_OnBeforeEventAdd($event, $lid, $arFields)
{
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
    try {
        $basket = $event->getBasket();
        $orderId = $basket->getOrderId();
        $order = $basket->getOrder();
        $deliveryServiceId = $order->getDeliveryIdList()[0];
        $deliveryService = \Bitrix\Sale\Delivery\Services\Table::getRowById($deliveryServiceId);

        $arOrderProps = CSaleOrderPropsValue::GetList(array("SORT" => "ASC"), array("ORDER_ID" => $orderId));

        $data = [
            "order" => [
                "id" => $orderId,
                "delivery" => $deliveryService["NAME"],
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

        $integration = new amoIntegration();
        $integration->start($data);

    } catch (\Throwable $th) {
        logger(['Throwable',$th->getMessage()]);
    }


}