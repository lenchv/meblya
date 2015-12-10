<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?

if (!CModule::IncludeModule("iblock"))
	return;

$arIblockType = array(); 	//типы инфоблоков

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


$arComponentParameters = array(
	"GROUPS" => "",
	"PARAMETERS" => array(
		"IBLOCK_TYPE_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_TYPE_ID_NAME"),
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"TYPE" => "LIST",
			"VALUES" => $arIblockType
		),
		"PATH_TO_BASKET" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("PATH_TO_BASKET_NAME"),
			"TYPE" => "TEXT",
			"DEFAULT" => "/personal/basket.php"
		),
		"PAGE_ELEMENT_COUNT" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("PAGE_LIMIT"),
			"TYPE" => "TEXT",
			"DEFAULT" => "10"
		),
		"CACHE_TIME" => array()
	)
);
?>