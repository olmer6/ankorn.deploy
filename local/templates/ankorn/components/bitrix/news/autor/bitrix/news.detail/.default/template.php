<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<article role="article" class="article autor_detail">
    <div class="autor_img"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arResult["NAME"];?>"></div>
    <div class="autor_data">
        <h1 class="autor_name"><?=$arResult["NAME"];?></h1>
        <div class="autor_position"><?=$arResult["PROPERTIES"]["POSITION"]["VALUE"];?></div>
        <div class="autor_description"><?=$arResult["PREVIEW_TEXT"];?></div>
    </div>
</article>

<?php
    global $arFilter;
    $res = CIBlockElement::GetList(
        false, array("PROPERTY_AUTOR" => $arResult["ID"]), false,false, array("ID","IBLOCK_ID", "NAME"),
    );
    while($ob =$res->Fetch()){
        $IDs[] = $ob["ID"];
    }
    $IDs = array_chunk($IDs, 12);
    $pageCount = count($IDs);
    $arFilter["ID"] =($IDs[$_GET["autorPageNum"]])?:$IDs[0];
/*
    if($_GET["ajax"]=="Y") $APPLICATION->RestartBuffer();
    echo '<pre id="inspect" class="ins_0" style="display:none">';
    var_dump($_GET);
    echo '</pre>';
    echo '<pre id="inspect" class="ins_0" style="display:none">';
    var_dump($arFilter);
    echo '</pre>';
    if($_GET["ajax"]=="Y") die();
*/
?>
<script>
    pageNum = 1;
    pageCount = <?=$pageCount?>;
    $(document).ready(function(){
        $(".show_more").click(function(){
            console.log("pageNum");
            console.log(pageNum);
            $.get(
                window.location.href,
                {
                    'ajax':'Y',
                    'autorPageNum':pageNum
                },
                function(data){
                    data = data
                        .replace(/<section class="p-50">/g, '')
                        .replace(/<div class="container">/g, '');
                    console.log(data);
                    $(".articles-list").children(".row").append(data);

                }
            );
            pageNum++;
            if(pageNum>=pageCount) $(".btn-red.show_more").remove();
        })
    })
    $('get')
</script>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "articles_2_list",
    [
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "1",
        "NEWS_COUNT" => "12",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        "FIELD_CODE" => [
            0 => "NAME",
            1 => "PREVIEW_TEXT",
            2 => "PREVIEW_PICTURE",
            3 => "DETAIL_TEXT",
            4 => "",
        ],
        "PROPERTY_CODE" => [
            0 => "SHOW_COUNTER",
            1 => "",
        ],
        "DETAIL_URL" => "/articles/articles/#ELEMENT_CODE#/",
        "SECTION_URL" => "/articles/#SECTION_CODE#/",
        "IBLOCK_URL" => "/articles/",
        "SET_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "MESSAGE_404" => "",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "N",
        "SHOW_COUNTER" => "Y",
        "FILE_404" => "",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "CACHE_TYPE" => ($_GET["ajax"])?"N":"A",
        "CACHE_TIME" => ($_GET["ajax"])?"0":"36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Статьи",
        "PAGER_TEMPLATE" => "round",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "",
        "PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "N",
        "GROUP_PERMISSIONS" => [],
        "FILTER_NAME" => "arFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "CHECK_DATES" => "Y",
    ],
    $component
);
?>
<p class="" style="text-align: center;">
    <span class="btn-red show_more">Показать еще</span>
</p>
