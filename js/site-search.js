(function ($) {
	$(function () {
		$(".site-search-toggle").on("click", function () {
			const search = $("#site-search");
			const input = $("#site-search form input[type='search']");
			const toggles = $(".site-search-toggle");
			search.toggleClass("site-search--active");
			if (search.hasClass("site-search--active")) {
				toggles.attr("aria-expanded", "true");
				setTimeout(() => {
					input.focus();
				}, 1);
			} else {
				toggles.attr("aria-expanded", "false");
			}
		});
	});
})(jQuery);
