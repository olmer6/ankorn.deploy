<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("произвольный код");
CModule::IncludeModule("iblock");
?>
<div class="wrapper" style="margin: 40px 115px;">
    <?php

    \local\util\catalog\lib\DescendantSections::printDescendantSections(5);

    echo '<pre id="inspect" class="ins_1" style="margin: 40px 0px;">';
    var_dump(\local\util\catalog\lib\DescendantSections::getList());
    echo '</pre>';
    ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>