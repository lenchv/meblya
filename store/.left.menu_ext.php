<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(CModule::IncludeModule("iblock"))
{ 
  global $APPLICATION;
  $aMenuLinksExt = array();
  $iblocks = GetIBlockList(
    "furniture",
    Array(), 
    Array(),
    Array("sort"=>"asc")
  );
  while($arResult = $iblocks->GetNext())
  {
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
      "bitrix:menu.sections",
      "",
      Array(
          "ID" => $_REQUEST["ELEMENT_ID"],
          "IBLOCK_TYPE" => "furniture", 
          "IBLOCK_ID" => $arResult["ID"], 
          "SECTION_URL" => $arResult["LIST_PAGE_URL"]."/?SECTION_ID=#ID#",
          "DEPTH_LEVEL" => "2",
          "CACHE_TIME" => "3600" 
      )
    );
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
  }
} 
?> 