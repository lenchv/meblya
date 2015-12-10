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

$(function() {
	$("#items-container .items-container .item .btn-buy").on("click", function(e) {
		var productId = parseInt($(this).parents(".item")[0].dataset.productId);
		$.ajax({
			data: "ajax=Y&PRODUCT_ID="+productId,
			dataType: "json",
			success: function (data) {
				BasketModalWindow(data);
			}
		});
		if (e.preventDefault) e.preventDefault(); else return false;
	});
});