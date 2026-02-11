<?php

use OLM\SateliteHandler;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Парсер тест");
?>
<?php
CModule::IncludeModule("iblock");
include($_SERVER["DOCUMENT_ROOT"]."/test/parser/logArray.php");
include($_SERVER["DOCUMENT_ROOT"]."/test/parser/class.php");
include($_SERVER["DOCUMENT_ROOT"]."/test/parser/dataArrays.php");
include($_SERVER["DOCUMENT_ROOT"]."/test/parser/sateliteHandler.php");

/*
$arSelectPropertyId = array();
$properties = \AnkornCatalogPropApdater::GetIBlockProperties();
$arSelectPropertyId = $properties['arSelectPropertyId'];
$arHtmlProperty = $properties['arHtmlProperty'];
$arStringProperty = $properties['arStringProperty'];
$arProperty = $properties['arProperty'];

$items = \AnkornCatalogPropApdater::GetIBlockItemsList($properties, 5000, true);

foreach ($items as $item){
    set_time_limit(30);
    \OLM\AnkornCatalogPropApdater::addPropertyValue($item);
}
*/

$sateliteHandler  = new SateliteHandler();
// $sateliteHandler->testRun();

?>
    <div class="wrapper" style="margin: 40px 115px;">

        <h2>arHtmlProperty</h2>
        <table>
            <tbody>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>CODE</td>
                <td>ACTIVE</td>
                <td>PROPERTY_TYPE</td>
                <td>USER_TYPE</td>
            </tr>
            <?php foreach($arHtmlProperty as $prop):?>
                <tr>
                    <td><?=$prop["ID"]?></td>
                    <td><?=$prop["NAME"]?></td>
                    <td><?=$prop["CODE"]?></td>
                    <td><?=$prop["ACTIVE"]?></td>
                    <td><?=$prop["PROPERTY_TYPE"]?></td>
                    <td><?=$prop["USER_TYPE"]?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <h2>arStringProperty</h2>
        <table>
            <tbody>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>CODE</td>
                <td>ACTIVE</td>
                <td>PROPERTY_TYPE</td>
                <td>USER_TYPE</td>
            </tr>
            <?php foreach($arStringProperty as $prop):?>
                <tr>
                    <td><?=$prop["ID"]?></td>
                    <td><?=$prop["NAME"]?></td>
                    <td><?=$prop["CODE"]?></td>
                    <td><?=$prop["ACTIVE"]?></td>
                    <td><?=$prop["PROPERTY_TYPE"]?></td>
                    <td><?=$prop["USER_TYPE"]?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <?php
        if(LogArray::getLogArray()->data['content props']['main'])
            LogArray::getLogArray()->data['content props']['main'] = array_unique(LogArray::getLogArray()->data['content props']['main']);
        if(LogArray::getLogArray()->data['content props']['additional'])
            LogArray::getLogArray()->data['content props']['additional'] = array_unique(LogArray::getLogArray()->data['content props']['additional']);
        ?>

        <h2>Properties_0</h2>
        <table>
            <tbody>
            <tr>
                <td>HTML_prop</td>
                <td>IBLOCK_prop</td>
                <td>associated_prop</td>
                <td>associated_prop_ID</td>
            </tr>
            <? foreach(LogArray::getLogArray()->data['content props']['main'] as $prop):?>
                <tr>
                    <td style="border-top: 1px solid #000;"><?=$prop?></td>
                    <td style="border-top: 1px solid #000;"></td>
                    <td style="border-top: 1px solid #000;"><?=$associated_properties[$prop]['NAME']?></td>
                    <td style="border-top: 1px solid #000;"><?=$associated_properties[$prop]['ID']?></td>
                </tr>
            <? endforeach;?>
            </tbody>
        </table>

        <?php if($arStringProperty):?>
        <h2>Properties_1</h2>
        <table>
            <tbody>
            <tr>
                <td>HTML_prop</td>
                <td>IBLOCK_prop</td>
                <td>associated_prop</td>
                <td>associated_prop_ID</td>
            </tr>
            <?php foreach(LogArray::getLogArray()->data['content props']['additional'] as $prop):?>
                <tr>
                    <td style="border-top: 1px solid #000;"><?=$prop?></td>
                    <td style="border-top: 1px solid #000;"><?php if(in_array($prop, array_column($arStringProperty,"NAME" ))) echo $prop;?></td>
                    <td style="border-top: 1px solid #000;"><?=$associated_properties[$prop]['NAME']?></td>
                    <td style="border-top: 1px solid #000;"><?=$associated_properties[$prop]['ID']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?endif;?>



        <?php
        echo '<pre id="inspect" class="ins_1" style="margin: 40px 0px;">';
        //  var_dump($items);
        echo '</pre>';
        echo '<pre id="inspect" class="ins_2" style="margin: 40px 0px;">';
        // var_dump($arSelect);
        echo '</pre>';
        echo '<pre id="inspect" class="ins_2" style="margin: 40px 0px;">';
        // var_dump($associated_properties);
        echo '</pre>';









        ?>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>