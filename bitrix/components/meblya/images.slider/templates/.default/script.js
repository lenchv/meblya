function ImageFrame(parent) {
	this.parent = parent;
	this.images = $(parent+" > .image-box img");
	this.turners = $(parent+" > .turner");
	this.start();
	this.turners.on("click", (function(obj) {
		return function() {
			var that = this;
			if (!$(this).hasClass("active")) {
				obj.stop();
				obj.turners.each(function (index, el) {
					if ($(el).hasClass("active")) {
						$(el).removeClass("active");
						$(obj.images[index]).removeClass("active");
						$(obj.images[index]).addClass("no-active");
					}
					if (el == that) {
						$(el).addClass("active");
						$(obj.images[index]).addClass("active");
						$(obj.images[index]).removeClass("no-active");
					}
				});
				obj.start();
			}
		};
	})(this));
}

ImageFrame.prototype.stop = function() {
	clearInterval(this.interval);
};

ImageFrame.prototype.start = function() {
	var parent = this.parent;
	this.interval = setInterval(function() {
		var currentTurner = $(parent+" > .turner.active");
		var currentImg = $(parent+" > .image-box img.active");
		var nextImg = currentImg.next("img");
		var nextTurner = currentTurner.next("div.turner");
		nextImg = (nextImg.length == 0)? currentImg.parent().find(":first-child") : nextImg;
		nextTurner = (nextTurner.length == 0)? currentTurner.parent().find("div.turner:first") : nextTurner;
		currentImg.removeClass("active");
		currentImg.addClass("no-active");

		nextImg.removeClass("no-active");
		nextImg.addClass("active");
		
		nextTurner.addClass("active");
		currentTurner.removeClass("active");
	}, 5000);
};