<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
	CJSCore::Init("jquery");
	$arParams["PATH_TO_EMPTY_IMG"] = SITE_TEMPLATE_PATH."/images/products/empty_product.png";
?>
<script>
	var arParams = <?=json_encode($arParams)?>;
</script>
<div id="recently-viewed">
	<div class="recently-viewed-hide">
		<a href="#"></a>
	</div>
	<div class="recently-viewed-title">
		<div class="title-left"></div>
		<div class="title-middle"></div>
		<div class="title-right"></div>
	</div>
	<a class="go-to-catalog" href="#">перейти в каталог</a>

	<div class="items-slider items-slider1">
		<div class="left-arrow"></div>
		<div class="items-container">
			<div class="items-box">
				<? if(empty($arResult)): ?>
					<div class="empty-string">
						<h1>Недавно просмотренных товаров нет</h1>
					</div>
				<?else:?>
					<?
						$iBlockId = (int)current($arResult)['IBLOCK_ID'];
						$strSectionEdit = CIBlock::GetArrayByID($iBlockId, "SECTION_EDIT");
						$strSectionDelete = CIBlock::GetArrayByID($iBlockId, "SECTION_DELETE");
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
						<div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>" data-product-id="<?=$arItem["PRODUCT_ID"]?>">
							<div class="item-name">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>
								<span class="item-article">(<?=$arItem["ARTNUMBER"]?>)</span>
							</div>
							<div class="reviews">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>#soc_comments_div_<?=$arItem['ID']?>">отзывы:<span class="count-reviews"><?=$arItem["REVIEW_COUNT"]?></span></a>
							</div>
							<div class="item-availability"><?if($arItem["QUANTITY"] > 0):?>есть на складе<?else:?>нет в наличии<?endif?></div>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img src="<?=($arItem["IMAGE"] !== "")? $arItem["IMAGE"] : $arParams["PATH_TO_EMPTY_IMG"]?>" alt="<?=$arItem["NAME"]?>">
							</a>
							<div class="item-price">
								
								<?if(!empty($arItem["PRICE_WITH_DISCOUNT"])):?>
									<div class="price-old"><?=$arItem["PRICE"]?></div>
									<div class="price-new"><?=$arItem["PRICE_WITH_DISCOUNT"]?></div>
								<?else:?>
									<div class="price-new"><?=$arItem["PRICE"]?></div>
								<?endif?>
								<a href="#">
									<div class="btn-buy">КУПИТЬ</div>
								</a>
							</div>
						</div>
					<?endforeach?>
				<?endif?>
				
			</div>
		</div>
		<div class="right-arrow"></div>
	</div>
	<div class="all-views"><a href="/store/recently-viewed.php">Все просмотренные</a></div>
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

<script>
	$("#recently-viewed .recently-viewed-hide a").on("click", function (e) {
		$(this).parents("#recently-viewed")[0].classList.toggle("minimized");
		if (e.preventDefault) e.preventDefault(); else return false;
	});
	(new ItemsSlider("#recently-viewed .items-slider")).ajaxBasketListener();
</script>


