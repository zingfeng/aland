jQuery(document).ready(function($) {
	routeTraining();


	
	/**BUTTON BACK TO TOP**/
	$(window).scroll(function() {
		if($(window).scrollTop() >= 500)
		{
			$('#to_top').fadeIn();
		}
		else
		{
			$('#to_top').fadeOut();
		}
	});

	$("#to_top,.on_top").click(function() {
		$("html, body").animate({ scrollTop: 0 });
		return false;
	});
	/**END BUTTON BACK TO TOP**/
});

// section route-training
function routeTraining(){
	// level-1
	$('.route-training .panel-body .content-level-1').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
	});

	$('.route-training .panel-body .content-level-1').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
	});

	// level-2
	$('.route-training .panel-body .content-level-2').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).addClass( "icon-pink dot-pink line-pink" );
	});

	$('.route-training .panel-body .content-level-2').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).removeClass( "icon-pink dot-pink line-pink" );
	});

	// level-3
	$('.route-training .panel-body .content-level-3').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).addClass( "icon-pink dot-pink line-pink" ).delay( 800 );
		$( ".list-icon.level-3" ).addClass( "icon-pink dot-pink line-pink" ).delay( 800 );
	});

	$('.route-training .panel-body .content-level-3').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).removeClass( "icon-pink dot-pink line-pink" );
	});
	
	// level-4
	$('.route-training .panel-body .content-level-4').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).addClass( "icon-pink dot-pink line-pink" );
	});

	$('.route-training .panel-body .content-level-4').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).removeClass( "icon-pink dot-pink line-pink" );
	});
	
	// level-5
	$('.route-training .panel-body .content-level-5').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-5" ).addClass( "icon-pink dot-pink line-pink" );
	});

	$('.route-training .panel-body .content-level-5').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-5" ).removeClass( "icon-pink dot-pink line-pink" );
	});
	
	// level-6
	$('.route-training .panel-body .content-level-6').mouseenter(function(){
		$( ".list-icon.level-1" ).addClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-5" ).addClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-6" ).addClass( "icon-pink dot-pink line-pink" );
	});

	$('.route-training .panel-body .content-level-6').mouseleave(function(){
		$( ".list-icon.level-1" ).removeClass( "icon-pink dot-pink" );
		$( ".list-icon.level-2" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-3" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-4" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-5" ).removeClass( "icon-pink dot-pink line-pink" );
		$( ".list-icon.level-6" ).removeClass( "icon-pink dot-pink line-pink" );
	});
}
// end section route-training

// header-mb
$(function() {
	function slideMenu() {
		var activeState = $("#menu-container .menu-list").hasClass("active");
		$("#menu-container .menu-list").animate({left: activeState ? "0%" : "-100%"}, 400);
	}

	$("#menu-wrapper").click(function(event) {
		event.stopPropagation();
		$("#hamburger-menu").toggleClass("open");
		$("#menu-container .menu-list").toggleClass("active");
		slideMenu();

		$("body").toggleClass("overflow-hidden");
	});

	$(".menu-list").find(".accordion-toggle").click(function() {
		$(this).next().toggleClass("open").slideToggle("fast");
		$(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");

		$(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
		$(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
	});
});
// end header-mb

// OWL CAROUSEL
$('.slider-top .owl-carousel').owlCarousel({
	loop: true,
	autoplay:true,
	autoplayTimeout:3000,
	autoplayHoverPause: true,
	responsiveClass: true,
	dots: true,
	nav: true,
	items: 1
})

// $('.course-online .owl-carousel').owlCarousel({
// 	loop:true,
// 	margin:20,
// 	nav:true,
// 	responsive:{
// 		0:{
// 			items:1
// 		},
// 		600:{
// 			items:3
// 		},
// 		1000:{
// 			items:4
// 		}
// 	}
// })
// 

$('.course-online .owl-carousel').owlCarousel({
	loop:true,
	margin:20,
	nav:true,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:2
		},
		768:{
			items:3
		},		
		800:{
			items:3
		},
		1024:{
			items:3
		},
		1366:{
			items:4
		}
	}
})

$('.slider .owl-carousel').owlCarousel({
	loop:true,
	margin:20,
	nav:true,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:3
		},
		1000:{
			items:4
		}
	}
})

$('.feedback .owl-carousel').owlCarousel({
	loop:true,
	margin:20,
	nav:true,
	dots: true,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:1
		},
		1000:{
			items:1
		}
	}
})

$('.partner .owl-carousel').owlCarousel({
	loop:true,
	margin:20,
	nav:false,
	dots: false,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:3
		},
		1000:{
			items:4
		}
	}
})
// END OWL CAROUSEL

// $('.aaaaa .owl-carousel').owlCarousel({
// 	loop:true,
// 	margin:20,
// 	nav:false,
// 	dots: false,
// 	responsive:{
// 		0:{
// 			items:1
// 		},
// 		600:{
// 			items:2
// 		},
// 		768:{
// 			items:3
// 		},
// 		1024:{
// 			items:4
// 		},
// 		1366:{
// 			items:5
// 		}
// 	}
// })
// 

