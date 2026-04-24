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
                    <input name="user_name" type="text" value="<?=$arResult['AUTHOR_NAME']?>" placeholder="* Ваше имя" required/>
                </div>
                <div class="input-block">
                    <input  name="user_email" type="email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="* Email" required/>
                </div>
                <div class="textarea-block">
                    <div class="placeh">
                        Комментарий <br>
                        <i>Коротко опишите какая задача перед вами стоит и какие условия эксплуатации: среда, температура, давление — подберём точнее</i>
                    </div>
                    <textarea name="MESSAGE" id="" cols="30" rows="10" value="<?=$arResult["TEXT"]?>" placeholder=" " title="Коротко опишите какая задача перед вами стоит и какие условия эксплуатации: среда, температура, давление — подберём точнее"></textarea>
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
                    <input class="btn-red" type="submit" name="submit" value="Отправить">
                </div>
            </div>

            <!--COMF5 BEGIN-->
            <input name="FORM_NAME" type="hidden" value="form">
            <!--COMF5 END-->

            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

        </form>
    </div>
    <?php if (!empty($arResult["ERROR_MESSAGE"])): ?>
        <span class="text-danger">Что то пошло не так</span>
    <?php elseif (!empty($arResult["OK_MESSAGE"])): ?>
        <div class="text-success" style="padding: 10px; display: block; text-align: center; color: green;"><span class="ok-message">Сообщение успешно отправлено</span></div>
        <script>
            // $('.text-success').fadeIn();
            // $('.modal__window-desc, .modal__window-form').fadeOut();
            
            // $('.agree input').prop('checked', true)

            $(".input-phone").mask("+7 (999) 999-9999");
            ym(45467883,'reachGoal','form-contaсt')
        </script>
    <?php endif; ?>
<style>
    .textarea-block {
        position: relative;
    }
    .textarea-block textarea:placeholder-shown{
        background: transparent;
    }
    .apply-form .default-form .placeh {
        position: absolute;
        max-width: 100%;
        max-height: 100%;
        height: 120px;
        top: 0;
        left: 0;
        padding: 15px 17px;
        font-size: 14px;
        z-index: -1;
        background: #fff;
    }
</style>