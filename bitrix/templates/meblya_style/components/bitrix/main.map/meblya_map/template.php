<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==True)die();

$arSections = array();
foreach ($arResult["arMap"] as $key => $value) {
	if (!preg_match('/\/store\/$/',$value["PATH"]) && strcmp($value["SEARCH_PATH"], "/store/")) 
	{
		 $arSections[$value["SEARCH_PATH"]][] = $value;
	}
}
?>

<div id="detailed-site-map">
	<div class="site-map-title">
		<div class="title-detailed-sign"></div>
		<div class="title-left"></div>
		<div class="title-middle"></div>
		<div class="title-right"></div>
	</div>
	<div class="wrapper">

	<?
	$sTitle = "";
	foreach($arSections as $key => $value) 
	{
		/*$arSections['/store/soft_furniture/'][0..n]['LEVEL'] == 2
		$value[0]['LEVEL'] == 2*/
		$sSection = "";  
		foreach($value as $level) 
		{
			/*$level['LEVEL'] == 2*/
			if ($level['LEVEL'] == 0) 
			{
				$sTitle = "<a href='".$level['FULL_PATH']."'>".$level['NAME']."</a>";
			} 
			else if ($level['LEVEL'] == 2) 
			{
				$sSection .= "<li><a href='".$level['FULL_PATH']."'>".$level['NAME']."</a></li>"; 
			}
		}	
		?>
				<div class="map-item">
					<img src="/bitrix/templates/meblya_style/images/site_map/site_map_image.png" alt=""/> 
					<div class="menu-title">
						<?=$sTitle?>
					</div>
					<a href="#">весь список</a>
					<ul class="submenu">
						<?=$sSection?>
					</ul>
				</div>
			<?
	}
	?>
	</div>
</div>
