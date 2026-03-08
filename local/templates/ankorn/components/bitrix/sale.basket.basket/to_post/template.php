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

<h3>Состав заказа</h3>
<table>
    <tr>
        <th>Наименование</th>
        <th style="text-align: center;">количество</th>
        <th style="text-align: center;">цена</th>
    </tr>

    <?php foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem):?>
    <tr>
        <td><?=$arItem['NAME']?></td>
        <td style="text-align: center;"><?=$arItem['QUANTITY']?></td>
        <td style="text-align: right;"><?=$arItem['SUM_FULL_PRICE_FORMATED']?></td>
    </tr>
    <?php endforeach;?>
</table>
<h3>Итого: <?=$arResult['allSum_FORMATED']?></h3>