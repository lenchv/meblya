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
$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<?if (0 < $arResult["SECTIONS_COUNT"]):?>
	<div id="sections">
		<?foreach ($arResult['SECTIONS'] as &$arSection): ?>
			<?if($arSection["RELATIVE_DEPTH_LEVEL"] == 1):?>
				<?	
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				if (false === $arSection['PICTURE'])
				{
					$arSection['PICTURE'] = array(
						'SRC' => $this->GetFolder().'/images/item-empty.png',
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				}
				?>
				<div class="section-box" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
					<img src="<?=$arSection['PICTURE']['SRC'];?>" alt="<?=$arSection['PICTURE']['TITLE'];?>">
					<a href="<?=$arSection['SECTION_PAGE_URL'];?>"><?=$arSection['NAME'];?></a>
				</div>
			<?endif?>
		<?endforeach?>
		<?unset($arSection);?>
	</div>
	<div style="clear: both;"></div>
<?endif?>