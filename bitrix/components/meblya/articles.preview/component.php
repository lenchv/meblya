<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
/**
*	@return arResult[
*		[IBLOCK_NAME] - имя инфоблока
*		[ARTICLES] => [ - массив из 2х статей
*			[PRODUCT] => [ - номер продукта
*				[DATE]
*				[NAME]
*				[IMAGE_PATH]
*				[PREVIEW_TEXT]
*				[DETAIL_PAGE_URL]
*			]
*		]
*		[URL] - адрес страницы инфоблока или адрес страницы типа инфоблока
*	]
*/
define("MAX_PREVIEW_LENGTH_FULL_AP", 330);
define("MAX_PREVIEW_LENGTH_AP", 200);
if ($this->StartResultCache()) {
	if (!CModule::IncludeModule("iblock"))
	{	
		$this->AbortResultCache();
		return;
	}
	$arResult = array(
		"IBLOCK_NAME" => "",
		"ARTICLES" => array(),
		"URL" => ""
	);	//основной результирующий массив
	
	$strImageStorePath = COption::GetOptionString("main", "upload_dir", "upload"); // путь к директории, где хранятся изображения
	//Если информационный блок не задан
	if ($arParams["IBLOCK_ID"] == 0) {
		$arResult["IBLOCK_NAME"] = GetMessage("ABOUT_INTERESTING");
		$iblockIterator = CIBlock::GetList(
			Array(), 
			Array(
				'TYPE'=>$arParams["IBLOCK_TYPE_ID"], 
				'ACTIVE'=>'Y', 
			), true
		);
		$arParams["IBLOCK_ID"] = array();
		while($arIblock = $iblockIterator->GetNext()) {
			$arParams["IBLOCK_ID"][] = $arIblock["ID"];
		}
	} 

	$articlesIterator = CIBlockElement::GetList(
		array($arParams["SORT"] => "DESC"), 
		array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"]
		), 
		false, 
		array("nPageSize" => 2), 
		array(	
				"ID",
				"IBLOCK_ID",
				"IBLOCK_NAME", 
				"LIST_PAGE_URL", 
				"CREATED_DATE", 
				"NAME", 
				"DETAIL_PAGE_URL", 
				"PREVIEW_TEXT", 
				"DETAIL_TEXT", 
				"DETAIL_PICTURE", 
				"PREVIEW_PICTURE"
			)
	);

    while($arArticle = $articlesIterator->GetNext()) {
    	$id = $arArticle["ID"];
    	if ($arResult["IBLOCK_NAME"] == "") {
    		$arResult["IBLOCK_NAME"] = $arArticle["IBLOCK_NAME"];
    		$arResult["URL"] = $arArticle["LIST_PAGE_URL"];
    	}
    	$arResult["ARTICLES"][$id]["DATE"] = $arArticle["CREATED_DATE"];
    	$arResult["ARTICLES"][$id]["NAME"] = $arArticle["NAME"];
    	$arResult["ARTICLES"][$id]["DETAIL_PAGE_URL"] = $arArticle["DETAIL_PAGE_URL"];

    	// путь к директории, где хранятся изображения
		$imageId = (empty($arArticle["PREVIEW_PICTURE"])? $arArticle["DETAIL_PICTURE"] : $arArticle["PREVIEW_PICTURE"]);
		if (!empty($imageId)) {
			$sPath = CFile::GetByID($imageId)->GetNext();
			$sPath = "/".$strImageStorePath."/".$sPath["SUBDIR"]."/".$sPath["FILE_NAME"];
		} 
		else 
		{
			$sPath = "";
		}
		$arResult["ARTICLES"][$id]["IMAGE_PATH"] = $sPath;
		
		$iPreviewSize = ($sPath == "")? MAX_PREVIEW_LENGTH_FULL_AP : MAX_PREVIEW_LENGTH_AP;
    	if (empty($arArticle["PREVIEW_TEXT"])) 
    	{
    		$arResult["ARTICLES"][$id]["PREVIEW_TEXT"] = substr($arArticle["DETAIL_TEXT"], 0, $iPreviewSize)."...";
    	} 
    	else 
    	{
    		if(strlen($arArticle["PREVIEW_TEXT"]) > $iPreviewSize) 
    		{
    			$arResult["ARTICLES"][$id]["PREVIEW_TEXT"] = substr($arArticle["PREVIEW_TEXT"], 0, $iPreviewSize)."...";
    		} 
    		else
    		{
    			$arResult["ARTICLES"][$id]["PREVIEW_TEXT"] = $arArticle["PREVIEW_TEXT"];
    		}
    	}

    	/****Получение ссылок редактирования и удаления элемента из публичной части****/
		$arButtons = CIBlock::GetPanelButtons(
		    $arArticle["IBLOCK_ID"],
		    $id,
		    0,
		    array("SECTION_BUTTONS"=>false, "SESSID"=>false)
		);
		$arResult["ARTICLES"][$id]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arResult["ARTICLES"][$id]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
		unset($arButtons);
	}
	unset($arArticle, $articlesIterator);
    $this->IncludeComponentTemplate();
}
?>
