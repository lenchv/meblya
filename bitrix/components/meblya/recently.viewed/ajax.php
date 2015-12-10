<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?

if (CModule::IncludeModule("catalog"))
{
	$ajaxResult = array();
    if (IntVal($_REQUEST["PRODUCT_ID"])>0)
    {
        $itemId = Add2BasketByProductID(IntVal($_REQUEST["PRODUCT_ID"]));
	 	if ($itemId !== false) 
	 	{
            $arInfo = CIBlockElement::GetByID(IntVal($_REQUEST["PRODUCT_ID"]))->GetNext();
            $strImageStorePath = COption::GetOptionString("main", "upload_dir", "upload");
            $imageId = (empty($arInfo["DETAIL_PICTURE"])? $arInfo["PREVIEW_PICTURE"] : $arInfo["DETAIL_PICTURE"]);
            if (!empty($imageId)) {
                $sPath = CFile::GetByID($imageId)->GetNext();
                $sPath = "/".$strImageStorePath."/".$sPath["SUBDIR"]."/".$sPath["FILE_NAME"];
            } else {
                $sPath = "";
            }
            $ajaxResult["MSG"]["NAME"] = $arInfo["NAME"];
            $ajaxResult["MSG"]["URL"] = $arInfo["DETAIL_PAGE_URL"];
            $ajaxResult["MSG"]["IMG"] = $sPath;
    	} else 
    	{
	    	$ajaxResult["MSG"] = "Ошибка добавления товара в корзину";
    	}
    	echo json_encode($ajaxResult);
    }

}
?>