<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?> <?
	include(".section.php");
	$APPLICATION->SetTitle("Недавно просмотренные");
	$APPLICATION->AddChainItem($APPLICATION->GetTitle());
	$APPLICATION->SetDirProperty("section_name", $sSectionName);
?><?$APPLICATION->IncludeComponent(
	"meblya:recently.viewed",
	"all_products",
	Array(
		"IBLOCK_TYPE_ID" => "furniture",
		"PATH_TO_BASKET" => "/personal/basket.php",
		"PAGE_ELEMENT_COUNT" => "1000",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => ""
	)
);?><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>