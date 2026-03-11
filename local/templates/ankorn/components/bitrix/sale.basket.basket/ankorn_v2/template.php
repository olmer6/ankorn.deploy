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
<script src="/bitrix/js/main/core/core.js"></script>
<script src="/bitrix/js/main/core/core_ajax.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/assets/jquery.maskedinput.js"></script>

    <div class="cart-page">
        <h1 class="catalog-h1">
            Корзина
        </h1>
        <div class="cart-container">
            <?foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem):?>

                <? $res = CIBlockElement::GetList(
                    [],['IBLOCK_ID' => 2, 'ID' => $arItem['PRODUCT_ID']],false,false,['ID','IBLOCK_ID', 'PROPERTY_PARAM_AVAILABLE']
                );
                if ($arFields = $res->GetNext()) {
                    $available = $arFields['PROPERTY_PARAM_AVAILABLE_VALUE_ID']; // 'Y' или 'N'
                }?>

            <div class="cart_v2-item"  id="basket-item-<?=$arItem['ID']?>" data-item-id="<?=$arItem['ID']?>">

                <div class="cart_v2-item-title">
                    <div class="title">Наименование</div>
                    <div class="value-wrapper">
                        <div class="cart_v2-item-image">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE_SRC']?>" alt="<?=$arItem['NAME']?>"></a>
                        </div>
                        <h3><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
                    </div>
                </div>

                <div class="cart_v2-item-delivery-time">
                    <div class="title">Срок отгрузки</div>
                    <div class="value-wrapper">
                        <?if($available):?>
                            <span> от 1 дня</span>
                        <?else:?>
                            <span> до 79 дней</span>
                        <?endif?>
                    </div>

                </div>

                <div class="cart_v2-item-price-wrap">
                    <div class="title">цена</div>
                    <div class="value-wrapper">
                        <div class="cart_v2-item-price" data-id="<?=$arItem['ID']?>"><?=$arItem['PRICE_FORMATED']?></div>
                        <div class="cart_v2-item-price-per">цена за 1 шт</div>
                    </div>
                </div>

                <div class="cart_v2-item-quantity">
                    <div class="title">Количество</div>
                    <div class="value-wrapper">
                        <div class="quantity-controls">
                            <button class="qty-minus" data-item-id="<?=$arItem['ID']?>">-</button>
                            <input type="text" value="<?=$arItem['QUANTITY']?>" min="1" class="qty-input"  data-item-id="<?=$arItem['ID']?>">
                            <button class="qty-plus" data-item-id="<?=$arItem['ID']?>">+</button>
                        </div>
                    </div>
                </div>

                <div class="item-total">
                    <div class="title">Стоимость</div>
                    <div class="value-wrapper">
                        Сумма: <span class="item-total-price" data-id="<?=$arItem['ID']?>"><?=$arItem['SUM_FULL_PRICE_FORMATED']?></span>
                        <div class="btn-remove"  data-item-id="<?=$arItem['ID']?>"></div>
                    </div>
                </div>

            </div>
            <? endforeach;?>
        </div>

        <div class="form-container">
            <form action="/personal/cart/placeOrderAjaxHandler.php" id="place_order">
                <div class="inputs">
                    <div id="place_order_error"></div>
                    <input name="USER_NAME" type="text" placeholder="Контактное лицо*">
                    <input name="EMAIL" type="email" placeholder="e-mail *">
                    <input name="PHONE" type="tel" placeholder="номер телефона*">
                    <textarea name="COMMENT" id="" cols="30"rows="10" placeholder="комметарий к заказу"></textarea>
                </div>
                <div class="cart-data">
                    <h3>Ваш заказ</h3>
                    <div class="order-data">
                        <h3 class="full-summ">Итого: <span data-entity="basket-total-price"><?=$arResult['allSum_FORMATED']?></span></h3>
                        <p><strong>НДС (22%, включен в цену):</strong> <span data-entity="basket-total-vat"></span> </p>
                        <p><strong>Доставка:</strong> Транспортной компанией</p>
                    </div>


                    <div class="approval">Заполняя поля и нажимая кнопку «Отправить», вы подтверждаете, что ознакомлены и согласны с Политикой в отношении обработки персональных данных.</div>

                    <button type="submit" class="btn-red" >Оформить заказ</button>

                </div>
            </form>
        </div>
    </div>
