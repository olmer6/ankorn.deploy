<?php

namespace local\util\catalog\lib;

use CIBlock;
use CIBlockSection;
Class DescendantSections
{
    const prodIBid = 2;

    const sefUrl = "catalog/#SECTION_CODE_PATH#/";

    public static function printDescendantSections(int $id = null, $sectionUrlTemplate)
    {
        $sections = self::getList($id, $sectionUrlTemplate);
        if(count($sections)==0) return false;
        usort($sections, "self::sortBySort");
        $html = self::htmlCreate($sections);
        echo $html;
    }
    public static function getList($id = null, $sectionUrlTemplate):array
    {
        $sections = self::getAllSectionList();
        $sections = self::definingAncestors($sections);
        $sections = self::filterByCurrentSectionId($sections, $id);
        $sections = self::addSectionCodePath($sections, $sectionUrlTemplate);
        return $sections;
    }

    private static function filterByCurrentSectionId(array $sections, int $id = null):array
    {
        if(!$id) return $sections;
        $filteredSections = [];
        foreach ($sections as $section) {
            if (is_array($section['PARENT_IDS']) && in_array($id, $section['PARENT_IDS'])) {
                $filteredSections[] = $section;
            }
        }
        return $filteredSections;
    }

    private static function definingAncestors(array $sections):array
    {
        $maxDepthLevel = self::maxDepthLevel($sections);
        for($i = 0; $i <= $maxDepthLevel; $i++){
            foreach($sections as $key=>&$section){
                $level = $i;
                if($section["DEPTH_LEVEL"] != $level) continue;
                $parentId = $section["IBLOCK_SECTION_ID"];
                if(empty($parentId)) continue;
                if($sections[$parentId]["PARENT_IDS"])
                    $sections[$key]["PARENT_IDS"] = $sections[$parentId]["PARENT_IDS"];
                else $sections[$key]["PARENT_IDS"]=[];
                $sections[$key]["PARENT_IDS"][] = $section["IBLOCK_SECTION_ID"];
                if($sections[$parentId]["PARENT_CODE"])
                    $sections[$key]["PARENT_CODE"] = $sections[$parentId]["PARENT_CODE"];
                else $sections[$key]["PARENT_CODE"] = [];
                $sections[$key]["PARENT_CODE"][] = $sections[$parentId]["CODE"];
            }
        }
        return $sections;
    }
    private static function addSectionCodePath(array $sections, $sectionUrlTemplate):array
    {
        if($sectionUrlTemplate == self::sefUrl){
            foreach($sections as $key=>&$section) {
                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/' . str_replace('#SECTION_CODE_PATH#', $section['CODE'], $sectionUrlTemplate).'/';
                else {
                    $sections[$key]['SECTION_CODE_PATH'] =  '/' . str_replace('#SECTION_CODE_PATH#', implode("/", $section['PARENT_CODE']), $sectionUrlTemplate) . $section['CODE'] . '/';
                }
            }
        }
        else if ($sectionUrlTemplate == "catalog/#FIRST_LEVEL_SECTION_CODE#/#SECTION_CODE#/" ){
            foreach($sections as $key=>&$section) {
                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/catalog/'.$section['CODE'].'/';
                else {
                    $sections[$key]['SECTION_CODE_PATH'] = '/catalog/'.array_shift($section['PARENT_CODE']).'/'.$section['CODE'].'/';

                }
            }
        }
        else if ($sectionUrlTemplate == "catalog/#SECTION_CODE#/"){
            foreach($sections as $key=>&$section) {
                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/catalog/'.$section['CODE'].'/';
                else {
                    $sections[$key]['SECTION_CODE_PATH'] = '/catalog/'.array_shift($section['PARENT_CODE']).'/'.$section['CODE'].'/';
                }
            }
        }
        return $sections;
    }
    private static function sortBySort(array $a, array $b)
    {
        if ($a['SORT'] == $b['SORT'])return 0;
        return ($a['SORT'] < $b['SORT']) ? -1 : 1;
    }

    private static function getAllSectionList()
    {
        $sections = [];
        $obSections = CIBlockSection::GetList(
            array('LEFT_MARGIN' => 'ASC'),
            array('IBLOCK_ID' => self::prodIBid,'ACTIVE' => 'Y','GLOBAL_ACTIVE' => 'Y',),
            false,
            array('ID', 'NAME', 'SECTION_PAGE_URL', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SORT', 'LEFT_MARGIN')
        );
        while ($section = $obSections->fetch()){
            $sections[$section['ID']] = $section;
        }
        return $sections;
    }
    private static function maxDepthLevel(array $sections):int
    {
        $maxDepthLevel = 0;
        foreach ($sections as $section){
            if ($section['DEPTH_LEVEL'] > $maxDepthLevel){
                $maxDepthLevel = $section['DEPTH_LEVEL'];
            }
        }
        return $maxDepthLevel;
    }

    private static function htmlCreate(array $sections):string
    {
        ob_start();
        ?>
        <div class="col section-list-wrap">
            <div class="show-more">
                <div class="show">Показать еще</div>
                <div class="hide">Скрыть</div>
            </div>
            <ul class="catalog-section-list-tile-list row mb-4">
                <?foreach($sections as $section){?>
                <li class="col-lg-2 col-md-3 col-sm-4 col-6 catalog-section-list-item">
                    <div class="catalog-section-list-item-inner">
                        <h3 class="catalog-section-list-item-title">
                            <a class="catalog-section-list-item-link" href="<?=$section["SECTION_CODE_PATH"]?>">
                                <?=$section["NAME"]?> </a>
                        </h3>
                    </div>
                </li>
                <?}?>
            </ul>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}