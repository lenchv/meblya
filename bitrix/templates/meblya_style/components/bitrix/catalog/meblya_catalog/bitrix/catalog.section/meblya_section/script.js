$(function() {
	$("#items-container .display-options div").on("click", function() {
		var className = $(this).attr("class");
		var comp = $("#items-container .items-container");
		$(this).parent().find(".active").removeClass("active");
		
		$(this).addClass("active");
		comp.removeClass();
		comp.addClass("items-container");
		comp.addClass(className);
		$.ajax({data:"VIEW_MODE="+className});
	});

	$("#items-container .display-options select[name='sort-item']").on("change", function (e) {
		var sortField = $(this).val();
		ajaxSend("AJAX=Y&action=SORT&SORT_METHOD="+sortField);
	});

	$("#items-container .display-options select[name='view-item']").on("change", function (e) {
		var sortField = $(this).val();
		ajaxSend("AJAX=Y&action=SORT&SORT_ORDER="+sortField);
	});
	var ajaxSend = function (reqData) {
		$.ajax({
			type: "GET",
			dataType: "html",
			data: reqData,
			success: function (data, status, jqXHR) {
				delModalPreloader();
				if (jqXHR.status == 200) {
					$(".items-container").html(data);
				}
			},
			beforeSend: function() {
				addModalPreloader();
			},
			error: function() {
				delModalPreloader();
			}
		});
	};
	var addModalPreloader = function () {
		$(".meblya-modal").addClass("active");
	};
	var delModalPreloader = function () {
		$(".meblya-modal").removeClass("active");
	};
	initBasket();
});

var initBasket = function () {
	$("#items-container .items-container .item .btn-buy").on("click", function (e) {
		if (!$(this).hasClass(".btn-disable")) {
			var productId = parseInt($(this).parents(".item")[0].dataset.productId);
			var that = this;
			$.ajax({
				type: "GET",
				dataType: "html",
				data: params[productId].ADD2BASKET,
				beforeSend: function () {
					$(that).addClass("btn-disable");
					$(that).find("div").addClass("wait");
				},
				success: function () {
					$(that).removeClass("btn-disable");
					$(that).find("div").removeClass("wait");
					BasketModalWindow(params[productId]);
				}
			});
		}
	});
};

/************MODAL WINDOW*****************************/
function ModalWindow(html, title) {
	$(".basket-modal-wrapper .basket-modal-window>.status-panel>span").text(title);
	$(".basket-modal-wrapper .basket-modal-window>.content").html(html);
	$(".basket-modal-wrapper").addClass("active");
	$(".basket-modal-wrapper .basket-modal-window").on("click", function(e) {
		if(e.cancelBubble) e.cancelBubble();
		else e.stopPropagation();
	});
	$(".basket-modal-wrapper .close, .basket-modal-wrapper").on("click", function (e) {
		if($(this).hasClass("basket-modal-wrapper")) {
			$(this).removeClass("active");
		} else {
			$(this).parents(".basket-modal-wrapper")[0].classList.remove("active");
		}
	});
}

function BasketModalWindow(data) {
	if (typeof data.MSG !== "string") {
		html = "<a href='"+data.MSG.URL+"'><img src='"+((data.MSG.IMG !== "")? data.MSG.IMG : arParams.PATH_TO_EMPTY_IMG) +"\
		' alt='"+data.MSG.NAME+"' />\
		"+data.MSG.NAME.toLowerCase()+"</a><hr/>\
		<a href='"+arParams.PATH_TO_BASKET+"' class='btn'>В корзину</a>";
		ModalWindow.apply(this, [html, "Товар добавлен в корзину"]);
	} else {
		//ModalWindow.apply(this, [data.MSG, "Ошибка"]);
	}
}
BasketModalWindow.prototype = Object.create(ModalWindow);
/*****************************************************/
function ActivateOffers(myOffers) {
	this.myOffers = myOffers;
}
/**
id - идентификатор торгового предложения
parent - CSS селектор элемента товара
*/
ActivateOffers.prototype.setOffers = function (id, item) {
	var offer = this.myOffers[id];
	var parent = $(item);
	parent.find(".item-availability").text(offer['AVAILABLE']);
	parent.find(".price>.catalog-price").text(offer['PRICE']);
	var btn = (parent.find(".btn-buy").length > 0 ? parent.find(".btn-buy") : parent.find(".btn-disable"));
	btn.removeClass("btn-buy").removeClass("btn-disable");
	btn.addClass((offer['CAN_BUY'] ? "btn-buy" : "btn-disable"));
};