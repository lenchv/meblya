<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');
$haveElements = false; //имеет ли раздел элементы
if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
	{
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	}
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
	{
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	}

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
				{
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
				}
				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
	{
		$arCurSection = array();
	}
}
?>
<?
if (isset($arCurSection['ID']) && 0 < intval($arCurSection['ID'])) {
	$haveElements = !(CIBlockSection::GetCount(array('SECTION_ID' => $arCurSection['ID'], 'IBLOCK_ID' => $arParams["IBLOCK_ID"])) > 0);
}
?>
<?
	/*Устанавливаем сортировку товаров*/
	session_start();
	if (isset($_REQUEST["SORT_METHOD"])) 
	{
		$_SESSION["MEBLYA_SORT_FIELD"] = $_REQUEST["SORT_METHOD"];
	} 
	else 
	{
		if (!isset($_SESSION["MEBLYA_SORT_FIELD"]))
		{
			$_SESSION["MEBLYA_SORT_FIELD"] = "timestamp_x";
		}
	}
	if (isset($_REQUEST["SORT_ORDER"])) 
	{
		$_SESSION["MEBLYA_SORT_ORDER"] = $_REQUEST["SORT_ORDER"];
	} 
	else 
	{
		if (!isset($_SESSION["MEBLYA_SORT_ORDER"]))
		{
			$_SESSION["MEBLYA_SORT_ORDER"] = "timestamp_x";
		}
	}
	//ежим отображения
	$values = array("twice", "thrice", "fourfold", "list");
	if (isset($_REQUEST["VIEW_MODE"]) && in_array($_REQUEST["VIEW_MODE"], $values)) 
	{
		$_SESSION["VIEW_MODE"] = $_REQUEST["VIEW_MODE"];
	} 
	else 
	{
		if (!isset($_SESSION["VIEW_MODE"]))
		{
			$_SESSION["VIEW_MODE"] = $arParams["LINE_ELEMENT_COUNT_MY"];
		}
	}
	$arParams["ELEMENT_SORT_FIELD"] = $_SESSION["MEBLYA_SORT_FIELD"];
	$arParams["ELEMENT_SORT_ORDER"] = $_SESSION["MEBLYA_SORT_ORDER"];
	$arParams["LINE_ELEMENT_COUNT_MY"] = $_SESSION["VIEW_MODE"];
	unset($values);
	session_write_close();
?>
<div class="row">
<?
if ($isVerticalFilter)
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
else
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");
?>
</div>