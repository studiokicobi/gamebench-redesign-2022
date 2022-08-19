jQuery(function ($) {
	$("#caseLoad").on("click", function () {
		const button = $(this);
		function customRequest(data) {
			$.ajax({
				// you can also use $.post here
				url: cases_params.ajaxurl, // AJAX handler
				data: data,
				type: "POST",
				beforeSend: function (xhr) {
					button.html("Loading..."); // change the button text, you can also add a preloader image
				},
				success: function (data) {
					if (data) {
						button.html("Load More");
						caseContainer.append(data); // insert new posts
						cases_params.current_page++;
					} else {
						button.addClass("d-none"); // if no data, remove the button as well
					}
				},
			});
		}

		var maxPage = $(this).data("maxpage");

		const caseContainer = $(".case-listing");

		if ($(this).data("currentpage") < maxPage) {
			$(this).data("currentpage", $(this).data("currentpage") + 1);
			if ($(this).data("currentpage") === maxPage) {
				customRequest({
					action: "cases",
					query: cases_params.posts,
					page: $(this).data("currentpage"),
				});
				setTimeout(function () {
					button.addClass("d-none");
				}, 300);
			} else {
				customRequest({
					action: "cases",
					query: cases_params.posts,
					page: $(this).data("currentpage"),
				});
			}
		}
	});
});
