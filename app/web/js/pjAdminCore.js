/* CSRF: attach token to all same-origin admin AJAX + form submits. */
function pjCsrfToken(){var m=document.querySelector('meta[name="csrf-token"]');return m?m.getAttribute("content"):"";}
 
(function(){
	if (typeof jQuery === 'undefined') { return; }
	jQuery.ajaxPrefilter(function (options) {
		if (options.crossDomain) { return; }
		var t = pjCsrfToken(); if (!t) { return; }
		options.headers = options.headers || {};
		options.headers['X-CSRF-Token'] = t;
	});
 
	function pjAttachCsrf(form) {
		var m = (form.getAttribute('method') || 'get').toLowerCase();
		if (m !== 'post') { return; }
		var t = pjCsrfToken();
 
		if (t && !form.querySelector('input[name="csrf_token"]')) {
			var i = document.createElement('input');
			i.type = 'hidden'; i.name = 'csrf_token'; i.value = t;
			form.appendChild(i);
		}
	}
 
	jQuery(document).on('submit', 'form', function () { pjAttachCsrf(this); });
 
	/* jQuery Validate (and other code) call the native HTMLFormElement.submit(),
	   which does NOT fire the delegated 'submit' handler above. Wrap it so the
	   CSRF token is still injected on programmatic submits. */
 
	if (window.HTMLFormElement && HTMLFormElement.prototype && !HTMLFormElement.prototype.__pjCsrfWrapped) {
		var pjNativeSubmit = HTMLFormElement.prototype.submit;
 
		HTMLFormElement.prototype.submit = function () {
			try { pjAttachCsrf(this); } catch (e) {}
			return pjNativeSubmit.apply(this, arguments);
		};
 
		HTMLFormElement.prototype.__pjCsrfWrapped = true;
	}
})();

var asApp = asApp || {};
var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		$(".pj-checkbox").hover(
				function () {
					$(this).addClass("pj-checkbox-hover");
				}, 
				function () {
					$(this).removeClass("pj-checkbox-hover");
				}
			);
		$("#content").on("click", ".notice-close", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(this).closest(".notice-box").fadeOut();
			return false;
		});
	});
})(jQuery);