<!DOCTYPE html>
<html>
<head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
</head>
<body>
	<?$APPLICATION->ShowPanel();?>
	<!--[if lt IE 9]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
	<div id="fixed-side-bar">
		<a href="#"><div class="ico-mail"></div></a>
		<a href="#"><div class="ico-phone"></div></a>
		<a href="#"><div class="ico-purse"></div></a>
		<a href="#"><div class="ico-online"></div></a>
	</div>
	<div id="header">
		<div id="menu-top">
			<ul class="nav-menu-top">
				<li><a href="#">помощь</a></li>
				<li><a href="#">кредит</a></li>
				<li><a href="#">доставка/оплата</a></li>
				<li><a href="#">гарантии</a></li>
				<li><a href="#">контакты</a></li>
			</ul>
		</div>
		<div id="top-info-left-wrapper">
			<a id="logo" href="/" title="Главная"></a>
		</div>
		<div id="top-info">
			<div class="phone-box">
				<?
					$APPLICATION->IncludeFile(
						SITE_TEMPLATE_PATH."/page_templates/phones.php", 
						Array(), 
						Array("MODE"=>"html", "NAME"=>"phones", "TEMPLATE"=>"phones.php")
					);
				?>
			</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:search.form", 
				"meblya_search", 
				array(
					"COMPONENT_TEMPLATE" => "meblya_search",
					"PAGE" => "#SITE_DIR#search/index.php",
					"USE_SUGGEST" => "Y"
				),
				false
			);?>
		</div>
		<div id="top-right">
			<div id="login-box">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.register", 
					"meblya_register_form", 
					array(
						"COMPONENT_TEMPLATE" => "meblya_register_form",
						"SHOW_FIELDS" => array(
							0 => "EMAIL",
							1 => "NAME",
							2 => "LAST_NAME",
						),
						"REQUIRED_FIELDS" => array(
							0 => "EMAIL",
						),
						"AUTH" => "Y",
						"USE_BACKURL" => "N",
						"SUCCESS_PAGE" => "",
						"SET_TITLE" => "N",
						"USER_PROPERTY" => array(
						),
						"USER_PROPERTY_NAME" => ""
					),
					false
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form", 
					"meblya_auth_form", 
					array(
						"COMPONENT_TEMPLATE" => "meblya_auth_form",
						"REGISTER_URL" => "",
						"FORGOT_PASSWORD_URL" => "",
						"PROFILE_URL" => "",
						"SHOW_ERRORS" => "Y"
					),
					false
				);?>
			</div>
			<a id="basket" href="/personal/basket.php">
				<div id="basket-logo"></div>
				<span>КОРЗИНА</span>
			</a>
		</div>
	</div>
	
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_menu", 
	array(
		"COMPONENT_TEMPLATE" => "main_menu",
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_THEME" => "green",
		"LINK_SHARES" => "#",
		"LINK_DETAIL_SHARES" => "#"
	),
	false
);?>
	
	<div id="wrapper">
		<?if(CSite::InDir("/store/")):?>
			<div id="side-bar">
				<div class="title">
					<a href="./"><?=$APPLICATION->ShowProperty("section_name")?></a>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"section_menu", 
					array(
						"COMPONENT_TEMPLATE" => "section_menu",
						"ROOT_MENU_TYPE" => "left",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "N",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
					),
						false
				);?>
				<div id="options">
					<?$APPLICATION->ShowViewContent("options_area");?>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"COMPONENT_TEMPLATE" => ".default",
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "meblya_baner",
						"EDIT_TEMPLATE" => "",
						"AREA_FILE_RECURSIVE" => "Y"
						),
					false
				);?>


			</div>
		<div id="container">
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb", 
				"my_breadcrumb", 
				array(
					"COMPONENT_TEMPLATE" => ".default",
					"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
					"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
					"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?>
		<?endif?>