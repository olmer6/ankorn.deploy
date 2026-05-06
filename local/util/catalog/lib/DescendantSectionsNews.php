<?php

namespace local\util\catalog\lib;

use CIBlock;
use CIBlockSection;

class DescendantSectionsNews extends DescendantSections
{
    const IBid = 1;

    const sefUrl = "articles/#SECTION_CODE_PATH#/";

    protected static function addSectionCodePath(array $sections, $sectionUrlTemplate):array
    {
        if($sectionUrlTemplate == static::sefUrl){
            foreach($sections as $key=>&$section) {

                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/' . str_replace('#SECTION_CODE_PATH#', $section['CODE'], $sectionUrlTemplate);
                else {
                    $sections[$key]['SECTION_CODE_PATH'] =  '/' . str_replace('#SECTION_CODE_PATH#', implode("/", $section['PARENT_CODE']), $sectionUrlTemplate) . $section['CODE'] ;
                }
            }
        }
        else if ($sectionUrlTemplate == "articles/#FIRST_LEVEL_SECTION_CODE#/#SECTION_CODE#/" ){
            foreach($sections as $key=>&$section) {
                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/articles/'.$section['CODE'].'/';
                else {
                    $sections[$key]['SECTION_CODE_PATH'] = '/articles/'.array_shift($section['PARENT_CODE']).'/'.$section['CODE'].'/';

                }
            }
        }
        else if ($sectionUrlTemplate == "articles/#SECTION_CODE#/"){
            foreach($sections as $key=>&$section) {
                if($section["DEPTH_LEVEL"] == 1)
                    $sections[$key]['SECTION_CODE_PATH'] = '/articles/'.$section['CODE'].'/';
                else {
                    $sections[$key]['SECTION_CODE_PATH'] = '/articles/'.array_shift($section['PARENT_CODE']).'/'.$section['CODE'].'/';
                }
            }
        }
        $sections[0]['SECTION_CODE_PATH'] = "/articles/";
        $sections[0]['NAME'] = "все статьи";
        return $sections;
    }
}
