<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
require_once("SliderImageIndex.php");
/**
*	@return arResult["ID изображения" => ['ALT'=> альтернативный текст картинки, 'SRC'=> путь к изображению]]
*/
if ($this->StartResultCache()) {
	if (!CModule::IncludeModule("iblock"))
	{	
		$this->AbortResultCache();
		return;
	}
	$arResult = array();	//основной результирующий массив
	$arImageID = array();	//массив ID изображений
	$sImageID = "";			//строка ID изображений через ",", для выборки из БД необходимых изображений
	$index = 0;				//индекс для ID изображений
	$dbImages;				//результат запроса к БД
	$sImagePath = "";		//путь к изображению
	$strImageStorePath = COption::GetOptionString("main", "upload_dir", "upload"); // путь к директории, где хранятся изображения
	//имя информационного блока, по его хешу будет формироваться id слайдера
	$sTypeId = CIBlock::GetByID($arParams["IBLOCK_ID"])->GetNext()["IBLOCK_TYPE_ID"];
	$arResult["HTML_ID"] = "slider_".SliderImageIndex::get();
	$dbImages = CIBlockElement::GetList(
		array(), 
		array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"]
		), 
		false, 
		false, 
		array("ID", "NAME", "DETAIL_PICTURE", "DETAIL_TEXT")
	);

    while($arrImages = $dbImages->GetNext()) {
        $arImageID[] = $arrImages["DETAIL_PICTURE"];
        $arResult["IMAGES"][$arrImages["DETAIL_PICTURE"]]["ALT"] = $arrImages["DETAIL_TEXT"];
    }
	
	$sImageID = implode(",", $arImageID);
	$dbImages = CFile::GetList(array(), array("@ID" => $sImageID));
    while($arrImages = $dbImages->GetNext()) {
   		$sImagePath = "/".$strImageStorePath."/".$arrImages["SUBDIR"]."/".$arrImages["FILE_NAME"];
        $arResult["IMAGES"][$arImageID[$index++]]["SRC"] = $sImagePath; 
    }
    
    $this->IncludeComponentTemplate();
}
?>

