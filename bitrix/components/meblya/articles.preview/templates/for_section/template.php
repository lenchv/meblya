<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?CJSCore::Init("jquery");?>
<?$APPLICATION->SetAdditionalCSS(SITE_SERVER_NAME."/bitrix/components/meblya/articles.preview/templates/.default/style.css");?>
<div id="articles">
	<div class="title-box">
		<div class="articles-title-text">
			<div><span>Статьи</span></div>
			<div><?=$arResult["IBLOCK_NAME"]?></div>
		</div>
		<div class="articles-line"></div>
	</div>
	<div class="wrapper">
		<?
			$iBlockId = (int)current($arResult['ARTICLES'])['IBLOCK_ID'];
			$strSectionEdit = CIBlock::GetArrayByID($iBlockId, "ELEMENT_EDIT");
			$strSectionDelete = CIBlock::GetArrayByID($iBlockId, "ELEMENT_DELETE");
			$arSectionDeleteParams = array("CONFIRM" => "Будет удалена вся информация, связанная с этой записью. Продолжить?");
		?>
		<?foreach($arResult["ARTICLES"] as $id => $arItem):?>
			<?
				if ($iBlockId != $arItem['IBLOCK_ID'])
				{
					$iBlockId = (int)$arItem['IBLOCK_ID'];
					$strSectionEdit = CIBlock::GetArrayByID($iBlockId, "SECTION_EDIT");
					$strSectionDelete = CIBlock::GetArrayByID($iBlockId, "SECTION_DELETE");
					$arSectionDeleteParams = array("CONFIRM" => "Будет удалена вся информация, связанная с этой записью. Продолжить?");
				}
				$this->AddEditAction($id, $arItem['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($id, $arItem['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			?>
			<div class="article" id="<?=$this->GetEditAreaId($id)?>">
				<div class="article-date"><?=$arItem["DATE"]?></div>
				<h3 class="topic"><?=$arItem["NAME"]?></h3>
				<?if($arItem["IMAGE_PATH"] != ""):?>
					<img src="<?=$arItem["IMAGE_PATH"]?>" alt="<?=$arItem["NAME"]?>">
				<?endif?>
				<p class="topic-text"><?=$arItem["PREVIEW_TEXT"]?></p>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Читать</a>
			</div>
		<?endforeach?>
	</div>
	<div class="line-bottom">
		<a href="<?=(($arResult["URL"]=="")? SITE_SERVER_NAME."/articles/" : $arResult["URL"])?>">Архив интересного</a>
	</div>
</div>