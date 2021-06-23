import * as jQuery from "jquery";
import "bootstrap";
import { prefix, devData, home } from "../../globalContent.js";
import "jquery-validation";
import "block-ui";
import Glide, {
	Controls,
	Breakpoints,
	Swipe,
	Images,
} from "@glidejs/glide/dist/glide.modular.esm";
import "@fancyapps/fancybox";
import Masonry from "masonry-layout";
import jQueryBridget from "jquery-bridget/jquery-bridget.js";
import imagesLoaded from "imagesloaded";

// media query change
function WidthChange(mq) {
	return mq.matches ? 60 : 32;
}

function setSocialNavLeftPosition() {
	if ($("." + prefix + "-fix-social").length == 0) {
		return false;
	}

	const mq = window.matchMedia("(min-width: 1200px)");

	let $social = $("." + prefix + "-fix-social");
	let marginLeft = $("#" + prefix + "-header")
		.find(".container")
		.offset().left;

	mq.addListener(WidthChange);

	let adjustment = WidthChange(mq);

	$social.css({ left: marginLeft - adjustment + "px" });
}

function isOnScreen(element)
{
    var curPos = element.offset();
		var curTop = curPos.top - $(window).scrollTop();
    var screenHeight = $(window).height();
    return (curTop > screenHeight) ? false : true;
}

function setSocialNavPosition() {
	if ($("." + prefix + "-fix-social").length == 0) {
		return false;
	}

	const $topBar = $("." + prefix + "-top-bar");
	const topBarOuterHeight =
		$topBar.length && $topBar.css("display") !== "none"
			? $topBar.outerHeight()
			: 0;

	//console.log("hidden", $("." + prefix + "-top-bar").css("display") !== "none");

	const $hero = $("." + prefix + "-hero");
	const heroOuterHeight =
		$hero.length > 0 && !$hero.hasClass("closed") ? $hero.outerHeight() : 0;
	//$hero.length && $hero.css("opacity") !== "0" ? $hero.outerHeight() : 0;

	const $social = $("." + prefix + "-fix-social");

	const $windowHeight   = $(window).height();

	let socialTopSpacing = 160;

	if ($windowHeight <= 800) {
		socialTopSpacing = $windowHeight - $social.innerHeight() - 30;
	}

	const scrollPosition = $(document).scrollTop();

	const $yield = $("#yield");
	const yieldPositionStart = topBarOuterHeight + heroOuterHeight;
	const yieldOuterHeight = $yield.length ? $yield.outerHeight() : 0;
	const HeaderFooterHeight =
		$("footer").innerHeight() + $("header").innerHeight();
	let pageAdjustmentHeaderfooter = $("body").hasClass("home")
		? HeaderFooterHeight - $(".tbp-intro").innerHeight()
		: HeaderFooterHeight;

	/* let pageAdjustment = 0.825;
	pageAdjustment =
		($(".single-post").length && $(".single-post").css("display") !== "none") || ( $(".page").length && $(".page").css("display") !== "none")
			? 0.825
			: pageAdjustment; */

	const stopScrollingAt = Math.floor(
		topBarOuterHeight +
			heroOuterHeight +
			yieldOuterHeight -
			pageAdjustmentHeaderfooter
	);

	if ($windowHeight >= 650) {
		if (scrollPosition > yieldPositionStart) {
			//if (scrollPosition <= stopScrollingAt) {
			if(!isOnScreen($('footer'))){
				$social.css({ position: "fixed", top: socialTopSpacing });
			} else {
				$social.css({
					position: "absolute",
					top: stopScrollingAt - socialTopSpacing,
				});
			}
		} else {
			$social.css({
				position: "absolute",
				top: topBarOuterHeight + heroOuterHeight + socialTopSpacing,
			});
		}
	}

	if ($windowHeight <= 650) {
		$social.css({
			position: "absolute",
			top: heroOuterHeight + 160,
		});
	}
}

// Paginate For Load More
function paginate(array, page_size, page_number) {
	// human-readable page numbers usually start with 1, so we reduce 1 in the first argument
	return array.slice((page_number - 1) * page_size, page_number * page_size);
}

// For using masonry() and imagesLoaded() functions
jQueryBridget("masonry", Masonry, $);
jQueryBridget("imagesLoaded", imagesLoaded, $);

$(() => {
	let config = typeof newsletterData !== "undefined" ? newsletterData : devData;
	let security = config.security;
	let ajaxUrl = config.ajaxUrl;
	let emailRequiredText = config.emailRequiredText;
	let emailWrongText = config.emailWrongText;
	let emailExistsText = config.emailExistsText;
	let emailSuccesText = config.emailSuccesText;
	let countDownDate = config.countDownDate;
	let topBarHeroCloseButtonText =
		config.topBarHeroCloseButtonText !== undefined
			? config.topBarHeroCloseButtonText
			: "Close";
	let topBarHeroClosedButtonText =
		config.topBarHeroClosedButtonText !== undefined
			? config.topBarHeroClosedButtonText
			: "View <strong>Thomspon Boxing’s</strong> latest!";
	// let form = $('form[name="' + prefix + '-subscribe-form"]');
	// Subscribe Validation Settings Start
	let blockDiv =
		'<div class="block-div w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: #fff; opacity: 0.9; z-index: 9999; position: absolute; top: 0; left: 0;">' +
		'<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">\n' +
		'  <span class="sr-only">Loading...</span>\n' +
		"</div>" +
		"</div>";
	$.validator.methods.email = function (value, element) {
		return (
			this.optional(element) ||
			/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)
		);
	};
	let newsletterValidator = $(
		'form[name="' + prefix + '-subscribe-form"]'
	).validate({
		rules: {
			email_address: {
				required: true,
				email: true,
				remote: {
					type: "POST",
					url: ajaxUrl,
					dataType: "JSON",
					data: {
						action: "handle_constant_contact_data",
						security: security,
						email: () => {
							return $('form[name="' + prefix + '-subscribe-form"]')
								.find('input[name="email_address"]')
								.val();
						},
					},
					beforeSend: () => {
						newsletterValidator.resetForm();
						$('form[name="' + prefix + '-subscribe-form"]')
							.find(".input-group")
							.append(blockDiv);
					},
					complete: (response) => {
						let form = $('form[name="' + prefix + '-subscribe-form"]');
						if (response.responseJSON) {
							newsletterValidator.resetForm();
							let el = $(
								'<div class="' +
									prefix +
									'-success" data-type="success" style="display:none;">' +
									emailSuccesText +
									"</div>"
							);
							el.appendTo(form.find(".input-group"));
							$("." + prefix + "-success")
								.fadeIn(100)
								.promise()
								.done(function () {
									form.trigger("reset");
									$(".block-div").remove();
								});
							setTimeout(() => {
								$("." + prefix + "-success").fadeOut();
							}, 5000);
						} else {
							$("." + prefix + "-success").remove();
							$(".block-div").remove();
						}
					},
				},
			},
		},
		messages: {
			email_address: {
				required: emailRequiredText,
				email: emailWrongText,
				remote: emailExistsText,
			},
		},
		errorElement: "div",
		errorPlacement: (error, element) => {
			error.addClass("error").attr("data-type", "validator-error");

			error.insertAfter(element);
		},
		onkeyup: false,
		onfocusout: false,
	});
	// Subscribe Validation Settings Finish

	// Home and Single Post Page News Grid Masonry Settings
	if ($(".grid").length > 0) {
		let $grid = $(".grid").imagesLoaded(function () {
			// init Masonry after all images have loaded
			$grid.masonry({
				itemSelector: ".grid-item",
				percentPosition: true,
			});
		});

		// Load More Settings
		if ($("." + prefix + "-related-posts .load-more").length > 0) {
			$("." + prefix + "-related-posts .load-more").on("click", function (e) {
				e.preventDefault();
				let $this = $(this);
				let textBefore = $this.text();
				let spinner =
					'<div class="d-flex justify-content-center">' +
					'<div class="spinner-border text-light" role="status">' +
					'<span class="sr-only">Loading...</span>' +
					"</div>" +
					"</div>";
				$this.html(spinner);
				if (config.env === "dev") {
					let limit = home.related.limit;
					let page = $this.data("page");
					let totalnews = home.related.posts;
					let totalpage = Math.ceil(totalnews.length / limit);
					page++;
					if (page <= totalpage) {
						let newPosts = paginate(totalnews, limit, page);
						for (let i = 0; i < newPosts.length; ++i) {
							let $newGridItem = $(
								'<div class="grid-item">' +
									'<div class="card-wrapper">' +
									'<a class="card" title="' +
									newPosts[i].title +
									'" href="' +
									newPosts[i].link +
									'">' +
									'<img data-id="' +
									(i + limit) +
									'" data-limit="' +
									limit +
									'" src="' +
									newPosts[i].img +
									'" class="card-img-top" alt="' +
									newPosts[i].title +
									'">' +
									'<div class="card-body">' +
									'<p class="card-title">' +
									newPosts[i].slogan +
									"</p>" +
									"<p>" +
									newPosts[i].title +
									"</p>" +
									'<small class="publication-date text-muted">' +
									newPosts[i].date +
									"</small>" +
									"</div>" +
									"</a>" +
									"</div>" +
									"</div>"
							);
							$this.fadeOut();
							$newGridItem.hide();
							$grid.append($newGridItem);
							imagesLoaded($newGridItem, function () {
								$newGridItem.show();
								$grid.masonry("appended", $newGridItem);
								if (page !== totalpage) {
									$this.html(textBefore);
									$this.fadeIn();
								}
							});
						}
						$this.data("page", page);
						if (page === totalpage) {
							$this.fadeOut(250);
						}
					}
				} else {
					let limit = config.postsPerPageLimit;
					let page = $this.data("page");
					let totalpage = Math.ceil(
						parseInt($(".grid").attr("data-total-posts")) / limit
					);
					page++;
					if (page <= totalpage) {
						$.ajax({
							type: "POST",
							url: ajaxUrl,
							dataType: "JSON",
							data: {
								action: "load_more_posts",
								security: security,
								page: page,
								limit: limit,
							},
							beforeSend: function () {
								setTimeout(function () {
									$this.fadeOut();
								}, 100);
							},
							success: function (response) {
								if (response.result === "success") {
									let newPosts = response.posts;
									for (let i = 0; i < newPosts.length; ++i) {
										let $newGridItem = $(
											'<div class="grid-item">' +
												'<div class="card-wrapper">' +
												'<a class="card" title="' +
												newPosts[i].title +
												'" href="' +
												newPosts[i].link +
												'">' +
												'<img data-id="' +
												parseInt(i + limit) +
												'" data-limit="' +
												limit +
												'" src="' +
												newPosts[i].img +
												'" class="card-img-top" alt="' +
												newPosts[i].title +
												'">' +
												'<div class="card-body">' +
												'<p class="card-title">' +
												newPosts[i].slogan +
												"</p>" +
												"<p>" +
												newPosts[i].title +
												"</p>" +
												'<small class="publication-date text-muted">' +
												newPosts[i].date +
												"</small>" +
												"</div>" +
												"</a>" +
												"</div>" +
												"</div>"
										);
										$newGridItem.hide();
										$grid.append($newGridItem);
										imagesLoaded($newGridItem, function () {
											$newGridItem.show();
											$grid.masonry("appended", $newGridItem);
											if (page !== totalpage) {
												$this.html(textBefore);
												$this.fadeIn();
											}
										});
									}
									$this.data("page", page);
									if (page === totalpage) {
										$this.fadeOut(250);
									}
								}
							},
						});
					}
				}
			});
		}
	}

	if ($(".glide").length > 0) {
		let glide = new Glide(".glide", {
			type: "slider",
			startAt: 0,
			perView: 3,
			rewind: true,
			gap: 30,
			breakpoints: {
				767: {
					gap: 16,
					startAt: 0,
					perView: 2,
					peek: {
						before: 0,
						after: 30,
					},
				},
			},
		});

		glide.mount({ Controls, Breakpoints, Swipe });
	}

	// Used on Homepage Slider Carousel
	if ($(".promotions-glide").length > 0) {
		let glide = new Glide(".glide", {
			type: "slider",
			startAt: 0,
			perView: 1,
			rewind: true,
			gap: 30,
			breakpoints: {
				767: {
					gap: 16,
					startAt: 0,
					perView: 1,
					peek: {
						before: 0,
						after: 30,
					},
				},
			},
		});

		glide.mount({ Images, Controls, Breakpoints, Swipe });
	}

	$('[data-fancybox*="gallery-"]').fancybox({
		buttons: ["close"],
		thumbs: false,
		animationEffect: "fade",
	});

	// Posts and Fighters Page Social Share Settings Start
	$(".single-social-share")
		.find("a#" + prefix + "-facebook")
		.on("click", function (e) {
			e.preventDefault();
			let post_url = $("#" + prefix + "-current-url").val();
			let post_urlEncoded = encodeURIComponent(post_url);
			window.open(
				"https://www.facebook.com/sharer/sharer.php?u=" + post_urlEncoded
			);
		});

	$(".single-social-share")
		.find("a#" + prefix + "-twitter")
		.on("click", function (e) {
			e.preventDefault();
			let post_url = $("#" + prefix + "-current-url").val();
			let post_urlEncoded = encodeURIComponent(post_url);
			let post_title =
				$("." + prefix + "-single-title h2").text() ||
				$("#" + prefix + "-fighter-header").text();
			window.open(
				"https://twitter.com/intent/tweet/?text=" +
					post_title +
					"&url=" +
					post_urlEncoded
			);
		});

	$(".single-social-share")
		.find("a#" + prefix + "-email")
		.on("click", function (e) {
			e.preventDefault();
			let post_url = $("#" + prefix + "-current-url").val();
			let post_urlEncoded = encodeURIComponent(post_url);
			let post_title =
				$("." + prefix + "-single-title h2").text() ||
				$("#" + prefix + "-fighter-header").text();
			window.open("mailto:?subject=" + post_title + "&body=" + post_urlEncoded);
		});

	$(".single-social-share")
		.find("a#" + prefix + "-link")
		.on("click", function (e) {
			e.preventDefault();
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($("#" + prefix + "-current-url").val()).select();
			document.execCommand("copy");
			$temp.remove();
		});

	$(".single-social-share")
		.find("a#" + prefix + "-link")
		.popover({
			content: "Link Copied...",
			trigger: "click",
			template:
				'<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-body"></div></div>',
		})
		.on("shown.bs.popover", function () {
			setTimeout(function () {
				$(".single-social-share")
					.find("a#" + prefix + "-link")
					.popover("hide");
			}, 2000);
		});
	// Posts and Fighters Page Social Share Settings Finish

	// Countdown Function And Settings Start
	function makeTimer() {
		//		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
		var endTime = new Date(countDownDate + " PST");
		endTime = Date.parse(endTime) / 1000;

		console.log(countDownDate);

		var now = new Date();
		now = Date.parse(now) / 1000;

		var timeLeft = endTime - now;

		if (timeLeft > 0) {
			var days = Math.floor(timeLeft / 86400);
			var hours = Math.floor((timeLeft - days * 86400) / 3600);
			var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
			var seconds = Math.floor(
				timeLeft - days * 86400 - hours * 3600 - minutes * 60
			);

			if (hours < "10") {
				hours = "0" + hours;
			}
			if (minutes < "10") {
				minutes = "0" + minutes;
			}
			if (seconds < "10") {
				seconds = "0" + seconds;
			}

			$("#days").html(days + "<span>Days</span>");
			$("#hours").html(hours + "<span>Hours</span>");
			$("#minutes").html(minutes + "<span>Minutes</span>");
			$("#seconds").html(seconds + "<span>Seconds</span>");
			$("." + prefix + "-hero")
				.removeClass("without-countdown")
				.addClass("with-countdown");
		} else {
			clearInterval(countdownInterval);
			$("." + prefix + "-inplayer-countdown").remove();
			$("." + prefix + "-hero")
				.removeClass("with-countdown")
				.addClass("without-countdown");
		}
	}

	var countdownInterval = setInterval(function () {
		if ($("#days").length > 0) {
			makeTimer();
		}
	}, 1000);

	$("." + prefix + "-inplayer-scroll-down").on("click", function (e) {
		e.preventDefault();
		$("html, body").animate(
			{
				scrollTop: $("#" + prefix + "-header").offset().top,
			},
			1000
		);
	});
	// Countdown Function And Settings Finish

	setSocialNavPosition();
	setSocialNavLeftPosition();

	if ($(".bar-close").hasClass("closed")) {
		$(".bar-close").html(topBarHeroClosedButtonText);
	} else {
		$(".bar-close").html(topBarHeroCloseButtonText);
	}

	$(".bar-close").on("click", function (e) {
		e.preventDefault();
		let button = $(this);
		if (button.hasClass("closed")) {
			button.removeClass("closed").html(topBarHeroCloseButtonText);
			$("#" + prefix + "-hero").removeClass("closed");
			$("body").addClass(prefix + "-hero-opened");
		} else {
			button.addClass("closed").html(topBarHeroClosedButtonText);
			$("#" + prefix + "-hero").addClass("closed");
			$("body").removeClass(prefix + "-hero-opened");
		}
		setTimeout(function () {
			setSocialNavPosition();
		}, 250);
	});

	// Add Inplayer Button Click To Buy Now

	if ($("#" + prefix + "-navigation").find(".buy-now a").length > 0) {
		$("#" + prefix + "-navigation")
			.find(".buy-now a")
			.attr("href", "javascript:;");
		$("#" + prefix + "-navigation")
			.find(".buy-now a")
			.attr("data-src", "#" + prefix + "-inplayer-video");
		$("#" + prefix + "-navigation")
			.find(".buy-now a")
			.attr("data-fancybox", "inplayer-3");
		$("#" + prefix + "-navigation")
			.find(".buy-now a")
			.addClass("inplayer-fancy");
	}

	// Close Navigation If Press Watch Now Banner
	$("#" + prefix + "-navigation .inplayer-fancy").on("click", function () {
		$("body").css({ position: "static" });
		$(window).scrollTop(offsetY);
		$("#" + prefix + "-overlay").fadeOut(125);
		$("#" + prefix + "-navigation").toggleClass("show");
		$("#" + prefix + "-navigation-icon-open").prop("disabled", false);
	});

	// HANDLING FAQs COLLAPSE HANDLING

	let $questions = $("." + prefix + "-questions");
	let $collapseSet = $questions.find(".btn-link");
	let $expanded = $questions.find("button[aria-expanded=true]");

	function setCollapseOpenIcon(element) {
		element.find(".wrapper.closed").removeClass("closed").addClass("opened");
	}

	//setCollapseOpenIcon($expanded);

	$collapseSet.on("click", { elem: $collapseSet }, function (e) {
		if ($(this).find(".wrapper").hasClass("opened")) {
			$(this).find(".wrapper").removeClass("opened").addClass("closed");
		} else {
			e.data.elem.find(".wrapper").removeClass("opened").addClass("closed");
			$(this).find(".wrapper").removeClass("closed").addClass("opened");
		}
	});

	// HANDLING FAQs COLLAPSE HANDLING END

	// HANDLING MAIN NAVIGATION

	// offsetY: Make the page stay at the position it was at before the overlay
	let offsetY = window.pageYOffset;

	// Opening Main Navigation
	$("#" + prefix + "-navigation-icon-open").click(function (e) {
		e.preventDefault();
		offsetY = window.pageYOffset;

		$("body").css({
			position: "fixed",
			top: -offsetY + "px",
			width: "100%",
		});

		$("#" + prefix + "-overlay").fadeIn(125);
		$("#" + prefix + "-navigation").toggleClass("show");
		$(this).prop("disabled", true);
	});

	// Closing Main Navigation
	$("#" + prefix + "-navigation-icon-close").click(function (e) {
		e.preventDefault();
		$("body").css({ position: "static" });
		$(window).scrollTop(offsetY);
		$("#" + prefix + "-overlay").fadeOut(125);
		$("#" + prefix + "-navigation").toggleClass("show");
		$("#" + prefix + "-navigation-icon-open").prop("disabled", false);
	});

	// HANDLING MAIN NAVIGATION END

	// FQAS FORM VALIDATION

	if (
		config.contactForm &&
		$("#" + prefix + "-form-" + config.contactForm.id).length > 0
	) {
		$("#" + prefix + "-form-" + config.contactForm.id).validate({
			rules: {
				firstname: {
					required: true,
				},
				lastname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				message: {
					required: true,
				},
			},
			messages: {
				firstname: config.contactForm.firstname_required_text,
				lastname: config.contactForm.lastname_required_text,
				email: {
					required: config.contactForm.email_required_text,
					email: config.contactForm.email_validate_text,
				},
				message: config.contactForm.message_required_text,
			},
			submitHandler: function (form) {
				let formData = new FormData();
				formData.append("_wpcf7", config.contactForm.id);
				formData.append("_wpcf7_version", "5.1.9");
				formData.append("_wpcf7_locale", "en_US");
				formData.append(
					"_wpcf7_unit_tag",
					"wpcf7-f" + config.contactForm.id + "-o1"
				);
				formData.append("_wpcf7_container_post", "0");
				formData.append(
					"firstname",
					$("#" + prefix + "-form-" + config.contactForm.id)
						.find('[name="firstname"]')
						.val()
				);
				formData.append(
					"lastname",
					$("#" + prefix + "-form-" + config.contactForm.id)
						.find('[name="lastname"]')
						.val()
				);
				formData.append(
					"email",
					$("#" + prefix + "-form-" + config.contactForm.id)
						.find('[name="email"]')
						.val()
				);
				formData.append(
					"message",
					$("#" + prefix + "-form-" + config.contactForm.id)
						.find('[name="message"]')
						.val()
				);
				var settings = {
					async: true,
					crossDomain: true,
					url:
						"/wp-json/contact-form-7/v1/contact-forms/" +
						config.contactForm.id +
						"/feedback",
					method: "POST",
					headers: {
						accept: "application/json, text/javascript, */*; q=0.01",
						"x-requested-with": "XMLHttpRequest",
						"cache-control": "no-cache",
					},
					processData: false,
					contentType: false,
					mimeType: "multipart/form-data",
					data: formData,
				};
				$("#" + prefix + "-form-" + config.contactForm.id)
					.find(".form-box")
					.css({ position: "relative" })
					.append(blockDiv);
				$.ajax(settings)
					.done(function (response) {
						response = JSON.parse(response);
						if (response.status === "mail_sent") {
							$("#" + prefix + "-form-" + config.contactForm.id)
								.find(".message")
								.addClass("success")
								.html(config.contactForm.success_message);
						} else {
							$("#" + prefix + "-form-" + config.contactForm.id)
								.find(".message")
								.addClass("error")
								.html(config.contactForm.failed_message);
						}
						$("#" + prefix + "-form-" + config.contactForm.id)
							.find(".message")
							.fadeIn(100)
							.promise()
							.done(function () {
								$(".block-div").remove();
								$("#" + prefix + "-form-" + config.contactForm.id)[0].reset();

								setTimeout(function () {
									$("#" + prefix + "-form-" + config.contactForm.id)
										.find(".message")
										.fadeOut(100);
								}, 5000);
							});
					})
					.fail(function (xhr, status, error) {
						$("#" + prefix + "-form-" + config.contactForm.id)
							.find(".message")
							.addClass("error")
							.html(config.contactForm.failed_message);
						$("#" + prefix + "-form-" + config.contactForm.id)
							.find(".message")
							.fadeIn(100)
							.promise()
							.done(function () {
								$(".block-div").remove();
								$("#" + prefix + "-form-" + config.contactForm.id)[0].reset();

								setTimeout(function () {
									$("#" + prefix + "-form-" + config.contactForm.id)
										.find(".message")
										.fadeOut(100);
								}, 5000);
							});
						$("#" + prefix + "-form-" + config.contactForm.id)[0].reset();
						console.log(xhr.responseText);
						console.log(status);
						console.log(error);
					});
				return false;
			},
		});
	}

	// FQAS FORM VALIDATION END

	$(window).scroll(function () {
		// Get social sidebar scroll to set fixed|absolute position
		setTimeout(function () {
			setSocialNavPosition();
		}, 100);
	});

	$(window).resize(function () {
		// Get social sidebar scroll to set fixed|absolute position
		setTimeout(function () {
			setSocialNavLeftPosition();
		}, 25);
	});

	// PPV InPlayer button update:
	// This script was added according to the InPlayer support recomendations.
	// Refer to https://innolive.atlassian.net/browse/CSII-93
	if (document.getElementById("watch")) {
		document.getElementById("watch").style.display = "none";

		paywall.on("access", (e, data) => {
			if (data.hasAccess == true) {
				document.getElementById("order").style.display = "none";
				document.getElementById("watch").style.display = "block";
			}
		});
	}
});
