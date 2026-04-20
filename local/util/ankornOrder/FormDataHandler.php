<?php

namespace local\util\ankornOrder;

use CUser;
use CFile;
use Context;
use Sale\Order;
use Sale\Fuser;
use Sale\Basket;

class FormDataHandler
{
    static function fileSave($fileDetails, string $directory = 'otherFiles'):int
    {
        $fileID = CFile::SaveFile(
            [
                "name" => $fileDetails['name'],
                "size" => $fileDetails['size'],
                "tmp_name" => $fileDetails['tmp_name'],
                "type" => $fileDetails['type'],
            ],
            $directory
        );
        return $fileID;
    }
    static function getUserId(string $userName, string $email, string $phone):int
    {
        global $USER;
        if($userId = $USER->getID())
            return $userId;

        $userId = 0;
        $user = new CUser;
        // Ищем пользователя по логину (телефон)
        $resUser = CUser::GetList(
            ($by = 'ID'),
            ($order = 'ASC'),
            ['LOGIN' => $phone],
        //    ['FIELDS' => ['ID']]
        );
        if ($arUser = $resUser->Fetch()) {
            $userId = $arUser['ID'];
        } else {
            // Пользователь не найден — создаём нового
            $password = \randString(8); // генерируем пароль

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
        return $userId;
    }
    static function getToPostCartHtml($APPLICATION):string
    {
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
        return $basketComposition;
    }
    static function getToComf5CartHtml($APPLICATION):string
    {
        ob_start();
        $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket",
            "to_comf5",
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
        $Comf5BasketComposition = ob_get_clean();
        return $Comf5BasketComposition;
    }
}