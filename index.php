<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("МЕБЛЯ");
?><?$APPLICATION->IncludeComponent(
	"meblya:images.slider",
	".default",
	Array(
		"IBLOCK_TYPE_ID" => "images",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_NOTES" => "",
		"IBLOCK_ID" => "11"
	)
);?>   
<!--TOP NEWS-->
 
<div id="top-news"> 	 	 
  <div class="news-box"> <img src="/bitrix/templates/meblya_style/images/main_page/top_news.jpg"  /> 
    <div class="news-panel"> 			 		 
      <div class="news-title">Новые</div>
     		<span>поступления</span> 		 		</div>
   		<a href="#" >Все поступления &gt;</a> 	 	</div>
 	 	 
  <div class="news-box"> <img src="/bitrix/templates/meblya_style/images/main_page/top_news.jpg"  /> 		 		 
    <div class="news-panel"> 			 	 		 
      <div class="news-title">Хиты</div>
     			<span>продаж</span> 		 		</div>
   		<a href="#" >Все хиты продаж &gt;</a> 	 	</div>
 	 	 	 
  <div class="news-box"> <img src="/bitrix/templates/meblya_style/images/main_page/top_news.jpg"  /> 		 	 
    <div class="news-panel"> 			 	 		 
      <div class="news-title">Скидки</div>
     	 	<span>и бонусы</span> 		 	 	</div>
   		<a href="#" >Все скидки и бонусы &gt;</a> 	 	</div>
 </div>
 
<!--/TOP NEWS-->
  <?$APPLICATION->IncludeComponent(
	"meblya:recently.viewed",
	".default",
	Array(
		"IBLOCK_TYPE_ID" => "furniture",
		"PATH_TO_BASKET" => "/personal/basket.php",
		"PAGE_ELEMENT_COUNT" => "20",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"COMPONENT_TEMPLATE" => ".default"
	)
);?> 		<?$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	"meblya_map",
	Array(
		"LEVEL" => "3",
		"COL_NUM" => "2",
		"SHOW_DESCRIPTION" => "Y",
		"SET_TITLE" => "N",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "meblya_map",
		"CACHE_TYPE" => "A"
	)
);?> 		<?$APPLICATION->IncludeComponent(
	"meblya:articles.preview",
	".default",
	Array(
		"IBLOCK_TYPE_ID" => "articles",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"CACHE_NOTES" => "",
		"IBLOCK_ID" => "0",
		"COMPONENT_TEMPLATE" => ".default",
		"SORT" => "show_counter"
	)
);?>         
<div id="work-with-us"> 	 
  <div class="work-title"> 		 
    <div class="title-sign"></div>
   		 
    <div class="title-left"></div>
   		 
    <div class="title-right"></div>
   	</div>
 	 
  <div class="work-wrapper"> 		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a href="#" class="work-sign" >Все виды оплат</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-car"></div>
     			<a class="work-sign" >Бесплатная доставка по Украине</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-timer"></div>
     			<a class="work-sign" >Рассрочка онлайн</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a class="work-sign" >Выгодный кредит</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a href="#" class="work-sign" >Региональная цена</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-car"></div>
     			<a class="work-sign" >Возврат товара</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-timer"></div>
     			<a class="work-sign" >Оптовая торговля</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a class="work-sign" >Бесплатная сборка</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a href="#" class="work-sign" >Гарантия от 1го года</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-car"></div>
     			<a class="work-sign" >100 пунктов выдачи</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-timer"></div>
     			<a class="work-sign" >Бесплатная визуализация интерьера</a> 		</div>
   		 
    <div class="work-item"> 			 
      <div class="work-ico-intime"></div>
     			<a class="work-sign" >Все в одном месте</a> 		</div>
   	</div>
 </div>
 <span id="advantages"> 	 
  <p> 		Продукцию Интернет-магазина для интерьеров «Мебля» можно купить в таких регионах Украины, как Киев, Донецк, Днепропетровск, Одесса, Львов, АР Крым, Харьков, Ровно, Луцк, Луганск и др. Мы предлагаем Вам купить мебель для дома лучших мебельных фабрик Нова, Гербор, Gerbor, БРВ Україна, Сокме, БМФ, BRW Польша, Комфорт мебель, VIP-master, Свит меблив, Мебель сервис, ЛьвовТрейдСервис, Матролюкс, НеоЛюкс, МироМарк, Скай, Каприз, Новий стиль, Пехотин, Венгер. У нас можно недорого купить мебель хорошего качества, с гарантией, сборкой и доставкой по Украине. Купить мебель (в Киеве, Ровно, Харькове, Донецке, Львове, и др.) в нашем интернет-магазине так же просто как покупать мебель в обычном магазине, но у нас фабричная мебель дешевле. 	</p>
 	 
  <p> 		В отличие от покупки мебели в магазинах и на рынках, у нас вы одновременно можете: изучить большой ассортимент мебели и сравнить предложения по красочному интернет-каталогу, не выходя из дома получить минимальную цену на мебель, гарантировать себе качество от лучших отечественных мебельных фабрик, получить все необходимые гарантии, заказать доставку мебели, транспортировку на этаж, профессиональную сборку или изготовить мебель по индивидуальному проекту. 	</p>
 </span> <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>