$(function() {
	$(".authorization-link").on("click", function(e) {
		$("div.my-auth-form").toggleClass("active");
		$("div.my-auth-form").parent().toggleClass("active");
	});
	$("div.modal-wrapper").on("click", function () {
		var mainForm = $(this).find(":first-child");
		var forgotPasswd = $(this).find("div.my-auth-forgot-password");
		if (forgotPasswd.hasClass("active")) forgotPasswd.removeClass("active");
		if (mainForm.hasClass("active")) mainForm.removeClass("active");
		$(this).toggleClass("active");
		return false;
	});

	$("div.my-auth-form").on("click", function (e) {
		if(e.cancelBubble) e.cancelBubble();
		else e.stopPropagation();
	});

	$("div.my-auth-forgot-password").on("click", function (e) {
		if(e.cancelBubble) e.cancelBubble();
		else e.stopPropagation();
	});

	$("div.my-auth-form-error-message").css({opacity: 0, top: "10%"});
	$("div.my-auth-form-error-message").on("transitionend oTransitionEnd webkitTransitionEnd", function() {
		$(this).remove();
	});


	$("a.link-forgot-password").on("click", function() {
		$("div.my-auth-forgot-password").toggleClass("active");
		$("div.my-auth-form").toggleClass("active");
	});
});