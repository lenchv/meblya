<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
    	"ID" => $_REQUEST["ELEMENT_ID"],
        "IBLOCK_TYPE" => "furniture", 
        "IBLOCK_ID" => "5", 
        "SECTION_URL" => "/store/decoration/?SECTION_ID=#ID#",
        "DEPTH_LEVEL" => "2",
        "CACHE_TIME" => "3600" 
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?> 