<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

use Bitrix\Main\Localization\Loc;
?>



<div class="apply-form">
    <form class="default-form"  action="<?= POST_FORM_ACTION_URI ?>" method="POST" enctype="multipart/form-data">
        <?=bitrix_sessid_post()?>
        <div class="form-block">
            <div class="input-block">
                <input name="user_name" type="text" value="<?=$arResult['AUTHOR_NAME']?>" placeholder="Ваше имя" required/>
            </div>
            <div class="input-block">
                <input class="input-phone" name="user_phone" type="tel" value="<?=$arResult["AUTHOR_PHONE"]?>" placeholder="Номер телефона" required/>
            </div>
            <input id="checkFormAuth" class="inputbox hidden" name="checkFormAuth" type="text" value="">

            <div class="agree">
                <input type="checkbox" required>
                <p>
                    Я согласен с
                    <a href="/politika-konfidencialnosti/">Политикой конфиденциальности</a>
                </p>
            </div>

            <div class="input-submit">
                <input class="btn-red" type="submit" name="submit" value="Запрос">
            </div>
        </div>

        <!--COMF5 BEGIN-->
        <input name="FORM_NAME" type="hidden" value="podborpriibor">
        <!--COMF5 END-->

        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

    </form>
</div>
<?php if (!empty($arResult["ERROR_MESSAGE"])): ?>
    <span class="text-danger">Что то пошло не так</span>
<?php elseif (!empty($arResult["OK_MESSAGE"])): ?>
    <!--        <span class="text-success"><span class="ok-message">--><?php //=$arResult["OK_MESSAGE"]?><!--</span></span>-->
    <script>
        $('.text-success').fadeIn();
        $('.modal__window-desc, .modal__window-form').fadeOut();

        // $('.agree input').prop('checked', true)

        $(".input-phone").mask("+7 (999) 999-9999");
        ym(45467883,'reachGoal','vh-choose-device')
    </script>
<?php endif; ?>
