<?php
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ успешно зарегистрирован");
?>

    <div class="order-success">
        <h2 class="title" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/spasibo100.png');">Спасибо! Ваш заказ зарегистрирован.</h2>
        <div class="content-area">
            <p>В течение 1 часа наш технический специалист свяжется с вами для подтверждения корректности подбора оборудования и выставления счета.</p>
            <p>Подтверждение отправлено на вашу электронную почту.</p>
            <p>Если письмо отсутствует во входящих, рекомендуем проверить папку «Спам».</p>
        </div>
    </div>






<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>