$(function() {

	$(".registration-link").on("click", function(e) {
		$("div.my-reg-form").toggleClass("active");
		$("div.my-reg-form").parent().toggleClass("active");
	});

	$("div.my-reg-form").on("click", function (e) {
		if(e.cancelBubble) e.cancelBubble();
		else e.stopPropagation();
	});
});