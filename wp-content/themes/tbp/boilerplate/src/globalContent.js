const globalContent = {
	prefix: "tbp",
	devData: {
		event_status: "",
		event_video: "",
		fighters_status: "",
		env: "dev",
		security: "sadfsfasaf",
		ajaxUrl: "/",
		emailRequiredText: "Please enter some email address!",
		emailWrongText: "Please enter correct email address!",
		emailExistsText: "This email address has already been subscribed!",
		emailSuccesText: "Email was added to newsletter successfully!",
		countDownDate: "20 December 2020 16:30:00",
		contactForm: {
			id: 7394,
			firstname_label: "First name",
			firstname_required_text: "Please provide us your firstname",
			lastname_label: "Last name",
			lastname_required_text: "Please provide us your lastname",
			email_label: "Email address",
			email_required_text: "We need your email address to contact you",
			email_validate_text:
				"Your email address must be in the format of name@domain.com",
			message_label: "Your message",
			message_required_text: "Please add a message",
			submit_button_text: "Send",
			success_message:
				"Thanks for your question. We have already gotten your message and will answer as soon as possible!",
			failed_message:
				"Oops, We are having a problems with form right now! Please try again later.",
		},
	},
	base: {
		navigation_open: {
			src: "./assets/images/navigation-open.svg",
			alt: "",
		},
		navigation_close: {
			src: "./assets/images/navigation-close.svg",
			alt: "",
		},
		banner: {
			src: "",
			alt: "",
		},
		navigation: [
			{
				label: "Home",
				url: "/",
			},
			{
				label: "Questions",
				url: "/faqs.html",
			},
			{
				label: "Buy Now",
				url: "#",
			},
		],
		contact: {
			label: "Contact Info",
			address: "282 South Anita Drive Orange, CA 92868",
			phones: [
				{
					label: "P",
					number: "714-935-0900",
				},
				{
					label: "F",
					number: "714-935-0600",
				},
			],
			email: "help@thompsonboxing.com",
		},
		social: {
			label: "Follow Us",
			networks: [
				{
					label: "Facebook",
					url: "https://www.facebook.com/thompsonboxing/",
				},
				{
					label: "Instagram",
					url: "https://www.instagram.com/thompsonboxing/",
				},
				{
					label: "Twitter",
					url: "https://twitter.com/thompsonboxing",
				},
				{
					label: "YouTube",
					url: "https://www.youtube.com/channel/UCg_u52-QbmfxyCJPc-v5htg",
				},
			],
		},
	},
	home: {
		intro: {
			title: "The Summer just got hotter & we are back!",
			text:
				"Due to the Covid-19 outbreak that is affecting the entire world and in adhering by local and State authorities we have announced the postponement of our March 14 event and the cancellation of our upcoming event on <strong>April 10</strong>, that was scheduled to take place at the <strong>DoubleTree Hotel in Ontario, CA.</strong>",
		},
		video_thumbs: {
			header: "A MESSAGE FROM ALL OF US",
			thumbs: [
				{
					image: "./assets/images/thumb_1.jpg",
					video: "https://www.youtube.com/watch?v=n1noz6O4_a8",
					alt: "Danny Roman",
					title: "Danny Roman",
				},
				{
					image: "./assets/images/thumb_2.jpg",
					video: "https://www.youtube.com/watch?v=c_u62CusG4c",
					alt: "Ruben Villa",
					title: "Ruben Villa",
				},
				{
					image: "./assets/images/thumb_3.jpg",
					video: "https://www.youtube.com/watch?v=S0YzO1Zn6Zc",
					alt: "Giovani Santillan",
					title: "Giovani Santillan",
				},
			],
			subText:
				"The current health situation affects us all, and we encourage you to follow the suggestions and mandated orders by medical experts and authorities to stop the spread of this virus.",
		},
		sponsors_partners: {
			sponsors: [
				{
					title: "Henry | Fortifiber",
					img: "./assets/images/sponsors/henry.svg",
					width: "290",
				},
				{
					title: "Makita",
					img: "./assets/images/sponsors/makita.svg",
					width: "165",
				},
				{
					title: "Omega",
					img: "./assets/images/sponsors/omega.svg",
					width: "145",
				},
				{
					title: "Thompson Building Materials",
					img: "./assets/images/sponsors/tbm.svg",
					width: "150",
				},
			],
			partners: [
				/*{
					title: "Fight Hub Tv",
					img: "./assets/images/partners/fighting-hub.png",
					link: "https://www.youtube.com/user/fighthub/",
					width: "170",
				},*/
				{
					title: "Fino Boxing",
					img: "./assets/images/partners/fino-boxing.png",
					link: "https://www.instagram.com/finoboxing/",
					width: "90",
				},
				{
					title: "Noti Fighting",
					img: "./assets/images/partners/not-fighting.png",
					link: "https://twitter.com/NotiFight/",
					width: "165",
				},
				{
					title: "Supreme Boxing",
					img: "./assets/images/partners/supreme.svg",
					link: "https://www.instagram.com/supremeboxing/",
					width: "80",
				},
				{
					title: "Tru Boxingheadz",
					img: "./assets/images/partners/tru-boxing.svg",
					link: "https://www.instagram.com/truboxingheadz/",
					width: "120",
				},
			],
		},
		promotions: [
			{
				image: "./assets/images/thumb_1.jpg",
				video: "https://www.youtube.com/watch?v=n1noz6O4_a8",
				alt: "Danny Roman",
				title: "Danny Roman",
			},
			{
				image: "./assets/images/thumb_1.jpg",
				video: "https://www.youtube.com/watch?v=n1noz6O4_a8",
				alt: "Danny Roman",
				title: "Danny Roman",
			},
		],
		quote: {
			text:
				"While we pause our regular life’s, please extend a helping hand to those in need.",
		},
		related: {
			header: "Top boxing news",
			limit: 6,
			posts: [
				{
					link: "/single.html",
					img: "./assets/images/gallery1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum ut consectetur eu...",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery2.png",
					slogan: "3, 2, 1 Boxing",
					title: "Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery3.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum ut consectetur eu...",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery5.png",
					slogan: "3, 2, 1 Boxing",
					title: "Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery4.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"6 Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/news-1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"7 Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum ut consectetur eu...",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery5.png",
					slogan: "3, 2, 1 Boxing",
					title: "Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery4.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/news-1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery5.png",
					slogan: "3, 2, 1 Boxing",
					title: "12 Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery4.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"13 Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/news-1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
			],
		},
		fighters: {
			header: "GET TO KNOW THE HEADLINERS",
			bios: [
				{
					img: "./assets/images/dutchover.png",
					nickname: "West Texas Warrior",
					records: "13-1-0",
					fullname: "Michael dutchover",
					excerpt:
						"Lightweight Michael Dutchover is a top-flight prospect from Midland, Texas who signed with Thompson Boxing Promotions and Banner Promotions in October 2016....",
					read_more: {
						text: "Read More",
						link: "/fighter.html",
					},
				},
				{
					img: "./assets/images/ruben_torres.png",
					nickname: "Ace",
					records: "12-0-0",
					fullname: "Ruben torres",
					excerpt:
						"Ruben Torres is a 22-year old Mexican American professional boxer, born in Santa Monica, CA, to parents Rosie (mother) and Louie Torres (father).  He is the youngest of three siblings, older....",
					read_more: {
						text: "Read More",
						link: "/fighter.html",
					},
				},
				{
					img: "./assets/images/arnold_dinong.png",
					nickname: "Hawaiian Pitbull",
					records: "6-0-0",
					fullname: "Arnold Dinong",
					excerpt:
						"Arnold Dinong is a 26-year old Filipino American professional boxer, born in Honolulu, HI, to parents Arlene (mother) and Arnold (father). He is the oldest of four siblings, younger sister....",
					read_more: {
						text: "Read More",
						link: "/fighter.html",
					},
				},
			],
		},
		instagram: {
			// header: "NEVER MISS THE ACTION,<br>NEVER MISS A ROUND",
			header: "Follow us",
			social: [
				{
					icon: '<i class="fab fa-facebook-f"></i>',
					alt: "Facebook",
					link: "https://www.facebook.com/thompsonboxing/",
				},
				{
					icon: '<i class="fab fa-instagram"></i>',
					alt: "Instagram",
					link: "https://www.instagram.com/thompsonboxing/",
				},
				{
					icon: '<i class="fab fa-twitter"></i>',
					alt: "Twitter",
					link: "https://twitter.com/thompsonboxing",
				},
				{
					icon: '<i class="fab fa-youtube"></i>',
					alt: "Youtube",
					link: "https://www.youtube.com/channel/UCg_u52-QbmfxyCJPc-v5htg",
				},
			],
			instaFeeds: [
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
					video: true,
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
					video: true,
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
				},
				{
					img:
						"./assets/images/115777622_644885629567139_8905239365958709846_n.jpg",
					link: "https://www.instagram.com/",
					video: true,
				},
			],
		},
		subscribe: {
			header: "WE ELEVATE THE SPORT OF BOXING",
			text:
				"Be the first to know about our new calendar of events, sign up now!",
		},
		isFrontPage: true,
	},
	single: {
		social_share: {
			title: "SHARE",
			socials: [
				{
					title: "Share on Facebook",
					id: "tbp-facebook",
					icon: "./assets/images/icon/facebook.png",
				},
				{
					title: "Share on Twitter",
					id: "tbp-twitter",
					icon: "./assets/images/icon/twitter.png",
				},
				{
					title: "Share Email",
					id: "tbp-email",
					icon: "./assets/images/icon/mail.png",
				},
				{
					title: "Copy To Clipboard",
					id: "tbp-link",
					icon: "./assets/images/icon/link.png",
				},
			],
		},
		author: {
			name: "Thompson Boxing Promotions",
			image: "./assets/images/author.svg",
		},
		post_date: "Jun 11, 2020",
		post_title: "Emanuel Navarrete Vs. Uriel Lopez Next Saturday On June 20",
		post_url: "https://www.thompsonboxing.com/news/emanuel-navarrete/",
		post_slug: "emanuel-navarrete",
		featured_img: "./assets/images/single-header.jpg",
		content_img: "./assets/images/single-banner.jpg",
		p_text1:
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eleifend dolor eu ligula dictum maximus. Nunc sit amet fermentum velit, ut imperdiet tellus. Etiam posuere porttitor eros, id pellentesque risus euismod auctor. Duis posuere, neque at efficitur facilisis, tortor metus consequat dui, vel sagittis nisi erat nec lectus. Nullam risus neque, interdum dignissim ipsum eu, dignissim sagittis mi. Mauris non magna tristique, sodales justo sit amet, sodales turpis. Vivamus ut finibus felis. Nunc non finibus risus, in posuere magna. Aenean euismod est eros, id maximus metus blandit placerat. Integer placerat pretium ultrices. Aliquam erat volutpat. Suspendisse cursus gravida dolor sed condimentum. Ut efficitur metus eu lacus tincidunt ultrices. Quisque pulvinar, magna a scelerisque varius, urna neque lobortis nisl, quis sodales tellus nulla ac urna. Donec mauris purus, sagittis ut eleifend vitae, egestas sit amet augue. Integer risus metus, dictum ut felis at, rhoncus commodo urna. Nam nibh massa, ullamcorper nec libero vel, facilisis porta ante. Nam eget dapibus lacus. Praesent egestas massa felis, vitae vehicula turpis molestie in. In molestie egestas leo ut porttitor. Praesent imperdiet ipsum et pellentesque lacinia. Aliquam sit amet auctor velit. Curabitur vulputate at odio vel fringilla. Morbi id luctus erat. Nulla lacus turpis, aliquet vitae vehicula in, venenatis id ante. Donec nec leo felis. Sed arcu nisl, commodo at varius quis, tristique tincidunt nisi.",
		p_text2:
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eleifend dolor eu ligula dictum maximus. Nunc sit amet fermentum velit, ut imperdiet tellus. Etiam posuere porttitor eros, id pellentesque risus euismod auctor. Duis posuere, neque at efficitur facilisis, tortor metus consequat dui, vel sagittis nisi erat nec lectus. Nullam risus neque, interdum dignissim ipsum eu, dignissim sagittis mi. Mauris non magna tristique, sodales justo sit amet, sodales turpis. Vivamus ut finibus felis. Nunc non finibus risus, in posuere magna. Aenean euismod est eros, id maximus metus blandit placerat. Integer placerat pretium ultrices. Aliquam erat volutpat. Suspendisse cursus gravida dolor sed condimentum. Ut efficitur metus eu lacus tincidunt ultrices. Quisque pulvinar, magna a scelerisque varius, urna neque lobortis nisl, quis sodales tellus nulla ac urna. Donec mauris purus, sagittis ut eleifend vitae, egestas sit amet augue. Integer risus metus, dictum ut felis at, rhoncus commodo urna. Nam nibh massa, ullamcorper nec libero vel, facilisis porta ante. Nam eget dapibus lacus. Praesent egestas massa felis, vitae vehicula turpis molestie in. In molestie egestas leo ut porttitor. Praesent imperdiet ipsum et pellentesque lacinia. Aliquam sit amet auctor velit. Curabitur vulputate at odio vel fringilla. Morbi id luctus erat. Nulla lacus turpis, aliquet vitae vehicula in, venenatis id ante. Donec nec leo felis. Sed arcu nisl, commodo at varius quis, tristique tincidunt nisi.",
		p_text3:
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eleifend dolor eu ligula dictum maximus. Nunc sit amet fermentum velit, ut imperdiet tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eleifend dolor eu ligula dictum maximus. Nunc sit amet fermentum velit, ut imperdiet tellus.",
		post_gallery: [
			{
				thumb: "./assets/images/gallery1.png",
				img: "./assets/images/gallery1.png",
			},
			{
				thumb: "./assets/images/gallery2.png",
				img: "./assets/images/gallery2.png",
			},
			{
				thumb: "./assets/images/gallery3.png",
				img: "./assets/images/gallery3.png",
			},
			{
				thumb: "./assets/images/gallery4.png",
				img: "./assets/images/gallery4.png",
			},
			{
				thumb: "./assets/images/gallery5.png",
				img: "./assets/images/gallery5.png",
			},
		],
		subscribe: {
			header: "WE ELEVATE THE SPORT OF BOXING",
			text:
				"Be the first to know about our new calendar of events, sign up now!",
		},
		related: {
			header: "You May Like",
			limit: 3,
			posts: [
				{
					link: "/single.html",
					img: "./assets/images/gallery1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum ut consectetur eu...",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery2.png",
					slogan: "3, 2, 1 Boxing",
					title: "Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery3.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum ut consectetur eu...",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery5.png",
					slogan: "3, 2, 1 Boxing",
					title: "Incididunt velit magna ullamco aliquip. Esse ipsum est",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/gallery4.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
				{
					link: "/single.html",
					img: "./assets/images/news-1.png",
					slogan: "3, 2, 1 Boxing",
					title:
						"Incididunt velit magna ullamco aliquip. Esse ipsum est consequat officia ipsum",
					date: "1 day ago",
				},
			],
		},
		isFrontPage: false,
	},
	single_fighter: {
		social_share: {
			title: "SHARE",
			socials: [
				{
					title: "Share on Facebook",
					id: "tbp-facebook",
					icon: "./assets/images/icon/facebook.png",
				},
				{
					title: "Share on Twitter",
					id: "tbp-twitter",
					icon: "./assets/images/icon/twitter.png",
				},
				{
					title: "Share Email",
					id: "tbp-email",
					icon: "./assets/images/icon/mail.png",
				},
				{
					title: "Copy To Clipboard",
					id: "tbp-link",
					icon: "./assets/images/icon/link.png",
				},
			],
		},
		header_img_xs: "./assets/images/fighter_header_xs.png",
		header_img_md: "./assets/images/fighter_header_md.png",
		nickname: "West Texas Warrior",
		title: "Michael Dutchover",
		fighter_slug: "michael-dutchover",
		fighter_url: "https://www.thompsonboxing.com/fighter/michael-dutchover/",
		records: "27 - 2 - 1",
		country: {
			name: "USA",
			flag: "./assets/images/flags/usa.png",
		},
		state: "Midland, Texas",
		birtday: "Nov 15, 1997",
		current_residence: "Santa Fe Springs, CA",
		height: "5’7 1/2",
		weight: "135 (Lightweight)",
		amateur_record: "130-17",
		pro_record: "13-1, 10 KO’s",
		content: [
			{
				text:
					"Lightweight Michael Dutchover is a top-flight prospect from Midland, Texas who signed with Thompson Boxing Promotions and Banner Promotions in October 2016.  The Texas native won numerous regional tournaments as an amateur and was a runner up at the 2016 National Golden Gloves competition in the 132-pound division.  He enters the professional ranks well prepared having gone 130-17 in the unpaid arena.",
			},
			{
				text:
					"“I felt an overwhelming amount of joy when I was signing my contract,” said Dutchover, who is managed and trained by Danny Zamora. “I’ve been doing this since I was eight years old. This is just the beginning.  I’m going to work hard to become a world champion. That’s all I want.”",
			},
			{
				text:
					"We are very pleased with the addition of Michael Dutchover,” said Ken Thompson, president at Thompson Boxing. “Michael brings a dynamic fighting style to the ring. It’s going to be exciting watching his career take off.”",
			},
			{
				text:
					"Dutchover turned professional on a Thompson Boxing card, Friday, Oct. 21, 2016. Dutchover started his career with a third-round knockout over Cesar Partida.  He worked off an effective jab that allowed him to land crisp power shots. In the third, he connected on a crushing combination that resulted in the fight’s only knockdown. Partida survived the round but was not allowed to come out for the fourth and final round.  In his next bout which took place at the Double Tree hotel on November 11, 2016, Dutchover scored a first round knockout, closing out the year with a bang.  This was a great start to Michael’s career as he entered 2017 with a record of 2-0, 2 KOs.",
			},
			{
				text:
					"On February 10, 2017, Dutchover returned to the ring, scoring another first round knockout over Jose Mora.  He followed that win with four more consecutive victories, defeating Eder Amaro Fajardo, Miguel Carrizoza, Carlos Flores and Anthony Sanchez, with two of those bouts taking place on the east coast.  He would go the distance for the first time in his career, winning a six round unanimous decision against Carrizoza.  His record now being 7-0, 5 KOs as he entered 2018.",
			},
			{
				text:
					"In 2018, Dutchover fought Ricardo Lopez Torres, Mike Fowler, Sergio Ramirez Martinez, Bergman Aguilar, and Ruben Tamayo, winning all five bouts, four by knockout, to remain undefeated.  His record would now stand at 12-0, 9 KOs.",
			},
			{
				text:
					"On May 10, 2019, Dutchover scored a first round knockout against, Rosekie Cristobal, a bout that took place at the Omega Products International event center in Corona, CA.  In his next fight, Ductchover would make his televised debut against Thomas Mattice, fighting on Showtime’s prospect series, ShoBox: The Next Generation.  In this bout, Dutchover would suffer his first career loss which ended controversially due to the doctor stopping the action in round eight due to a bad cut, bringing his current record to 13-1, 10 KOs.",
			},
			{
				text:
					"Dutchover, now 22, relocated to Santa Fe Springs, Calif., two years ago to take advantage of the Los Angeles area sparring.  “The sparring in Los Angeles is exceptional,” said Dutchover. “I’ve had an opportunity to mix it up with Petr Petrov and Ruben Villa. I see so many different styles that I think it’s going to speed my development.”",
			},
			{
				text:
					"Dutchover’s most emphatic win came during his first headlining event on July 20, 2018. Dutchover captivated a sold-out crowd with an electrifying one-punch knockout of Sergio Ramirez from the Doubletree Hotel in Ontario, Calif.  The close out punch, a right hand on Ramirez’s chin, occurred at the :43 mark of the second round. ",
			},
			{
				text:
					"“I timed it just right,” said the 20-year-old Dutchover. “He came at me with a lazy punch and I just unloaded that right hand and he dropped like a fly.”",
			},
			{
				text:
					"“You go into every fight expecting a tough challenge,” Dutchover said. “I was ready to go the full eight rounds, but I’m glad I was able to end it early and give the fans something to talk about.”",
			},
			{
				text: "Dutchover was born on Nov. 15, 1997.",
			},
		],
		gallery: [
			{
				img:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-1.png",
				thumb:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-1.jpg",
				alt: "Dutchover 1",
			},
			{
				img:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-2.png",
				thumb:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-2.jpg",
				alt: "Dutchover 2",
			},
			{
				img:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-3.png",
				thumb:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-3.jpg",
				alt: "Dutchover 3",
			},
			{
				img:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-4.png",
				thumb:
					"./assets/images/fighter_gallery/tbp_inplayer_image_post-dutchover-4.jpg",
				alt: "Dutchover 4",
			},
		],
		highlights: {
			header: "Amateur highlights:",
			items: [
				{
					icon: "./assets/images/highlight.svg",
					title: "Won 9 National amateur tournaments:",
					text: "Silver Gloves, Junior Golden Gloves, PAL Nationals",
					size: "col-xl-4",
				},
				{
					icon: "./assets/images/highlight.svg",
					title: "",
					text: "Bronze medal at U.S. Olympic Trials in 2015",
					size: "col-xl-3",
				},
				{
					icon: "./assets/images/highlight.svg",
					title: "",
					text: "Runner up at National Golden Gloves 2016 at 132 lbs.",
					size: "col-xl-3",
				},
				{
					icon: "./assets/images/highlight.svg",
					title: "First amateur fight:",
					text: "8 years old at 55 lbs.",
					size: "col-xl-2",
				},
			],
		},
		sparring_partners: {
			header: "Notable sparring partners:",
			items: [
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Danny Roman",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Oscar Valdez",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Jessie Magdaleno",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Darleys Perez",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Petr Petrov",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Ruben Torres",
				},
				{
					img: "./assets/images/sparring_partners/author.svg",
					name: "Michael Conlan",
				},
			],
		},
		high_school: {
			header: "High School:",
			items: [
				{
					text:
						"Graduate of Midland High School Bulldogs (one of the top cross country schools in the country; routinely ranked in the Top 20 nationwide).",
				},
				{
					text: "Ran Cross Country: his 3-mile time was 16:10.",
				},
				{
					text: "Ran Track n’ Field; Ran the 800m: 2:05 and the 400m :53.",
				},
				{
					text: "One of his goals in the future is to run a marathon",
				},
				{
					text:
						"Was first introduced to the Los Angeles boxing scene the summer before his senior year of high school. He sparred with Darleys Perez, who was the WBA lightweight champion at the time (Perez was getting ready for England’s Anthony Crolla), and he knew he wanted to conduct training camps in L.A . once he turned professionally one year later.",
				},
			],
		},
		more_fighters: {
			title: "Here Are More Fighters You May Like",
			fighters: [
				{
					name: "Ruben Torres",
					img: "./assets/images/fighter.png",
				},
				{
					name: "Arnold Dinong",
					img: "./assets/images/fighter.png",
				},
				{
					name: "Arnold Dinong",
					img: "./assets/images/fighter.png",
				},
				{
					name: "Arnold Dinong",
					img: "./assets/images/fighter.png",
				},
				{
					name: "Arnold Dinong",
					img: "./assets/images/fighter.png",
				},
			],
		},
	},
	faqs: {
		isFaqsPage: true,
	},
	policy: {
		post_title: "Privacy Policy",
		post_url: "https://www.thompsonboxing.com/privacy-policy/",
		post_slug: "privacy-policy",
		content: [
			{ prefix: "tbp", type: 'headline', title: 'Privacy Policy' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida duis amet magna suscipit neque. Sit vel sed in faucibus nunc sit convallis sit. Consequat, elit id tellus justo diam, egestas blandit. Amet, nisi, elementum porttitor ipsum est ullamcorper est in ut. Lacus molestie felis quam diam bibendum. Vivamus cras sem ut sodales diam. Vulputate pretium nunc, fusce urna. Neque id in neque interdum et convallis volutpat.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Diam dictumst aliquet vitae vitae eget tempor facilisis. Sagittis enim sodales ac mattis ut mauris, magna nunc, phasellus. Dapibus tristique hac nunc, arcu. Congue ligula habitant amet, mauris volutpat morbi sapien pharetra. Nec ac id sem quis augue turpis rhoncus. Augue libero, amet tincidunt vitae pulvinar a.<br> Varius fringilla sit faucibus venenatis sit massa mattis. Tellus neque vestibulum sit sed habitasse augue nec, in vitae. Odio et ornare purus tellus lectus id neque. Quis et pellentesque sed faucibus accumsan ipsum ac hac id. Pellentesque elit vel id odio. Risus eget quis nibh condimentum aenean ornare sed tortor. Facilisis est ultricies cursus pellentesque arcu faucibus cursus eget. Morbi feugiat ac mauris fermentum aliquam. Felis lacinia purus posuere nam mattis lorem et rhoncus. Molestie sagittis cursus egestas eget magna. Cursus at diam aliquam mattis amet, eget mauris, aenean.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Netus phasellus sit leo tortor velit nulla. Nam eu egestas ultrices a et ut. Arcu in tellus id magna. Phasellus dignissim massa sit in fermentum et vestibulum. Dignissim est scelerisque at facilisi ipsum. A eget dui consequat adipiscing fusce lectus nunc congue. Et faucibus aliquam interdum id vel massa tellus. Netus magna suspendisse tincidunt egestas est nisl eu lorem.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Commodo elit tellus tincidunt risus tristique viverra dignissim. Odio arcu adipiscing leo maecenas vulputate risus justo. Est enim sit ante est feugiat nam nunc sem vel. Nunc orci tincidunt pharetra neque nibh lacus fames pellentesque. Porttitor tortor amet, malesuada malesuada eget vestibulum odio ultrices aliquet. Nisl sit at elementum cursus sed rhoncus maecenas mattis. Bibendum arcu eget rutrum diam convallis dictumst nunc, feugiat consequat. Non id massa facilisi nunc sodales egestas blandit pellentesque. Maecenas mauris, et diam eu pellentesque. In aliquam praesent donec purus. Eget ut ac quam leo mi ullamcorper.`</p>' },
			{ prefix: "tbp", type: 'headline', title: 'Cookies Policy' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida duis amet magna suscipit neque. Sit vel sed in faucibus nunc sit convallis sit. Consequat, elit id tellus justo diam, egestas blandit. Amet, nisi, elementum porttitor ipsum est ullamcorper est in ut. Lacus molestie felis quam diam bibendum. Vivamus cras sem ut sodales diam. Vulputate pretium nunc, fusce urna. Neque id in neque interdum et convallis volutpat.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Magnis id eu cras porttitor. Quis volutpat varius pharetra, et mi. Mattis lacinia pulvinar et sed lacus turpis eget diam. Cursus donec sed sollicitudin laoreet ipsum rhoncus. Eget sem curabitur fusce dolor, hac arcu turpis in. Eget massa in magna posuere. Cras pulvinar scelerisque dui, ultricies sociis. Tristique pellentesque nulla enim magna at sed neque ornare. Nibh felis amet, sed non massa nunc, nibh sed morbi. Dignissim id lacus, at aliquam aliquet blandit nulla nisl aliquam. At quis dictum a, in. Amet, mattis amet, volutpat condimentum. Sed purus vestibulum augue sit augue quis a.</p>' },
			{ prefix: "tbp", type: 'list-block', list: '<ul><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> </ul>' },
			{ prefix: "tbp", type: 'headline', title: 'Terms and Conditions' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida duis amet magna suscipit neque. Sit vel sed in faucibus nunc sit convallis sit. Consequat, elit id tellus justo diam, egestas blandit. Amet, nisi, elementum porttitor ipsum est ullamcorper est in ut. Lacus molestie felis quam diam bibendum. Vivamus cras sem ut sodales diam. Vulputate pretium nunc, fusce urna. Neque id in neque interdum et convallis volutpat.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Magnis id eu cras porttitor. Quis volutpat varius pharetra, et mi. Mattis lacinia pulvinar et sed lacus turpis eget diam. Cursus donec sed sollicitudin laoreet ipsum rhoncus. Eget sem curabitur fusce dolor, hac arcu turpis in. Eget massa in magna posuere. Cras pulvinar scelerisque dui, ultricies sociis. Tristique pellentesque nulla enim magna at sed neque ornare. Nibh felis amet, sed non massa nunc, nibh sed morbi. Dignissim id lacus, at aliquam aliquet blandit nulla nisl aliquam. At quis dictum a, in. Amet, mattis amet, volutpat condimentum. Sed purus vestibulum augue sit augue quis a.</p>' },
			{ prefix: "tbp", type: 'list-block', list: '<ol><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus cursus facilisi egestas a pellentesque urna facilisi consectetur adipiscing elit.</li> </ol>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Dictum ullamcorper vel sagittis vel sed. Sed eros, quis duis sed laoreet amet interdum magna. Feugiat risus netus ut euismod nisl at vitae ullamcorper. Facilisis orci, imperdiet mus ultrices sapien. Sagittis congue aliquam netus vestibulum turpis quis nascetur neque. Augue tellus est at massa eget viverra adipiscing ultricies.</p>' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Condimentum integer nulla eu nulla elementum adipiscing cursus sit purus. Non eleifend tempor facilisis fusce hendrerit commodo erat in imperdiet. Ante imperdiet aliquam duis nunc, nascetur condimentum ac amet. Tristique lobortis porta elementum purus, mollis ut pharetra. Ultrices pretium, quam luctus gravida aliquam pharetra, semper nisl. Vitae scelerisque lacus id gravida dictum eget morbi sollicitudin leo. Ultrices in iaculis et mi amet lectus adipiscing. Erat pellentesque amet vitae sed aliquam quis at vitae. Sit augue in amet volutpat commodo vitae dignissim turpis. Mauris id commodo blandit pulvinar tempor risus dui posuere eget. Blandit cras viverra pharetra tellus enim est cursus magna. Metus, diam non at et tempor nullam massa urna.</p>' },
			{ prefix: "tbp", type: 'headline', title: 'Contact details' },
			{ prefix: "tbp", type: 'paragraf', content: '<p>Head Office:<br> Dictum ullamcorper vel sagittis vel sed.<br> Sed eros, quis duis sed laoreet amet interdum magna. Feugiat</p> <p>Telephone: 01234 5678 9<br> Email: INFO@TBP.COM</p> <p>Latest update: 8th November 2018</p>'}
		]
	},
};

module.exports = globalContent;
