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
$this->setFrameMode(true);?>



<div id="footer-search-panel">
<div id="search-box-footer">


<form action="<?=$arResult["FORM_ACTION"]?>">
	<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				 "MY_PLACEHOLDER" => "&nbsp&nbspПоиск,&nbsp;по&nbsp;сайту"
				),
				$component, array("HIDE_ICONS" => "Y")
	);?><?else:?><input class="search-field-footer" type="text" name="q" value="" size="15" maxlength="50" placeholder="Поиск по сайту"/><?endif;?>

	<input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON2");?>" />

</form>

</div>
</div>
					



