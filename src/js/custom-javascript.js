// Add your JS customizations here
if (window.NodeList && !NodeList.prototype.forEach) {
	NodeList.prototype.forEach = Array.prototype.forEach;
}
// https://tc39.github.io/ecma262/#sec-array.prototype.find
if (!Array.prototype.find) {
	Object.defineProperty(Array.prototype, "find", {
		value: function (predicate) {
			// 1. Let O be ? ToObject(this value).
			if (this == null) {
				throw new TypeError('"this" is null or not defined');
			}

			var o = Object(this);

			// 2. Let len be ? ToLength(? Get(O, "length")).
			var len = o.length >>> 0;

			// 3. If IsCallable(predicate) is false, throw a TypeError exception.
			if (typeof predicate !== "function") {
				throw new TypeError("predicate must be a function");
			}

			// 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
			var thisArg = arguments[1];

			// 5. Let k be 0.
			var k = 0;

			// 6. Repeat, while k < len
			while (k < len) {
				// a. Let Pk be ! ToString(k).
				// b. Let kValue be ? Get(O, Pk).
				// c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
				// d. If testResult is true, return kValue.
				var kValue = o[k];
				if (predicate.call(thisArg, kValue, k, o)) {
					return kValue;
				}
				// e. Increase k by 1.
				k++;
			}

			// 7. Return undefined.
			return undefined;
		},
	});
}

// ----------------------Homepage Sliders and Script  ---------------------- //
jQuery(function () {
	jQuery(".navbar-toggler").on("click", function () {
		if (jQuery("#navbarNavDropdown").hasClass("show")) {
			document.body.style.overflow = "unset";
		} else {
			document.body.style.overflow = "hidden";
		}
	});

	jQuery(".slide-container").on("init", function (event, slick) {
		// empty's html from all slides

		jQuery(".slide").each(function (index) {
			let currentTitle = jQuery(this).find(".main-title_home");
			let currentWord = currentTitle.data("word-change");

			let listWord_text = currentTitle.data("new-word") + "," + currentWord;
			let listWord = listWord_text.split(",");

			let text = currentTitle
				.html()
				.replace(
					currentWord,
					'<span class="animatedWord">' + currentWord + "</span>"
				);

			if (currentWord.length > 0) {
				currentTitle.html(text);
			}

			function typingGame() {
				for (let i = 0; i < listWord.length; i++) {
					let word = listWord[i];

					// if (document.hidden) {
					// 	word = listWord[0];
					// }

					setTimeout(function () {
						currentTitle.find(".animatedWord").html("");
						let i = 0;

						let interval = setInterval(function () {
							currentTitle.find(".animatedWord").html(function (_, html) {
								return html + word.charAt(i);
							});
							i++;

							if (i > word.length) {
								clearInterval(interval);
							}

							if (document.hidden) {
								clearInterval(interval);
								currentTitle.find(".animatedWord").html("");
							}
						}, 500 / word.length); // End setInterval
					}, (i + 1) * 3000); // End setTimeout
				} // End For
			}

			typingGame();
			setInterval(function () {
				typingGame();
			}, listWord.length * 3000);

			// typingGame();
			// setInterval(function () {
			// 	typingGame();
			// }, listWord.length * 3000);
		});
	});

	jQuery(".slide-container").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 3500,
		appendArrows: ".arrows-container",
		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',
	});

	// When the user scrolls the page, execute myFunction
	window.onscroll = function () {
		myFunction();
	};

	// Get the navbar
	var navbar = document.getElementById("main-nav");

	// Get the offset position of the navbar
	var sticky = navbar.offsetTop;

	// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
	function myFunction() {
		if (window.pageYOffset >= 30) {
			navbar.classList.add("sticky");
		} else {
			navbar.classList.remove("sticky");
		}
	}

	const thumbs = document.querySelectorAll(".thumb");

	jQuery(".performance_slick1").slick({
		lazyLoad: "progressive",
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
	});

	jQuery(".asnavForClass").slick({
		lazyLoad: "progressive",

		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: true,

		// appendArrows: ".performance-arrows",
		asNavFor: ".performance_slick3, .performance_slick1",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',
		useTransform: false,
	});

	jQuery(".performance_slick3").not(".slick-initialized").slick({
		lazyLoad: "ondemand",
		slidesToShow: thumbs.length,
		slidesToScroll: 1,
		asNavFor: ".asnavForClass, .performance_slick1",
		arrows: false,
		dots: false,
		focusOnSelect: true,

		infinite: true,
		autoplay: false,
	});

	/// progress bar
	let percentTime;
	let tick;
	let time = 0.1;
	let progressBarIndex = 0;

	jQuery(".thumbs_container .progressBar").each(function (index) {
		var progress = "<div class='inProgress inProgress" + index + "'></div>";
		jQuery(this).html(progress);
	});

	function startProgressbar() {
		resetProgressbar();
		percentTime = 0;
		tick = setInterval(interval, 10);
	}

	function interval() {
		if (
			jQuery(
				'.asnavForClass .slick-track div[data-slick-index="' +
					progressBarIndex +
					'"]'
			).attr("aria-hidden") === "true"
		) {
			progressBarIndex = jQuery(
				'.asnavForClass .slick-track div[aria-hidden="false"]'
			).data("slickIndex");
			startProgressbar();
		} else {
			percentTime += 1 / (time + 5);
			jQuery(".inProgress" + progressBarIndex).css({
				width: percentTime + "%",
			});
			if (percentTime >= 100) {
				jQuery(".asnavForClass").slick("slickNext");
				progressBarIndex++;
				if (progressBarIndex > 2) {
					progressBarIndex = 0;
				}
				startProgressbar();
			}
		}
	}
	function resetProgressbar() {
		jQuery(".inProgress").css({
			width: 0 + "%",
		});
		clearInterval(tick);
	}
	startProgressbar();
	// End ticking machine

	jQuery(".thumb").on("click", function () {
		clearInterval(tick);
		var goToThisIndex = jQuery(this).find("span").data("slickIndex");
		jQuery(".asnavForClass").slick("slickGoTo", goToThisIndex, false);
		startProgressbar();
	});

	jQuery(".testimonial_container").slick({
		focusOnSelect: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		draggable: true,

		appendArrows: ".testimonial-arrows",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',

		responsive: [
			{
				breakpoint: 768,
				settings: {
					centerMode: false,
				},
			},
		],
	});

	jQuery(".blog-slider").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		draggable: true,

		// appendArrows: ".blog_arrows",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',

		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});

	jQuery(window).on("resize", function () {
		if (jQuery(".performance_slick3").length) {
			jQuery(".performance_slick3")[0].slick.refresh();
		}
	});
});

const process_section = document.getElementById("process");

if (typeof process_section != "undefined" && process_section != null) {
	const tabs_method = document.querySelector(".tabs_method");
	const tabButtons_method = tabs_method.querySelectorAll('[role="tab_method"]');
	const tempArr_method = tabs_method.querySelectorAll(
		'[role="tabpanel_method"]'
	);
	let tabPanels_method = [];

	for (let i = 0; i < tempArr_method.length; i++) {
		tabPanels_method.push(tempArr_method[i]);
	}

	tabPanels_method[0].classList.remove("hide");
	tabPanels_method[0].classList.add("show");

	tabButtons_method[0].classList.add("current_method");

	let current_method;
	const slides_method = document.querySelector(".tablist_method");
	current_method =
		document.querySelector(".current_method") ||
		slides_method.firstElementChild;

	function methodTabs(event) {
		tabPanels_method.forEach(function (panel) {
			// panel.hidden = true;
			panel.classList.add("hide");
			panel.classList.remove("show");
		});

		tabButtons_method.forEach(function (tab) {
			tab.setAttribute("aria-selected", false);
			// tab.classList.add("current");
		});

		event.currentTarget.setAttribute("aria-selected", true);

		const id = event.currentTarget.id;

		const tabPanel = tabPanels_method.find(function (panel) {
			return panel.getAttribute("aria-labelledby") === id;
		});

		tabPanel.classList.remove("hide");
		tabPanel.classList.add("show");

		current_method.setAttribute("class", "");

		this.classList.add("current_method");

		current_method =
			document.querySelector(".current_method") ||
			slides_method.firstElementChild;
	}

	tabButtons_method.forEach(function (button) {
		return button.addEventListener("click", methodTabs);
	});
}

// ----------------------Homepage Sliders and Script End  ---------------------- //

// ----------------------Contact Page and Script  ---------------------- //
jQuery(function () {
	jQuery(".form-select input").on("click", function () {
		jQuery("#hubspotForm_container .actions").append(
			'<a href="#" class="goBack">Go back</a>'
		);

		const goBack = jQuery(".goBack");
		const value = jQuery(this).val();
		const initialForm = jQuery("#initialForm");
		const toShow = jQuery("#" + value);
		const thankYou = jQuery("#thank-you");

		if (!toShow.hasClass("show-form")) {
			toShow.addClass("show-form");
			initialForm.addClass("hubspotFormsHidden");
			jQuery(".form-select .checkmark").removeClass("no-after");
		}

		goBack.on("click", function (e) {
			e.preventDefault();
			toShow.removeClass("show-form");
			initialForm.removeClass("hubspotFormsHidden");

			goBack.remove();
			jQuery(".form-select .checkmark").addClass("no-after");

			window.scrollTo({ top: 0, behavior: "smooth" });
		});

		const form = jQuery("#" + toShow.get(0).id + " form");

		jQuery(form).on("submit", function () {
			jQuery(".hubspotFormsHidden h2.title").empty();
		});
	});
});

// ----------------------Contact Page and Script End ---------------------- //

// ----------------------Products Page and Script  ---------------------- //

const products_section = document.getElementById("top-products_section");

if (typeof products_section != "undefined" && products_section != null) {
	const videoColumn = document.querySelector(".video-column");
	const playButton = document.querySelector(".buttons-container");
	const playbackIcons = document.getElementById("playpause");
	const playText = document.querySelector(".play-copy");
	const video = document.querySelector(".video_products");
	const videoContainer = document.querySelector("#video-controls");

	const videoBg = videoColumn.getAttribute("data-background");
	videoColumn.style.backgroundImage = "url(" + videoBg + ")";

	var videoH = document.getElementById("video_products");

	// console.log(videoH.offsetHeight);

	// ---------------------- Iframe ---------------------- //
	let url;

	if (document.getElementById("videoSource") !== null) {
		url =
			document.getElementById("videoSource").getAttribute("data-src") || null;
	}

	function togglePlay() {
		if (document.getElementById("videoSource") === null) {
			if (video.paused || video.ended) {
				video.play();
				playbackIcons.checked = true;
				playText.style.display = "none";
				videoColumn.style.backgroundImage = "none";
				videoContainer.classList.remove("hideVideo");
				playButton.style.display = "none";
			} else {
				video.pause();
				playText.style.display = "block";
				playbackIcons.checked = false;
				videoColumn.style.backgroundImage = "url(" + videoBg + ")";
				videoContainer.classList.add("hideVideo");
			}
		}

		if (document.getElementById("videoSource") !== null) {
			document.getElementById("gameBenchVideo").setAttribute("src", url);
			playbackIcons.checked = true;
			playText.style.display = "none";
			videoColumn.style.backgroundImage = "none";
			videoContainer.classList.remove("hideVideo");
			playButton.style.display = "none";
		}
	}

	playButton.addEventListener("click", togglePlay);

	video.addEventListener("pause", function () {
		playbackIcons.checked = false;
		playText.style.display = "block";
		playButton.style.display = "block";
		videoColumn.style.backgroundImage = "url(" + videoBg + ")";
		videoContainer.classList.add("hideVideo");
	});

	video.addEventListener("ended", function () {
		playbackIcons.checked = false;
		playText.style.display = "block";
		videoColumn.style.backgroundImage = "url(" + videoBg + ")";
		videoContainer.classList.add("hideVideo");
	});
}

jQuery(function () {
	const thumbs = document.querySelectorAll(".thumb");

	jQuery(".capability_slick1").slick({
		lazyLoad: "progressive",
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
	});

	jQuery(".asnavForClass_capability").slick({
		lazyLoad: "progressive",

		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: true,

		asNavFor: ".capability_slick3, .capability_slick1",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',
		useTransform: false,
	});

	jQuery(".capability_slick3").not(".slick-initialized").slick({
		lazyLoad: "ondemand",
		slidesToShow: thumbs.length,
		slidesToScroll: 1,
		asNavFor: ".asnavForClass_capability, .capability_slick1",
		arrows: false,
		dots: false,
		focusOnSelect: true,

		infinite: true,
		autoplay: false,
	});

	jQuery(window).on("resize", function () {
		if (jQuery(".capability_slick3").length) {
			jQuery(".capability_slick3")[0].slick.refresh();
		}
	});

	/// progress bar
	let percentTime_capability;
	let tick_capability;
	let time_capability = 0.1;
	let progressBarIndex_capability = 0;

	jQuery(".thumbs_container_capability .progressBar").each(function (index) {
		var progress_capability =
			"<div class='inProgress_capability inProgress_capability" +
			index +
			"'></div>";
		jQuery(this).html(progress_capability);
	});

	function startProgressbar_capability() {
		resetProgressbar_capability();
		percentTime_capability = 0;
		tick_capability = setInterval(interval_capability, 10);
	}

	function interval_capability() {
		if (
			jQuery(
				'.asnavForClass_capability .slick-track div[data-slick-index="' +
					progressBarIndex_capability +
					'"]'
			).attr("aria-hidden") === "true"
		) {
			progressBarIndex_capability = jQuery(
				'.asnavForClass_capability .slick-track div[aria-hidden="false"]'
			).data("slickIndex");
			startProgressbar_capability();
		} else {
			percentTime_capability += 1 / (time_capability + 5);
			jQuery(".inProgress_capability" + progressBarIndex_capability).css({
				width: percentTime_capability + "%",
			});
			if (percentTime_capability >= 100) {
				jQuery(".asnavForClass_capability").slick("slickNext");
				progressBarIndex_capability++;
				if (progressBarIndex_capability > 2) {
					progressBarIndex_capability = 0;
				}
				startProgressbar_capability();
			}
		}
	}
	function resetProgressbar_capability() {
		jQuery(".inProgress_capability").css({
			width: 0 + "%",
		});
		clearInterval(tick_capability);
	}
	startProgressbar_capability();
	// End ticking machine
});

// ----------------------Products Custom Tabs Script  ---------------------- //

const products_capability = document.getElementById("our-process_section");

if (typeof products_capability != "undefined" && products_capability != null) {
	const tabs = document.querySelector(".tabs");
	const tabButtons = tabs.querySelectorAll('[role="tab"]');
	const tempArr = tabs.querySelectorAll('[role="tabpanel"]');
	let tabPanels = [];

	for (let i = 0; i < tempArr.length; i++) {
		tabPanels.push(tempArr[i]);
	}

	tabPanels[0].classList.remove("hide");
	tabPanels[0].classList.add("show");

	const tabShow = document.querySelector('[role="tablist"]');

	let current;
	const slides = document.querySelector(".tablist");
	current = document.querySelector(".current") || slides.firstElementChild;

	if (window.matchMedia("(max-width: 767px)").matches) {
		if (tabShow.classList.contains("tabsShow")) {
			tabShow.classList.remove("tabsShow");
		}
	}

	function handleTabClick(event) {
		tabPanels.forEach(function (panel) {
			// panel.hidden = true;
			panel.classList.add("hide");
			panel.classList.remove("show");
		});

		tabButtons.forEach(function (tab) {
			tab.setAttribute("aria-selected", false);
			// tab.classList.add("current");
		});

		event.currentTarget.setAttribute("aria-selected", true);

		const id = event.currentTarget.id;

		const tabPanel = tabPanels.find(function (panel) {
			return panel.getAttribute("aria-labelledby") === id;
		});

		tabPanel.classList.remove("hide");
		tabPanel.classList.add("show");

		tabShow.classList.remove("tabsShow");

		current.setAttribute("class", "");

		this.classList.add("current");

		current = document.querySelector(".current") || slides.firstElementChild;
	}

	tabButtons.forEach(function (button) {
		return button.addEventListener("click", handleTabClick);
	});
}

// ----------------------Products Custom Tabs End Script  ---------------------- //

// ----------------------Products Custom Tabs + Slide Script  ---------------------- //

const tools_section = document.getElementById("tools_section");

if (typeof tools_section != "undefined" && tools_section != null) {
	const tabs_tools = document.querySelector(".tabs_tools");
	const tabButtons_tools = tabs_tools.querySelectorAll('[role="tab_tools"]');
	const tempArr_tools = tabs_tools.querySelectorAll('[role="tabpanel_tools"]');
	let tabPanels_tools = [];

	for (let i = 0; i < tempArr_tools.length; i++) {
		tabPanels_tools.push(tempArr_tools[i]);
	}

	tabButtons_tools[0].classList.add("current_tools");
	tabPanels_tools[0].classList.remove("hide");
	tabPanels_tools[0].classList.add("show");

	const dropDown = document.querySelector(".tab-dropdown");
	const tabShow_tools = document.querySelector('[role="tablist_tools"]');
	let textShow_tools = document.querySelector(".text-main");

	let prev_tools;
	let current_tools;
	let next_tools;
	const slides_tools = document.querySelector(".tablist_tools");
	const prevButton = document.querySelector(".goToPrev");
	const nextButton = document.querySelector(".goToNext");
	current_tools =
		document.querySelector(".current_tools") || slides_tools.firstElementChild;
	prev_tools =
		current_tools.previousElementSibling || slides_tools.lastElementChild;
	next_tools =
		current_tools.nextElementSibling || slides_tools.firstElementChild;

	textShow_tools.innerHTML = tabs_tools.querySelector(
		".current_tools"
	).innerHTML;

	if (window.matchMedia("(max-width: 767px)").matches) {
		if (tabShow_tools.classList.contains("tabsShow")) {
			tabShow_tools.classList.remove("tabsShow");
		}
	}

	function toolsTabs(event) {
		tabPanels_tools.forEach(function (panel) {
			// panel.hidden = true;
			panel.classList.add("hide");
			panel.classList.remove("show");
		});

		tabButtons_tools.forEach(function (tab) {
			tab.setAttribute("aria-selected", false);
			// tab.classList.add("current");
		});

		event.currentTarget.setAttribute("aria-selected", true);

		const id = event.currentTarget.id;

		const tabPanel = tabPanels_tools.find(function (panel) {
			return panel.getAttribute("aria-labelledby") === id;
		});

		// textShow.innerHTML = event.currentTarget.innerHTML;

		textShow_tools.innerHTML = document.querySelector(
			".current_tools"
		).innerHTML;

		// tabPanel.hidden = false;
		tabPanel.classList.remove("hide");
		tabPanel.classList.add("show");

		tabShow_tools.classList.remove("tabsShow");

		prev_tools.setAttribute("class", "");
		current_tools.setAttribute("class", "");
		next_tools.setAttribute("class", "");

		this.classList.add("current_tools");

		current_tools =
			document.querySelector(".current_tools") ||
			slides_tools.firstElementChild;
		prev_tools =
			current_tools.previousElementSibling || slides_tools.lastElementChild;
		next_tools =
			current_tools.nextElementSibling || slides_tools.firstElementChild;

		textShow_tools.innerHTML = current_tools.innerHTML;
		textShow_tools.setAttribute("data-current", id);
	}

	tabButtons_tools.forEach(function (button) {
		return button.addEventListener("click", toolsTabs);
	});

	dropDown.addEventListener("click", function (event) {
		event.stopPropagation();
		this.classList.add("open");

		if (tabShow_tools.classList.contains("tabsShow")) {
			tabShow_tools.classList.remove("tabsShow");
			this.classList.remove("open");
		} else {
			tabShow_tools.classList.add("tabsShow");
		}
	});

	window.addEventListener("click", function (event) {
		document.querySelector(".tab-dropdown ").classList.remove("open");

		tabShow_tools.classList.remove("tabsShow");
	});

	function Slider(slider) {
		function startSlider() {
			current_tools =
				slides_tools.querySelector(".current_tools") ||
				slides_tools.firstElementChild;
			prev_tools =
				current_tools.previousElementSibling || slides_tools.lastElementChild;
			next_tools =
				current_tools.nextElementSibling || slides_tools.firstElementChild;
			// console.log({ current, prev, next });
		}

		function applyClasses() {
			current_tools.classList.add("current_tools");
			prev_tools.classList.add("prev_tools");
			next_tools.classList.add("next_tools");
		}

		function move(direction) {
			// first strip all the classes off the current slides
			prev_tools.setAttribute("class", "");
			current_tools.setAttribute("class", "");
			next_tools.setAttribute("class", "");

			if (direction === "back") {
				// make an new array of the new values, and destructure them over and into the prev, current and next variables
				const oldPrev = prev_tools;
				prev_tools =
					prev_tools.previousElementSibling || slides_tools.lastElementChild;
				current_tools = oldPrev;
				next_tools =
					current_tools.nextElementSibling || slides_tools.firstElementChild;
			} else {
				const oldNext = next_tools;
				current_tools = oldNext;
				prev_tools =
					current_tools.previousElementSibling || slides_tools.lastElementChild;
				next_tools =
					next_tools.nextElementSibling || slides_tools.firstElementChild;
			}

			applyClasses();

			textShow_tools.innerHTML = document.querySelector(
				".current_tools"
			).innerHTML;
			if (tabShow_tools.classList.contains("tabsShow")) {
				tabShow_tools.classList.remove("tabsShow");
			}

			tabPanels_tools.forEach(function (panel) {
				// return (panel.hidden = true);
				panel.classList.add("hide");
				panel.classList.remove("show");
			});
			textShow_tools.setAttribute("data-current", current_tools.id);
			const tabPanel = tabPanels_tools.find(function (panel) {
				return panel.getAttribute("aria-labelledby") === current_tools.id;
			});

			// tabPanel.hidden = false;
			tabPanel.classList.add("show");
			tabPanel.classList.remove("hide");
		}

		// when this slider is created, run the start slider function
		startSlider();
		applyClasses();

		// Event listeners
		prevButton.addEventListener("click", function () {
			move("back");
		});
		nextButton.addEventListener("click", move);
	}
	const mySlider = Slider(document.querySelector(".tablist_tools"));
}

// ----------------------Products Custom Tabs + Slide End Script  ---------------------- //

// ----------------------Modal Script  ---------------------- //

if (typeof products_section != "undefined" && products_section != null) {
	// Get the modal
	var modal = document.getElementById("videoModal");
	var span = document.getElementsByClassName("close-modal")[0];
	let url;

	// if (document.getElementById("videoSource") !== null) {
	// 	url =
	// 		document.getElementById("videoSource").getAttribute("data-src") || null;
	// }

	// When the user clicks on the button, open the modal
	// playButton.onclick = function () {
	// 	modal.style.display = "block";

	// 	if (document.getElementById("videoSource") !== null) {
	// 		document.getElementById("gameBenchVideo").setAttribute("src", url);
	// 	}

	// 	if (video) {
	// 		video.play();
	// 	}
	// 	// video.requestFullscreen();
	// };

	// When the user clicks on <span> (x), close the modal
	// span.onclick = function () {
	// 	modal.style.display = "none";
	// 	if (video) {
	// 		video.pause();
	// 	}
	// 	if (document.getElementById("videoSource") !== null) {
	// 		document.getElementById("gameBenchVideo").setAttribute("src", "");
	// 	}
	// };

	// When the user clicks anywhere outside of the modal, close it
	// window.onclick = function (event) {
	// 	if (event.target == modal) {
	// 		modal.style.display = "none";
	// 		if (video) {
	// 			video.pause();
	// 		}
	// 		if (document.getElementById("videoSource") !== null) {
	// 			document.getElementById("gameBenchVideo").setAttribute("src", "");
	// 		}
	// 	}
	// };
}

// ----------------------Modal Script End  ---------------------- //
jQuery(function () {
	jQuery(".case_study-slider").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		draggable: true,

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',

		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});
});

// ----------------------Products Page and Script End  ---------------------- //

// ----------------------Solutions Script  ---------------------- //

// ----------------------Solutions Script End  ---------------------- //

// ----------------------Blog page Script End  ---------------------- //
jQuery(function () {
	jQuery(".blog_top_slider").slick({
		focusOnSelect: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		draggable: true,

		appendArrows: ".blog_main-arrows",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',

		responsive: [
			{
				breakpoint: 768,
				settings: {
					centerMode: false,
				},
			},
		],
	});

	jQuery(".related_post_slider").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		draggable: true,

		appendArrows: ".related-arrows",

		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',

		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});
});

// ----------------------About Modal Script start  ---------------------- //
const our_team_section = document.getElementById("our_team_section");
if (typeof our_team_section != "undefined" && our_team_section != null) {
	const teamModal = document.getElementById("teamModal");
	const closeTeam = document.getElementsByClassName("close-team")[0];

	const teamLink = document.querySelectorAll(".team-link");
	const teamInfo = document.querySelectorAll(".team-card");

	const modalPic = document.querySelector(".modal-team_pic");
	const modalName = document.querySelector(".modal-team_name");
	const modalPosition = document.querySelector(".modal-team_position");
	const modalGeneral = document.querySelector(".modal-team_data");

	const modalTeamTitle = document.querySelector(".modal-team_title");
	const modalTeamContent = document.querySelector(".modal-team_content");

	// When the user clicks on the button, open the modal
	jQuery(".team-link").on("click", function (event) {
		teamModal.style.display = "block";

		jQuery(modalPic).html("<img src=" + jQuery(this).data("picture") + ">");
		jQuery(modalName).html(jQuery(this).data("name"));
		jQuery(modalPosition).html(jQuery(this).data("position"));
		jQuery(modalTeamTitle).html(jQuery(this).data("general"));

		if (event.target == teamModal) {
			document.body.style.overflow = "unset";
		} else {
			document.body.style.overflow = "hidden";
		}
	});

	closeTeam.onclick = function () {
		teamModal.style.display = "none";
		document.body.style.overflow = "unset";
	};

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		if (event.target == teamModal) {
			teamModal.style.display = "none";
			document.body.style.overflow = "unset";
		}
	};
}

// ----------------------About Modal Script end  ---------------------- //

function isInViewport(element) {
	var rect = element.getBoundingClientRect();
	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <=
			(window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
}

jQuery(function () {
	jQuery("#logo_slider").slick({
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
		arrows: false,
	});

	var getSub = jQuery("#getSubtitle h2");
	var subtitleContainer = jQuery("#subTitlesContainer");
	var mainScroll = jQuery(window).scrollTop();

	getSub.each(function (index, element) {
		subtitleContainer.append(
			"<a href='#' data-index=" + index + ">" + jQuery(this).html() + "</a>"
		);
	});

	subtitleContainer.on("click", "a", function (e) {
		e.preventDefault();
		var element = getSub[jQuery(this).data("index")];

		jQuery(this).parent().find("a").removeClass("active-post");
		jQuery(this).addClass("active-post");

		jQuery("html,body").animate(
			{ scrollTop: jQuery(element).offset().top - 200 },
			"slow"
		);
	});

	jQuery(window).on("scroll", function () {
		var subLinks = jQuery("#subTitlesContainer").find("a");

		getSub.each(function (index, element) {
			if (
				isInViewport(element) &&
				element.getBoundingClientRect().top - 210 < mainScroll
			) {
				jQuery(subLinks[index - 1]).removeClass("active-post");
				jQuery(subLinks[index]).addClass("active-post");
				jQuery(subLinks[index + 1]).removeClass("active-post");
			}
		});

		// console.log(mainScroll);
	});
});

const solutions_section = document.getElementById("top-solutions_section");

if (typeof solutions_section != "undefined" && solutions_section != null) {
	jQuery(function () {
		jQuery(".team-slider").slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			draggable: true,
			arrows: true,
			fade: true,
			appendArrows: "#our-team_arrows",
			prevArrow: '<div class="slick-prev"></div>',
			nextArrow: '<div class="slick-next"></div>',
		});
	});
}
