jQuery(function ($) {

	$('.slide--1').waitForImages(function() {
		$('.metrics-container-wrapper').attr('style', 'visibility: visible;');
		$('.why-performance-section').attr('style', 'visibility: visible;');
	}, $.noop, true);

	$('.event-builder-video-list-item').click(function (){
		window.location.href = $(this).data('detail-url') ;
	});

	$(".logo_slider").slick({
		speed: 5000,
		autoplay: true,
		autoplaySpeed: 0,
		cssEase: "linear",
		slidesToShow: 1,
		slidesToScroll: 1,
		variableWidth: true,
		draggable: false,
		pauseOnHover: false,
		pauseOnFocus: false,
		arrows: false
	});

	$(document).ready(function (){
		$("#builder-modal-event-video").on('show.bs.modal', function (e) {
			showModalContent(e);
		});
		$("#builder-modal-event-video").on('hide.bs.modal', function (e) {
			jQuery('#builder-modal-event-video .builder-modal-video-container').css('display', 'none');
			$(e.currentTarget).find(".builder-modal-video-container iframe").attr('src','');
			$(e.currentTarget).find(".builder-modal-video-container video").attr('src','');
			$(e.currentTarget).find(".builder-modal-video-container video").css('display','none');
			$(e.currentTarget).find(".builder-modal-video-container iframe").css('display','none');
		});
	});

	$("#builder-modal-video").on('show.bs.modal', function (e) {
		console.log(true);
		var url = jQuery(e.relatedTarget).data('url');
		var type = jQuery(e.relatedTarget).data('type');

		if(type == "Self Host"){
			jQuery(e.currentTarget).find("video").attr('src',url);
			jQuery(e.currentTarget).find("video").css('display','block');
			jQuery(e.currentTarget).find("iframe").css('display','none');
		}else{
			jQuery(e.currentTarget).find("iframe").attr('src',url);
			jQuery(e.currentTarget).find("video").css('display','none');
			jQuery(e.currentTarget).find("iframe").css('display','block');
		}

	});

	$("#builder-modal-video").on('hide.bs.modal', function (e) {
		jQuery(e.currentTarget).find("iframe").attr('src','');
		jQuery(e.currentTarget).find("video").attr('src','');
		jQuery(e.currentTarget).find("video").css('display','none');
		jQuery(e.currentTarget).find("iframe").css('display','none');
	});

	$(".builder-video-list-slider").slick({
		speed: 1000,
		// autoplay: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		dots:false,
		infinite: true,
		responsive: [
			{
				breakpoint: 1100,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
				}
			},
		]
	});

	$(".blog_top_slider").css("opacity", 1);
	// use jQuery code inside this to avoid "$ is not defined" error
	$("#loadMoreBtn").on("click", function () {

		let searchWord = $('#search-word').val();
		if( typeof searchWord != "undefined" && searchWord != ''){
			let postsParams = JSON.parse(loadmore_params.posts);
			postsParams.s = searchWord;
			loadmore_params.posts = JSON.stringify(postsParams);
		}

		const button = $(this),
			data = {
				action: "loadmore",
				query: loadmore_params.posts, // that's how we get params from wp_localize_script() function
				page: loadmore_params.current_page,
			};
		const blogContainer = $(".blogContainer");


		$.ajax({
			// you can also use $.post here
			url: loadmore_params.ajaxurl, // AJAX handler
			data: data,
			type: "POST",
			beforeSend: function (xhr) {
				button.attr('style', 'pointer-events: none;');
				button.text("Loading..."); // change the button text, you can also add a preloader image
			},
			success: function (data) {
				if (data) {
					// button.text("Load More").prev().before(data); // insert new posts
					button.text("Load More");
					button.attr('style', 'pointer-events: auto;');
					blogContainer.append(data); // insert new posts
					loadmore_params.current_page++;

					if (loadmore_params.current_page == loadmore_params.max_page || loadmore_params.current_page == button.data('max-page'))
						button.hide(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.hide(); // if no data, remove the button as well
				}
			},
		});
	});
	$('.clear-tags').on("click", function (event) {
		$('.custom-option').removeClass('selected');
		$(this).removeClass('show');
		loadmore_params.current_page = 1;
		$('.title-search-tag').text('Tags');
	});

	// use jQuery code inside this to avoid "$ is not defined" error
	$(".loadSearch").on('click change', function (e) {
		if ($(e.target).hasClass('custom-option')) {
			$('.custom-option').removeClass('selected');
			$(this).addClass('selected');
		}

		if ($(e.target).hasClass('input-searcher') && e.type === "click") {

			return false;
		}

		let selectedTagId = $('.custom-option.selected').data('value');
		const button = $("#loadMoreBtn"),

			searchWord = $('#search-word').val();
		let searchWordPage = $('#search-word').data('page');
		searchWordPage = typeof searchWordPage == "undefined" ? 'blog' : searchWordPage;

		const blogContainer = $(".blogContainer");

		if(selectedTagId === 'tags'){
			selectedTagId = "";
		}
		const data = {
			action: "loadmore",
			query: JSON.stringify({"page":0,"pagename":searchWordPage, "tag_id":selectedTagId,"paged":0,"s":searchWord,"sentence":"","title":"","tag__in":[],"cache_results":true,"update_post_term_cache":true,"lazy_load_term_meta":true,"update_post_meta_cache":true,"posts_per_page":9,"nopaging":false,"order":"desc"}), // that's how we get params from wp_localize_script() function
			page: 0,
		};

		$.ajax({
			// you can also use $.post here
			url: loadmore_params.ajaxurl, // AJAX handler
			data: data,
			type: "POST",
			beforeSend: function (xhr) {
				button.hide();

				// change the button text, you can also add a preloader image
				blogContainer.html(' <div class="lds-ring"><div></div><div></div><div></div><div></div></div>');
				$('.lds-ring').show();

			},
			success: function (data) {

				if($('.custom-option.selected').data('value') !== undefined){
					button.hide();
				} else {
					button.show();
				}
				$('.lds-ring').hide();
				if (data) {

					// button.text("Load More").prev().before(data); // insert new posts
					//button.text("Load More");
					blogContainer.html(data); // insert new posts
					loadmore_params.current_page = 1;

					// if (loadmore_params.current_page == loadmore_params.max_page)
					// 	button.hide(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.hide();
					blogContainer.html(' <div class="no-data">Sorry we couldn’t find any results for “'+searchWord+'”. Please try again.</div>');
				}
			},
		});
	});

	$(document).on("click", function (event) {
		// If the target is not the container or a child of the container, then process
		// the click event for outside of the container.
		if ($(event.target).closest(".custom-select-wrapper").length === 0) {
			if ($(".custom-select").hasClass("open")){
				$(".custom-select").removeClass('open');
			}
		}
	});

	$(".clearSearch").on('click', function (e) {
		$('#search-word').val('');
		$('.searchIcon').show()
		$('.clearSearch').hide()

		let searchWordPage = $('#search-word').data('page');
		searchWordPage = typeof searchWordPage == "undefined" ? 'blog' : searchWordPage;


		let selectedTagId = $('.custom-option.selected').data('value');
		//console.log(selectedTagId, 'selectedTagId')
		if(selectedTagId === 'tags'){
			selectedTagId = "";
		}
		const button = $("#loadMoreBtn"),


			searchWord = $('#search-word').val(),
			data = {
				action: "loadmore",
				query: JSON.stringify({"page":0,"pagename":searchWordPage,"tag_id":selectedTagId,"paged":0,"s":"","sentence":"","title":"","tag__in":[],"cache_results":true,"update_post_term_cache":true,"lazy_load_term_meta":true,"update_post_meta_cache":true,"posts_per_page":9,"nopaging":false,"order":"desc"}), // that's how we get params from wp_localize_script() function
				page: 0,
			};
		const blogContainer = $(".blogContainer");

		$.ajax({
			// you can also use $.post here
			url: loadmore_params.ajaxurl, // AJAX handler
			data: data,
			type: "POST",
			beforeSend: function (xhr) {
				button.hide();
				blogContainer.html(' <div class="lds-ring"><div></div><div></div><div></div><div></div></div>');
				$('.lds-ring').show();

			},
			success: function (data) {
				// if($('.custom-option.selected').data('value') !== undefined){
				// 	button.hide();
				// } else {
				// 	button.show();
				// }
				button.show();
				$('.lds-ring').hide();
				if (data) {
					// button.text("Load More").prev().before(data); // insert new posts
					button.text("Load More");
					button.attr('style', 'pointer-events: auto;');
					blogContainer.html(data); // insert new posts
					loadmore_params.current_page = 1;

					let postsParams = JSON.parse(loadmore_params.posts);
					delete postsParams['s'];
					loadmore_params.posts = JSON.stringify(postsParams);

					// if (loadmore_params.current_page == loadmore_params.max_page)
					// 	button.hide(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.hide();
					blogContainer.html(' <div class="no-data">Sorry we couldn’t find any results for “'+searchWord+'”. Please try again.</div>');
				}
			},
		});
	});

	$("#search-word").on('change', function (e) {
		if( $(this).val() ) {
			$('.searchIcon').hide()
			$('.clearSearch').show()
		} else {
			$('.searchIcon').show()
			$('.clearSearch').hide()
		}
	});


	var elSearch = document.querySelector('.custom-select-wrapper');
	if(elSearch){
		document.querySelector('.custom-select-wrapper').addEventListener('click', function() {
			this.querySelector('.custom-select').classList.toggle('open');
		})
		for (const option of document.querySelectorAll(".custom-option")) {
			option.addEventListener('click', function() {
				$('.clear-tags').addClass('show');
				$("#loadMoreBtn").hide();
				// this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
				// this.classList.add('selected');
				this.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;

			})
		}

	}

// window.addEventListener('blur', () => {
//   $(".animatedWord").html("");
// });
// window.addEventListener('focus', () => {
// 	console.log("done");
//   $(".animatedWord").html("");
// });
// window.addEventListener('blur', () => {
// 	console.log("done");
//   $(".animatedWord").html("");
// });
// document.addEventListener('visibilitychange', function() {
// 	$(".animatedWord").html("");
// })

	// check if current tab is active or not
	vis(function(){
		if(vis()){

			// tween resume() code goes here
			setTimeout(function(){
				console.log("tab is visible - has focus");
				$(".animatedWord").html("");
			},100);

		} else {

			// tween pause() code goes here
			console.log("tab is invisible - has blur");
			$(".animatedWord").html("");
		}
	});

});

var vis = (function(){
	var stateKey,
		eventKey,
		keys = {
			hidden: "visibilitychange",
			webkitHidden: "webkitvisibilitychange",
			mozHidden: "mozvisibilitychange",
			msHidden: "msvisibilitychange"
		};
	for (stateKey in keys) {
		if (stateKey in document) {
			eventKey = keys[stateKey];
			break;
		}
	}
	return function(c) {
		if (c) document.addEventListener(eventKey, c);
		return !document[stateKey];
	}
})();