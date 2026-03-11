<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

?>


Состав заказа
<?php foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem):?>
------
Наименование: <?=$arItem['NAME']?>,
количество: <?=$arItem['QUANTITY']?>,
цена: <?=$arItem['SUM_FULL_PRICE']?> руб.
<?php endforeach;?>
-----
Итого: <?=$arResult['allSum']?> руб.

