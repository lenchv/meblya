<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?
if (!function_exists('cmp_sort_meblya_menu'))
{
	function cmp_sort_meblya_menu($a, $b) {
		if (intval($a['COUNT_STRING']) == intval($b['COUNT_STRING'])) return 0;
		return (intval($a['COUNT_STRING']) > intval($b['COUNT_STRING']))? -1 : 1;
	}
}
?>
<? 
define('MAX_STRING_LINE', 24);
$previousLevel = 0; 
$arSection = array();
$menuNumber = 0;
?>
<div id="menu">
	<ul id="nav-menu-main">
		<?foreach($arResult as $arItem):?>
			<?
				if ($previousLevel && $previousLevel > $arItem["DEPTH_LEVEL"]) {
					if ($arItem["DEPTH_LEVEL"] == 1) 
					{
						$kY = 12.0/19.0;
						$kZ = 7.0/19.0;
						$iX = ($iAll/(1+$kZ+$kY));
						$iY = ($kY*$iX);
						$iZ = ($kZ*$iX);
						$menuLeft = "";
						$menuCenter = "";
						$menuRight = "";
						usort($arSection, 'cmp_sort_meblya_menu');
						foreach($arSection as $key => $value)
						{
							if ($iX > 0) 
							{
								$menuLeft .= $value['SECTIONS'];
								$iX -= $value['COUNT_STRING'];
							}
							elseif ($iY > 0)
							{
								$menuCenter .= $value['SECTIONS'];
								$iY -= $value['COUNT_STRING']; 
							} else {
								$menuRight .= $value['SECTIONS'];
								$iZ -= $value['COUNT_STRING']; 
							}
						}
						?>
						<ul class="menu-left"><?=$menuLeft?></ul>
						<ul class="menu-center"><?=$menuCenter?></ul>
						<ul class="menu-right"><?=$menuRight?></ul>
						<div class='bg'>
							<div class='shares'>
								<a href='<?=$arParams['LINK_DETAIL_SHARES']?>'>Вкусные<br />подробности</a>
								<div class='sign'>Акция</div><br /><br /><br /><br /><br /><br />
								<a href='<?=$arParams['LINK_SHARES']?>'>Все акции</a>
							</div>
						</div>
					</div>
					<?
					}
					else 
					{
						$arSect['SECTIONS'] .= str_repeat("</li></ul>", $previousLevel - $arItem["DEPTH_LEVEL"]);
						$arSection[] = $arSect;
						$arSect = array('COUNT_STRING' => 0, 'SECTIONS' => "");
					}
				}
			?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?=($arItem["SELECTED"]? 'active' : '')?>">
					<a href="<?=$arItem['LINK']?>">
						<div id="logo-<?=$arItem["PARAMS"]["logo"]?>"></div>
						<span><?=$arItem["TEXT"]?></span>
					</a>
					<?if($menuNumber < 3):?>
						<div class="dropdown left">
					<?elseif($menuNumber > 5):?>
						<div class="dropdown right">
					<?else:?>
						<div class="dropdown">
					<?endif?>
					<div class="title"><?=$arItem["TEXT"]?></div>

					<?
					$menuNumber++;
					$iAll = 0;
					unset($arSection);
					$arSection = array();
					$arSect = array('COUNT_STRING' => 0, 'SECTIONS' => ""); 
					?>
			<?elseif($arItem["DEPTH_LEVEL"] == 2):?>
				<?
				$iAll++;
				$arSect['COUNT_STRING']++;
				if (strlen($arItem['TEXT']) > MAX_STRING_LINE) $arSect['COUNT_STRING']++;
				$arSect['SECTIONS'] .= "<li class='".($arItem['IS_PARENT']? 'parent' : '')."'>
										<a href='".$arItem['LINK']."'>".$arItem['TEXT']."</a>";
				if ($arItem['IS_PARENT'])
				{
					$arSect['SECTIONS'] .= "<ul>";
				} 
				else 
				{
					$arSect['SECTIONS'] .= "</li>";
					$arSection[] = $arSect;
					$arSect = array('COUNT_STRING' => 0, 'SECTIONS' => "");
				}
				?>
			<?else:?>
				<?
				$iAll++;
				$arSect['COUNT_STRING']++;
				if (strlen($arItem['TEXT']) > MAX_STRING_LINE) $arSect['COUNT_STRING']++;
				$arSect['SECTIONS'] .= "<li class='".($arItem['IS_PARENT']? 'parent' : '')."'>
										<a href='".$arItem['LINK']."'>".$arItem['TEXT']."</a>";
				?>
			<?endif?>
			
			<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
		<?endforeach?>
		<?
		if ($previousLevel > 1) 
		{
			$arSection[] = $arSect;
			$kY = 12.0/19.0;
			$kZ = 7.0/19.0;
			$iX = ($iAll/(1+$kZ+$kY));
			$iY = ($kY*$iX);
			$iZ = ($kZ*$iX);
			$menuLeft = "";
			$menuCenter = "";
			$menuRight = "";
			usort($arSection, 'cmp_sort_meblya_menu');
			foreach($arSection as $key => $value)
			{
				if ($iX > 0) 
				{
					$menuLeft .= $value['SECTIONS'];
					$iX -= $value['COUNT_STRING'];
				}
				elseif ($iY > 0)
				{
					$menuCenter .= $value['SECTIONS'];
					$iY -= $value['COUNT_STRING']; 
				} else {
					$menuRight .= $value['SECTIONS'];
					$iZ -= $value['COUNT_STRING']; 
				}
			}
			?>
			<ul class="menu-left"><?=$menuLeft?></ul>
			<ul class="menu-center"><?=$menuCenter?></ul>
			<ul class="menu-right"><?=$menuRight?></ul>
			<div class='bg'>
				<div class='shares'>
					<a href='#'>Вкусные<br />подробности</a>
					<div class='sign'>Акция</div><br /><br /><br /><br />
					<a href='#'>Все акции</a>
				</div>
			</div>
		</div>
		<?
			unset($arSection);
		}
		?>
	</ul>
</div>

<?endif?>

