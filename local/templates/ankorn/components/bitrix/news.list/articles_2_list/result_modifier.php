<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

/** подсчет просмотров */
$results=[];
$res = CIBlockElement::GetList(
    ['SORT' => 'ASC'],
    ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y"],
    false,false,
    ["IBLOCK_ID","ID","NAME",'SHOW_COUNTER','SHOW_COUNTER_START']
);
while($ar_res = $res->GetNext()){
    $results[$ar_res["ID"]]=$ar_res;
}
$arResult["HITS"]=$results;
foreach($arResult["ITEMS"] as &$item){
    $item["SHOW_COUNTER"]=$results[$item["ID"]]["SHOW_COUNTER"];
}