<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("МЕБЛЯ. Корзина");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"",
	Array(
		"OFFERS_PROPS" => array(),
		"PATH_TO_ORDER" => "/personal/order.php",
		"HIDE_COUPON" => "N",
		"COLUMNS_LIST" => array("NAME", "DISCOUNT", "WEIGHT", "PROPS", "DELETE", "DELAY", "TYPE", "PRICE", "QUANTITY", "SUM", "PROPERTY_BLOG_POST_ID", "PROPERTY_BLOG_COMMENTS_CNT", "PROPERTY_ARTNUMBER", "PROPERTY_MANUFACTURER", "PROPERTY_COUNTRY", "PROPERTY_STYLE", "PROPERTY_COLOR", "PROPERTY_MATERIAL", "PROPERTY_EDGE", "PROPERTY_METALFRAME", "PROPERTY_REGULATION", "PROPERTY_GLASS"),
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "action"
	),
false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>