<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
use Bitrix\Main;
Main\Loader::includeModule('blog');



$arNavPage = explode("#",$arResult["NAV_STRING"], 20);
$arResult["NAV_RECORD_COUNT"] = (intval($arNavPage[0]) > 0 ? intval($arNavPage[0]) : 0);
$arResult["NAV_FIRST_RECORD_SHOW"] = (intval($arNavPage[1]) > 0 ? intval($arNavPage[1]) : 0);
$arResult["NAV_LAST_RECORD_SHOW"] = (intval($arNavPage[2]) > 0 ? intval($arNavPage[2]) : 0);

$arResult["NAV_STRING"] = substr($arResult["NAV_STRING"], strlen($arResult["NAV_RECORD_COUNT"].$arResult["NAV_FIRST_RECORD_SHOW"].$arResult["NAV_LAST_RECORD_SHOW"])+2);

/*****************************************************************/
//Для картинок из торговых предложений
$arSKUPropList = array();
if ($arResult['MODULES']['catalog'])
{
	$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
	$boolSKU = !empty($arSKU) && is_array($arSKU);
	if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS']) && 'Y' == $arParams['PRODUCT_DISPLAY_MODE'])
	{
		$arSKUPropList = CIBlockPriceTools::getTreeProperties(
			$arSKU,
			$arParams['OFFER_TREE_PROPS'],
			array(
				'PICT' => $this->GetFolder().'/images/no_photo.png',
				'NAME' => '-'
			)
		);

		$arNeedValues = array();
		CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
	}
}
$arResult['SKU_PROPS'] = $arSKUPropList;
unset($arSKUPropList);
/******************************************************************/

foreach($arResult["ITEMS"] as $key => $arItem)
{
	$arRes = array();
	//Если количество коментариев не установлено, то подгрузить их из БД
	if ($arItem['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE'] === "")
	{
		if ($arItem['PROPERTIES']['BLOG_POST_ID']['ID'] !== "") {
			$iCommentId = $arItem['PROPERTIES']['BLOG_POST_ID']['ID'];
		} else {
			$iCommentId = (int)CIBlockElement::GetProperty(
															$arItem["IBLOCK_ID"], 
															$arItem["ID"], 
															array("sort" => "asc"), 
															array("CODE"=>CIBlockPropertyTools::CODE_BLOG_POST)
														)->GetNext()["ID"];
		}
		$dbProp = CIBlockElement::GetList(array(), array("ID" => $arItem["ID"]), false, array(), array("PROPERTY_".$iCommentId, "ID"));
		$rsPosts = CBlogPost::GetList(
			array(),
			array('ID' => $dbProp->GetNext()["PROPERTY_".$iCommentId."_VALUE"]),
			false,
			false,
			array('NUM_COMMENTS')
		);
		$arResult['ITEMS'][$key]['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE'] = $rsPosts->GetNext()['NUM_COMMENTS'];
		unset($iCommentId, $dbProp, $rsPosts);
	}
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $arItem["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;


	if (!empty($arItem['OFFERS'])) {
		$arOfferProps = array();
		foreach ($arItem['OFFERS'] as $offerKey => $arOffer) {
			$arOfferProps['ID'] = $arOffer['ID'];
			$colID = $arResult['SKU_PROPS']['COLOR']['XML_MAP'][$arOffer['DISPLAY_PROPERTIES']['COLOR']['VALUE']];
			$arOfferProps['COLOR'] = $arResult['SKU_PROPS']['COLOR']['VALUES'][$colID]['PICT'];
			$arOfferProps['AVAILABLE'] = ( 'N' === $arOffer['CATALOG_AVAILABLE'] ? "Нет в наличии" : "Есть на складе");
			$arOfferProps['PRICE'] = ( $arOffer['PRICES']['RETAIL']['PRINT_DISCOUNT_VALUE'] == '' ?  $arOffer['PRICES']['RETAIL']['PRINT_VALUE'] : $arOffer['PRICES']['RETAIL']['PRINT_DISCOUNT_VALUE']);
			$arOfferProps['CAN_BUY'] = $arOffer['CAN_BUY'] != '';


			$arResult['ITEMS'][$key]['MY_OFFERS'][$arOfferProps['ID']] = $arOfferProps;
		}
		unset($arOfferProps);
	}
}

?>