/*$(function() {
	var intervalId = {};
	$("#menu ul#nav-menu-main>li").on("mouseenter", function(e) {
		if (intervalId.t == this)
			clearInterval(intervalId.id);
		$(this).find("ul.dropdown").removeClass("invisible");
		$(this).on("mouseleave", function(e) {
			var that = this;
			intervalId.t = this;
			
			intervalId.id = setTimeout(function () {
				$(that).find("ul.dropdown").addClass("invisible");
			}, 500);
		});
	});
	
});*/