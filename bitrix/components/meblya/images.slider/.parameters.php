<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
/**
*	PIS - parameter image slider
*/
if (!CModule::IncludeModule("iblock"))
	return;

$arIblockType = array(); 	//типы инфоблоков
$arIBlocks = array();			//инфоблоки
$arISections = array();		//разделы

//Выбираем все типы инфоблоков/////
$dbIBlockType = CIBlockType::GetList(
  array("sort" => "asc"),
  array("ACTIVE" => "Y")
);
while ($arIBlockType = $dbIBlockType->GetNext())
{
  if ($arIBlockTypeLang = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID))
    $arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockTypeLang["NAME"];
}
///Выбираем ифноблоки для выбранного типа/////
$dbIBlock = CIBlock::GetList(
  Array(), 
  Array(
    'TYPE'=>$arCurrentValues["IBLOCK_TYPE_ID"], 
    'ACTIVE'=>'Y', 
  ), true
);
while($arProp = $dbIBlock->GetNext()) {
	$arIBlocks[$arProp["ID"]] = "[".$arProp["ID"]."]".$arProp["NAME"];
}

//////////////////////////////////////////

$arComponentParameters = array(
	"GROUPS" => "",
	"PARAMETERS" => array(
		"IBLOCK_TYPE_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_TYPE_ID_NAME_PIS"),
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"TYPE" => "LIST",
			"VALUES" => $arIblockType
		),
		"CACHE_TIME" => array()
	)
);

if(!empty($arIBlocks)) 
{
	$arComponentParameters["PARAMETERS"]["IBLOCK_ID"] = array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_ID_NAME_PIS"),
			"REFRESH" => "Y",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks
	);
} 
?>