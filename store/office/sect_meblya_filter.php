<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"visual_vertical",
	Array(
		"TEMPLATE_THEME" => "blue",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"IBLOCK_TYPE" => "furniture",
		"IBLOCK_ID" => "3",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"FILTER_NAME" => "arrFilter",
		"PRICE_CODE" => array("RETAIL"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"INSTANT_RELOAD" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "-",
		"SECTION_DESCRIPTION" => "-",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "UAH"
	)
);?> 