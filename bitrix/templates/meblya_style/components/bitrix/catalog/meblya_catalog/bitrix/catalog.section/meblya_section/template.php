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
function vivod1($arr, $tab="") {
	foreach($arr as $key => $value) {
		if (!is_object($value)) 
		{
			echo $tab.$key." => ";
			if (is_array($value)) 
			{
				vivod1($value, $tab."-");
			} 
			else 
			{
				echo $value."<br>";
			}
			echo "<br>";
		} else {
			echo "OBJECT{}";
		}
	}
}

//vivod1($arResult['ITEMS']);
?>
<script>
	var arParams = {
		PATH_TO_EMPTY_IMG: "<?=$this->GetFolder().'/images/no_photo.png'?>",
		PATH_TO_BASKET: "<?=$arParams['BASKET_URL']?>"
	};
	var params = {};
</script>
<?if (!empty($arResult['ITEMS'])):?>
	<?
	/**Окончание для слова "модель"**/
	$sEndModels = "";
	$num = $arResult['NAV_RECORD_COUNT'];
	$mod = pow(10, strlen($num)-1);
	$num = $num%$mod;
	while ($num > 100) 
	{
		$mod /= 10;
		$num = $num%$mod;
	}
	if ($num > 20 || $num < 10) 
	{
		$num = $num%10;
		if ($num == 1) $sEndModels = "ь";
		else if ($num > 1 && $num <= 4) $sEndModels = "и";
		else $sEndModels = "ей";
	} else 
	{
		$sEndModels = "ей";
	}
	unset($num, $mod);
	
	/************************************************/
	?>

<div id="items-container">
	<div>
		<div class="items-title">
			<?=$arResult['NAME']?>
			<span><?=$arResult['NAV_RECORD_COUNT']?> модел<?=$sEndModels?></span>
		</div>
		<div class="count-items"><?=$arResult['NAV_FIRST_RECORD_SHOW']?>-<?=$arResult['NAV_LAST_RECORD_SHOW']?> из <?=$arResult['NAV_RECORD_COUNT']?></div>
	</div>
	<div class="top-container">
		<div class="display-options">
			<div class="twice <?=($arParams["LINE_ELEMENT_COUNT_MY"] == 'twice' ? 'active' : '')?>"></div>
			<div class="thrice <?=($arParams["LINE_ELEMENT_COUNT_MY"] == 'thrice' ? 'active' : '')?>"></div>
			<div class="fourfold <?=($arParams["LINE_ELEMENT_COUNT_MY"] == 'fourfold' ? 'active' : '')?>"></div>
			<div class="list <?=($arParams["LINE_ELEMENT_COUNT_MY"] == 'list' ? 'active' : '')?>"></div>
			<select name="sort-item" id="sort-item">
				<option value="" disabled>Сортировать по:</option>
				<option value="name" <?=($arParams["ELEMENT_SORT_FIELD"] == "name" ? "selected" : "")?> >По названию</option>
				<option value="shows" <?=($arParams["ELEMENT_SORT_FIELD"] == "shows" ? "selected" : "")?> >По популярности</option>
				<option value="timestamp_x" <?=($arParams["ELEMENT_SORT_FIELD"] == "timestamp_x" ? "selected" : "")?> >По дате добавления</option>
				<option value="catalog_PRICE_<?=$arResult['PRICES']['RETAIL']['ID']?>" <?=($arParams["ELEMENT_SORT_FIELD"] == "catalog_PRICE_".$arResult['PRICES']['RETAIL']['ID'] ? "selected" : "")?> >По цене</option>

			</select>
			<select name="view-item" id="view-item" form="data-sort">
				<option value="" disabled selected>Показывать по:</option>
				<option value="ASC" <?=($arParams["ELEMENT_SORT_ORDER"] == "ASC" ? "selected" : "")?>>Возрастанию</option>
				<option value="DESC" <?=($arParams["ELEMENT_SORT_ORDER"] == "DESC" ? "selected" : "")?>>Убыванию</option>
			</select>
		</div>
		
		<?=$arResult['NAV_STRING']?>
	</div>
	<div class="items-container <?=$arParams["LINE_ELEMENT_COUNT_MY"]?>">
		<?if($_REQUEST['AJAX']=='Y' && $_REQUEST['action']=='SORT') {
			$APPLICATION->RestartBuffer();
		}?>
		<?foreach($arResult["ITEMS"] as $arElement):?>
			<?
			$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" data-product-id="<?=$arElement["ID"]?>">
				<div class="country-article">
					<span><?=$arElement["PROPERTIES"]["COUNTRY"]["VALUE"]?>&nbsp;</span>
					<?if($arElement["PROPERTIES"]["COUNTRY"]["VALUE"] != "" && $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] != "") echo ",";?>
					<span><?=$arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"]?>&nbsp;</span>
				</div>
				<div class="item-title"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
				<div class="reviews">
					<a href="<?=$arElement['DETAIL_PAGE_URL']?>#soc_comments_div_<?=$arElement['ID']?>">
						Отзывы:<span class="count-reviews"><?=$arElement['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></span>
					</a>
				</div>
				<div class="item-availability">
					<?
					echo ( 'N' === $arElement['CATALOG_AVAILABLE'] ? "Нет в наличии" : "Есть на складе");
					?>
				</div>
				<a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="img-anchor">
					<?
						$picture = (($arElement["PREVIEW_PICTURE"]["SRC"] == "")? "" : $arElement["PREVIEW_PICTURE"]["SRC"]);
						if ($picture === "") 
						{
							$picture = (($arElement["DETAIL_PICTURE"]["SRC"] == "")? $this->GetFolder()."/images/no_photo.png" : $arElement["DETAIL_PICTURE"]["SRC"]);
							$pictAlt = $arElement["DETAIL_PICTURE"]["ALT"];
							$pictTitle = $arElement["DETAIL_PICTURE"]["TITLE"];
						} else {
							$pictTitle = $arElement["PREVIEW_PICTURE"]["TITLE"];
						}
					?>
					<img src="<?=$picture?>" alt="<?=$pictAlt?>" title="<?=$pictTitle?>">
				</a>
				<?if ($arElement["CAN_BUY"]):?>
					<div class="btn-buy"><div></div><?=($arParams['MESS_BTN_BUY'] == '' ? 'ХОЧУ!' : $arParams['MESS_BTN_BUY'])?></div>
				<?else:?>
					<div class="btn-disable"><div></div><?=($arParams['MESS_BTN_BUY'] == '' ? 'ХОЧУ!' : $arParams['MESS_BTN_BUY'])?></div>
				<?endif?>
				<div class="price">
					<span class="catalog-price">
					<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice = $arElement["PRICES"][$code]):?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<!--?=$arPrice["PRINT_DISCOUNT_VALUE"]?-->
								<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>&nbsp;
							<?else:?>
								<?=$arPrice["PRINT_VALUE"]?>&nbsp;
							<?endif?>
						<?else:?>
							&nbsp;
						<?endif;?>
					<?endforeach;?>
					</span>		
				</div>
				<div class="detail"><span><a href="<?=$arElement['DETAIL_PAGE_URL']?>">Подробнее</a></span></div>
				<script>
				/*<?=htmlspecialchars_decode(substr($arElement["ADD_URL"], strpos($arElement["ADD_URL"], '?')+1))?>*/
					params["<?=$arElement["ID"]?>"] = {
						ADD2BASKET: "action=ADD2BASKET&id=<?=(empty($arElement['OFFERS']) ? $arElement['ID'] : $arElement['OFFERS'][0]['ID'])?>",
						MSG: {
							IMG: "<?=$picture?>",
							NAME: "<?=$arElement["NAME"]?>",
							URL: "<?=$arElement["DETAIL_PAGE_URL"]?>"
						}
					};
				</script>
				<?if (isset($arElement["MY_OFFERS"])):?>
					<script>
						var myOffer = new ActivateOffers(<?=json_encode($arElement["MY_OFFERS"])?>);
						myOffer.setOffers(<?=current($arElement["MY_OFFERS"])['ID']?>, "#<?=$this->GetEditAreaId($arElement['ID'])?>");
					</script>
				<?endif?>
			</div>
		<?endforeach?>
		<div class='meblya-modal'><div class='preloader'></div></div>
		<script>
			initBasket();
		</script>
		<?if($_REQUEST['AJAX']=='Y' && $_REQUEST['action']=='SORT') {
			die();
		}?>
	</div>
	
	<?=$arResult['NAV_STRING']?>
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
<?endif?>