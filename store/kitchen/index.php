<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
include(".section.php");
$APPLICATION->SetTitle($sSectionName);
$APPLICATION->SetDirProperty("section_name", $sSectionName);
?>Кухня<?$APPLICATION->IncludeComponent(
	"meblya:images.slider", 
	"for_section", 
	array(
		"COMPONENT_TEMPLATE" => "for_section",
		"IBLOCK_TYPE_ID" => "images",
		"IBLOCK_ID" => "11",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>