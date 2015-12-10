<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
/**
* Обработка AJAX запроса добавления в корзину
*/
if($_REQUEST['ajax']=='Y') {
	$APPLICATION->RestartBuffer();
	include("ajax.php");
	die();
}
?>

<?
/**
*	@return arResult[ID - ИД элемента => [
*			"ID" 					- идентификатор элемента
*			"NAME" 					- имя элемента
*			"IBLOCK_SECTION_ID"		- ид раздела
*			"IBLOCK_TYPE_ID" 		- тип инфоблока
*			"IBLOCK_ID" 			- инфоблок
* 			"DETAIL_PAGE_URL" 		- страница детального просмотра товара
*			"PRICE" 				- базовая цена
*			"PRICE_WITH_DISCOUNT" 	- цена с учетом скидки
*			"PRODUCT_ID" 			- ИД товара
*			"ARTNUMBER" 			- артикул
*			"IMAGE" 				- путь к изображению
*			"REVIEW_COUNT" 			- количество коментариев к товару
*		]
*	]
*/

use Bitrix\Main;
use Bitrix\Iblock;
use Bitrix\Catalog;

if ($this->StartResultCache()) {
	if (!Main\Loader::IncludeModule("iblock") ||
		!Main\Loader::includeModule('catalog') ||
		!Main\Loader::includeModule('sale') ||
		!Main\Loader::includeModule('blog'))
	{	
		$this->AbortResultCache();
		return;
	}
	
	$arFilterV["SITE_ID"] = SITE_ID;
    $arFilterV["FUSER_ID"] = CSaleBasket::GetBasketUserID();

    $viewedIterator = \Bitrix\Catalog\CatalogViewedProductTable::getList(
    	array(
            'order' => array("DATE_VISIT" => "DESC"),
            'filter' => $arFilterV,
            'select' => array("ELEMENT_ID", "PRODUCT_ID"),
            'limit' => $arParams["PAGE_ELEMENT_COUNT"]
        ));
        
	while($arItems = $viewedIterator->fetch())
	{
    	$arResult[$arItems["ELEMENT_ID"]] = $arItems["PRODUCT_ID"];
	}
	unset($arItems, $viewedIterator);
	if (!empty($arResult)) 
	{
		$arIblockId = array();
		$strImageStorePath = COption::GetOptionString("main", "upload_dir", "upload");
		$arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID", "IBLOCK_TYPE_ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "CATALOG_GROUP_RETAIL", "PREVIEW_PICTURE", "DETAIL_PICTURE");
		$elementIterator =CIBlockElement::GetList(	
			array(), 
			array("ID" => array_keys($arResult), "IBLOCK_TYPE_ID" => $arParams["IBLOCK_TYPE_ID"]),
			false, 
			array(), 
			$arSelect
		);
		unset($arSelect);
		while ($el = $elementIterator->GetNext()) 
		{
			$iProductId = $arResult[$el["ID"]];
	    	//Если запрос не вернул цену товара, то возможно это товар с торговым предложением, поэтому получаем его базовую цену этого товара
			if ($el["CATALOG_PURCHASING_PRICE"] == "") {
				$arPrice = CPrice::GetBasePrice($iProductId);
				$el["CATALOG_PURCHASING_PRICE"] = $arPrice["PRICE"];
				$el["CATALOG_PURCHASING_CURRENCY"] = $arPrice["CURRENCY"];
			}
			//получаем скидку для товара
			$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
	            $iProductId,
	            $USER->GetUserGroupArray(),
	            "N",
	            1,
	            SITE_ID
	        );

	        //получаем цену в зависимости от скидки
	        $discountPrice = false;
	        if ($arDiscounts) {
	        	$discountPrice = CCatalogProduct::CountPriceWithDiscount(
			        $el["CATALOG_PURCHASING_PRICE"],
			       	$el["CATALOG_PURCHASING_CURRENCY"],
			        $arDiscounts
			    );
	        }
			// путь к директории, где хранятся изображения
			$imageId = (empty($el["DETAIL_PICTURE"])? $el["PREVIEW_PICTURE"] : $el["DETAIL_PICTURE"]);
			if (!empty($imageId)) {
				/*Неэффективный кусок кода*/
				$sPath = CFile::GetByID($imageId)->GetNext();
				/**********************************/
				$sPath = "/".$strImageStorePath."/".$sPath["SUBDIR"]."/".$sPath["FILE_NAME"];
			} else {
				$sPath = "";
			}
			$price = CCurrencyLang::GetCurrencyFormat ($el["CATALOG_PURCHASING_CURRENCY"], "ru")["FORMAT_STRING"];
			$arResult[$el["ID"]] = $el;
			$arResult[$el["ID"]]["PRICE"] = str_replace("#", $el["CATALOG_PURCHASING_PRICE"], $price);
			$arResult[$el["ID"]]["PRICE_WITH_DISCOUNT"] = (($discountPrice)? str_replace("#", $discountPrice, $price) : "");
			$arResult[$el["ID"]]["PRODUCT_ID"] = $iProductId;
			/*Неэффективный кусок кода*/
			$arResult[$el["ID"]]["ARTNUMBER"] = CIBlockElement::GetProperty($el["IBLOCK_ID"], $el["ID"], array(), array("CODE"=>"ARTNUMBER"))->GetNext()["VALUE"]; //Получение артикула, для каждого инфоблока свой артикул, поэтому нельзя выбрать для всех сразу
			/**********************************/
			$arResult[$el["ID"]]["IMAGE"] = $sPath;
			/***Получение количества товара с учетом наличия его на складе***/
			$arProd = (int)CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $iProductId, "STORE_ID" => 1), false, false, array('AMOUNT'))->GetNext()['AMOUNT'];
			$arResult[$el["ID"]]["QUANTITY"] = (($arProd <= 0 || $arResult[$el["ID"]]['CATALOG_QUANTITY'] <= 0) ? 0 : $arResult[$el["ID"]]['CATALOG_QUANTITY']);
			unset($arProd);
			/****Получение ссылок редактирования и удаления элемента из публичной части****/
			$arButtons = CIBlock::GetPanelButtons(
			    $el["IBLOCK_ID"],
			    $el["ID"],
			    0,
			    array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arResult[$el["ID"]]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arResult[$el["ID"]]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
			unset($arButtons);
/******************************************************************************************/
			//Получаем ИД поста (коммента) 
			//примечание: CIBlockPropertyTools::CODE_BLOG_COMMENTS_COUNT - возвращает некорректное значение
			$iCommentId = (int)CIBlockElement::GetProperty($el["IBLOCK_ID"], $el["ID"], array("sort" => "asc"), Array("CODE"=>CIBlockPropertyTools::CODE_BLOG_POST))->GetNext()["ID"];
			//Получем ИД самого коментария для товарной еденицы
			$dbProp = CIBlockElement::GetList(array(), array("ID" => $el["ID"]), false, array(), array("PROPERTY_".$iCommentId, "ID"));
			//Получаем количество коментариев
			$rsPosts = CBlogPost::GetList(
				array(),
				array('ID' => $dbProp->GetNext()["PROPERTY_".$iCommentId."_VALUE"]),
				false,
				false,
				array('NUM_COMMENTS')
			);
			$arResult[$el["ID"]]["REVIEW_COUNT"] = $rsPosts->GetNext()['NUM_COMMENTS'];
			unset($iCommentId, $dbProp, $rsPosts);
/*******************************************************************************************/			

		}
		unset($elementIterator, $el);
	}
	unset($strImageStorePath);
    $this->IncludeComponentTemplate();
}
?>
