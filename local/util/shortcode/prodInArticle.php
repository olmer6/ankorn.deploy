<?php
namespace local\util\shortcode;

class ProdInArticle
{
    const prodIB = 2;
    const newsListTemplate = 'In_article';

    public static function insertingProductsIntoText(string $text, array $prodIDs = []):string
    {

        $splitedText = static::splitText($text);

        $i=0;
        foreach($splitedText as &$prods){
            if(!is_numeric($prods))continue;
            $tmpProds = [];
            for($j=0;$j<$prods;$j++){

                if($prodIDs[$i]){
                    $tmpProds[] = $prodIDs[$i];
                    $i++;
                }

            }
            if($tmpProds) $prods = static::newsListStr($tmpProds);
            else $prods = '';
        }
        $text = implode($splitedText);
        return $text;
    }

    public static function splitText(string $text = null):array
    {
        $result = preg_split('/\{\{PROD (\d{1,3})\}\}/', $text, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
        return $result;
    }
    public static function newsListStr(array $IDs = [], array $params = []):string
    {
        if(empty($IDs)) return '';
        global $arFilter;
        $arFilter = ["ID" => $IDs];
        $params = $params + Array(
            "IBLOCK_TYPE" => "products",    // Тип информационного блока
            "IBLOCK_ID" => static::prodIB,         // ID инфоблока с новостями
            "FILTER_NAME" => "arFilter",
        );

        ob_start();
        global $APPLICATION;
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            static::newsListTemplate,
            $params,
            false
        );
        $newsListStr = ob_get_clean();
        return $newsListStr;
    }
}