(function ($) {
	$(function () {
		$(".site-search-toggle").on("click", () => {
			const search = $("#site-search");
			const input = $("#site-search form input[type='search']");
			search.toggleClass("site-search--active");
			if (search.hasClass("site-search--active")) {
				setTimeout(() => {
					input.focus();
				}, 1);
			}
		});
	});
})(jQuery);
