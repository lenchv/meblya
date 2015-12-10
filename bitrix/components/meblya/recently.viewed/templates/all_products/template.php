<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
	CJSCore::Init("jquery");
	$arParams["PATH_TO_EMPTY_IMG"] = SITE_TEMPLATE_PATH."/images/products/empty_product.png";
?>
<script>
	var arParams = <?=json_encode($arParams)?>;
</script>

<div id="items-container">
	<div class="items-container">
		<?
			$iBlockId = (int)current($arResult)['IBLOCK_ID'];
			$strSectionEdit = CIBlock::GetArrayByID($iBlockId, "ELEMENT_EDIT");
			$strSectionDelete = CIBlock::GetArrayByID($iBlockId, "ELEMENT_DELETE");
			$arSectionDeleteParams = array("CONFIRM" => "Будет удалена вся информация, связанная с этой записью. Продолжить?");
		?>
		<?foreach($arResult as $id => $arItem):?>
			<?
				if ($iBlockId != $arItem['IBLOCK_ID'])
				{
					$iBlockId = (int)$arItem['IBLOCK_ID'];
					$strSectionEdit = CIBlock::GetArrayByID($iBlockId, "SECTION_EDIT");
					$strSectionDelete = CIBlock::GetArrayByID($iBlockId, "SECTION_DELETE");
					$arSectionDeleteParams = array("CONFIRM" => "Будет удалена вся информация, связанная с этой записью. Продолжить?");
				}
				
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			?>
			<span class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>" data-product-id="<?=$arItem["PRODUCT_ID"]?>">
				<div class="country-article">
					<span><?=(($arItem["ARTNUMBER"] == "")? "&nbsp" : $arItem["ARTNUMBER"])?></span>
				</div>
				<div class="item-title"><?=$arItem["NAME"]?></div>
				<div class="reviews"> 
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>#soc_comments_div_<?=$arItem['ID']?>">Отзывы:<span class="count-reviews"><?=$arItem["REVIEW_COUNT"]?></span></a>
				</div>
				<div class="item-availability"><?if($arItem["CATALOG_QUANTITY"] > 0):?>есть на складе<?else:?>нет в наличии<?endif?></div>
				<img src="<?=($arItem["IMAGE"] !== "")? $arItem["IMAGE"] : $arParams["PATH_TO_EMPTY_IMG"]?>" alt="<?=$arItem["NAME"]?>">
				<div class="btn-buy">ХОЧУ!</div>
				<?if(!empty($arItem["PRICE_WITH_DISCOUNT"])):?>
					<div class="price"><?=$arItem["PRICE_WITH_DISCOUNT"]?></div>
				<?else:?>
					<div class="price"><?=$arItem["PRICE"]?></div>
				<?endif?>
				<div class="detail"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее</a></div>
			</span>
		<?endforeach?>
	</div>
</div>

<div class="basket-modal-wrapper">
	<div class="basket-modal-window">
		<div class="status-panel">
			<span></span>
			<div class="close"></div>
		</div>
		<div class="content">
		</div>
	</div>
</div>

