<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
CJSCore::Init("jquery");
$index = 1;
$sTurners = "";
?>

<div id="<?=$arResult["HTML_ID"]?>" class="image-frame">
	<div class="image-box">
	<?foreach($arResult["IMAGES"] as $item):?>
			<?if($index == 1):?>
				<img src="<?=$item['SRC']?>" alt="<?=$item['ALT']?>" class="active">
				<?$sTurners .= "<div class='turner active'></div>";?>
			<?else:?>
				<img src="<?=$item['SRC']?>" alt="<?=$item['ALT']?>">
				<?$sTurners .= "<div class='turner'></div>";?>
			<?endif?>
			<?$index++;?>
	<?endforeach?>
	</div>
	<?=$sTurners?>
</div>

<script>
	new ImageFrame("#<?=$arResult['HTML_ID']?>");
</script>
