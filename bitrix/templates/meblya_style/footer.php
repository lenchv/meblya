	<?if(CSite::InDir("/store/")):?>
		</div>
	<?endif?>
	</div>
	
	<div id="footer">
		<div id="footer-Left">
			<div id="Footer-logo">
				<div id="Footer-Info-Left"> 
						
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"COMPONENT_TEMPLATE" => ".default",
							"AREA_FILE_SHOW" => "sect",
							"AREA_FILE_SUFFIX" => "DopInfoFooter",
							"EDIT_TEMPLATE" => "",
							"AREA_FILE_RECURSIVE" => "Y"
						)
					);?>
				
									
				</div>
				<div id="Left-menu-Footer">
					<ul class="FLM" id="FLM1">
						<li><a href= "/store/index.php">Вся мебель</a></li>
						<li><a href="/store/soft_furniture/index.php">Мягкая мебель</a></li>
						<li><a href="/store/textile/index.php">Текстиль</a></li>
					</ul>
					
					<ul class="FLM" id="FLM2">
						<li><a href="/store/kitchen/index.php">Кухня</a></li>
						<li><a href="/store/office/index.php">Офис</a></li>
						<li><a href="/store/decoration/index.php">Декор</a></li>

					</ul>

					<ul class="FLM" id="FLM3">																	
						<li><a href="/store/child/index.php">Ребенок</a></li>
						<li><a href="/store/technic/index.php">Техника</a></li>
						<li><a href="/store/parts_of_home/index.php">Части дома</a></li>
					</ul>											
				</div>
			</div>
		</div>

		<div id="footer-right">
			<div id="footer-right-count">
				<div id="count-text">
					<a id="ctext">Блок счетчика</a>
				</div>
				<ul class="count-logo">
					<li><a target="_blank" id="f" href="https://www.facebook.com/"></a></li>
					<li><a target="_blank" id="t" href="https://twitter.com/?lang=ru"></a></li>
					<li><a target="_blank" id="in" href="https://instagram.com/"></a></li>
					<li><a target="_blank" id="g" href="https://accounts.google.com/"></a></li>
					<li><a target="_blank" id="you" href="https://www.youtube.com/"></a></li>
				</ul>
			</div>
			
			
			<?$APPLICATION->IncludeComponent(
				"bitrix:search.form", 
				"meblya_search_footer", 
				array(
					"COMPONENT_TEMPLATE" => "meblya_search_footer",
					"PAGE" => "#SITE_DIR#search/index.php",
					"USE_SUGGEST" => "Y"
				),
				false
			);?>
			
			
			<div id="footer-send-panel">
				<div id="search-box-footer">
					<input class="search-field-footer" placeholder="ввести e-mail" type="text"/>
					<a id="ok" href="#">OK</a>
				</div>
				<a id="Send-panel-text">Подписаться <br> на рассылку</a>						
			</div>
		</div>


					
		<div id="footer-bottom">
			<div id="menu-bottom">				
				<ul class="nav-menu-bottom">
					<li><a href="#">помощь</a></li>
					<li><a href="#">кредит</a></li>
					<li><a href="#">доставка/оплата</a></li>
					<li><a href="#">гарантии</a></li>
					<li><a href="#">контакты</a></li>
				</ul>							
			</div>				
			<div id="dop-info-bottom">
				<a href="#">Дополнительная информация</a>						
			</div>
		</div>		
	</div>
</body>
</html>