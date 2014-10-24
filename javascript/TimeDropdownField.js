(function($) {
	$('.timedropdown .presets-trigger').entwine({
		onclick: function(e) {
			this.toggleClass("opened");
			
			this.parent().find('select.presets').toggleClass("opened").click().mousedown();
			
			// Open Select
			var element = this.parent().find('select.presets')[0], worked = false;
			if (document.createEvent) { // all browsers
			    var e = document.createEvent("MouseEvents");
			    e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
			    worked = element.dispatchEvent(e);
			} else if (element.fireEvent) { // ie
			    worked = element.fireEvent("onmousedown");
			}
			if (!worked) {
			}
			
			return false;
		}
	});
	
	$('.timedropdown select.presets').entwine({
		onchange: function(e) {
			// Change the input to our new value
			if(this.val()) this.parent().find(':input').val(this.val());
			// Reset preset value afterwards
			this.val('');
			
			this.removeClass("opened");
			this.parent().find('.presets-trigger').removeClass("opened");
		}
	});
}(jQuery));