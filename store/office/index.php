<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
include(".section.php");
$APPLICATION->SetTitle($sSectionName);
$APPLICATION->SetDirProperty("section_name", $sSectionName);
?>Офис 
<br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"meblya_catalog", 
	array(
		"SECTIONS_VIEW_MODE" => "TILE",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"TEMPLATE_THEME" => "green",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "Y",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
		),
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"MESS_BTN_BUY" => "ХОЧУ!",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"DETAIL_USE_VOTE_RATING" => "Y",
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "N",
		"DETAIL_BRAND_USE" => "N",
		"USE_SALE_BESTSELLERS" => "N",
		"USE_BIG_DATA" => "N",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_POSITION" => "top left",
		"AJAX_MODE" => "N",
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "furniture",
		"IBLOCK_ID" => "3",
		"USE_FILTER" => "Y",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "N",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_TOP_DEPTH" => "2",
		"PAGE_ELEMENT_COUNT" => "3",
		"LINE_ELEMENT_COUNT" => "",
		"ELEMENT_SORT_FIELD" => "",
		"ELEMENT_SORT_ORDER" => "",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"INCLUDE_SUBSECTIONS" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"SHOW_DEACTIVATED" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"PRICE_CODE" => array(
			0 => "RETAIL",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
			0 => "METALFRAME",
		),
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "N",
		"USE_STORE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"PAGER_TEMPLATE" => "meblya_nav",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "BLOG_POST_ID",
			1 => "ARTNUMBER",
			2 => "BLOG_COMMENTS_CNT",
			3 => "EDGE",
			4 => "MATERIAL",
			5 => "METALFRAME",
			6 => "MANUFACTURER",
			7 => "COUNTRY",
			8 => "REGULATION",
			9 => "GLASS",
			10 => "STYLE",
			11 => "COLOR",
			12 => "",
		),
		"COMPARE_OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "COUNTRY",
			1 => "COLOR",
			2 => "ARTNUMBER",
			3 => "",
		),
		"COMPARE_ELEMENT_SORT_FIELD" => "sort",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "COLOR",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "5",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "COLOR",
			1 => "",
		),
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "UAH",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COUNTRY",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "meblya_catalog",
		"SIDEBAR_SECTION_SHOW" => "N",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SECTIONS_HIDE_SECTION_NAME" => "N",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_ELEMENT_SORT_FIELD" => "shows",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "5",
		"TOP_VIEW_MODE" => "SLIDER",
		"TOP_ROTATE_TIMER" => "30",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "EDGE",
			1 => "MATERIAL",
			2 => "METALFRAME",
			3 => "COUNTRY",
			4 => "REGULATION",
			5 => "COLOR",
			6 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "RETAIL",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"LINE_ELEMENT_COUNT_MY" => "thrice",
		"VARIABLE_ALIASES" => array(
			"ELEMENT_ID" => "ELEMENT_ID",
			"SECTION_ID" => "SECTION_ID",
		)
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"meblya:articles.preview",
	"for_section",
	Array(
		"IBLOCK_TYPE_ID" => "articles",
		"SORT" => "timestamp_x",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000000",
		"CACHE_NOTES" => "",
		"IBLOCK_ID" => "14"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>