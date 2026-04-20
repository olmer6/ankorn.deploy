<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("произвольный код");
CModule::IncludeModule("iblock");
?>
    <div class="wrapper" style="margin: 40px auto; max-width: 800px">

<?

local\util\catalog\lib\CurrencyCBRFUploader::getCurrency();

?>

</div><?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>