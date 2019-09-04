$(document).ready(function (){

   $("#auto_search_button").click(function(){
      $( "#search" ).slideToggle( "slow", function() {
      });        
    });
    $('.sub-icon').click(function () {
        if ($(this).next('ul').css('display') == 'none') {
            $(this).html('-');
        } else {
            $(this).html('+');
        };              
        $(this).next('ul').slideToggle( "slow", function() {});        
    });

    $('.sub-icon2').click(function () {
        if ($(this).next('ul').css('display') == 'none') {
            $(this).html('-');
        } else {
            $(this).html('+');
        };              
        $(this).next('ul').slideToggle( "slow", function() {});
    });
 

    $('.category_new').find('h3').click(function () {
        if ($(this).next('.level2').css('display') == 'none') {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        };              
        $(this).next('.level2').slideToggle( "slow", function() {});        
    });  
  
    $(".list_baihoc ").find("thead").click(function(){
        $(this).siblings('thead').removeClass('active');
        $('tbody').css('display', 'none');
        if(!$(this).hasClass("active")){
            $(this).addClass("active");
            $(this).next('tbody').css('display', 'contents');
        }
        else{
            $(this).removeClass("active");
        }      
    });           

    /*SLIDE TOP HOME*/
    var owl_slide_top_home = $('.slide_top_home .owl-carousel, #top_banner .owl-carousel');
        owl_slide_top_home.owlCarousel({
            loop: true,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 6000,
            items: 1,
            pagination : false,
        })

    /*END SLIDE TOP HOME*/

    var owl_slide_book = $('.slide_book .owl-carousel');
        owl_slide_book.owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 6000,
            items: 1,
            pagination : false,
        })

  

    /*SLIDE LEARN*/
    var owl_list_learn = $('.list_learn .owl-carousel ,.bai_test_khac .owl-carousel');
        owl_list_learn.owlCarousel({
            loop: true,
            autoplay: false,
            margin:20,
            autoplayTimeout: 6000,
            items: 3,
            nav:false,
            responsive: {
                0: {
                        items: 1,
                        margin: 10
                },
                590: {
                        items: 2,
                        margin: 20
                },                
                1200: {
                    items:3
                },                  
            }             
        })

    /*END SLIDE LEARN*/  

    /*SLIDE EXPERT*/
    var owl_slide_expert = $('.slide_expert .owl-carousel');
        owl_slide_expert.owlCarousel({
            loop: true,
            autoplay: false,
            margin:30,
            autoplayTimeout: 6000,
            items: 5,
            nav:true,
            responsive: {
                0: {
                        items: 2,
                        margin: 10
                },
                590: {
                        items: 3,
                        margin: 20
                },
                1000: {
                    items: 4,
                    margin: 20
                },                
                1200: {
                    items:5
                },                  
            }             
        })

    /*END SLIDE EXPERT*/  

/**  DropDown */    

    function DropDown(el) {
                this.dd = el;
                this.placeholder = this.dd.children('span');
                this.opts = this.dd.find('ul.dropdown > li');
                this.val = '';
                this.index = -1;
                this.initEvents();
            }
            DropDown.prototype = {
                initEvents : function() {
                    var obj = this;

                    obj.dd.on('click', function(event){
                        $(this).toggleClass('active');
                        return false;
                    });

                    obj.opts.on('click',function(){
                        var opt = $(this);
                        obj.val = opt.text();
                        obj.index = opt.index();
                        obj.placeholder.text(obj.val);
                    });
                },
                getValue : function() {
                    return this.val;
                },
                getIndex : function() {
                    return this.index;
                }
            }

            $(function() {

                var dd = new DropDown( $('#dd') );

                $(document).click(function() {
                    // all dropdowns
                    $('.wrapper-dropdown-3').removeClass('active');
                });

            });      
      
    
    /**MENU STICKY**/
    $(window).scroll(function() {
      if($(window).scrollTop() >= 610)
      {
        $('#header_sticky').addClass('show_sticky');
          
      }
      else
      {
        $('#header_sticky').removeClass('show_sticky');
      }
    });
    /**END MENU STICKY**/

    /*OPEN & CLOSE MAIN MENU*/
    $(function(){
        $('.btn_control_menu').click(function(){
        $('body').addClass('show_main_menu');
        });

            $('.close_main_menu, .mask-content').click(function(){
            $('body').removeClass('show_main_menu');
        });
    })
    /*END OPEN & CLOSE MAIN MENU*/

	/**BUTTON BACK TO TOP**/
	$(window).scroll(function() {
	  if($(window).scrollTop() >= 200)
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


    $('.block_search .input_form').click(function(){
        $('.block_search').addClass('focus');
    });
     $('.block_search .btn_reset').click(function(){
        $('.block_search').removeClass('focus');
    }); 

    $(".fillter-test").find(".on").click(function(){
        $(this).siblings('.on').removeClass('active');
        if(!$(this).hasClass("active")){
            $(this).addClass("active");
            $("body").addClass("open");
        }
        else{
            $(this).removeClass("active");
            $("body").removeClass("open");
        }      
    });           
});

// ---------------------------------
// Start notification
//desktop từ 861px trở lên
function showNotification() {
    var element = $('.notifications');
    element.toggleClass("open");
 }

//mobile từ 860px trở xuống
function showNotificationMobile() {
    document.querySelector('.notifications-mobile').classList.toggle('open');
    document.querySelector('.user-menu').classList.remove('open');
}
// End notification


//Start user menu
function showUserMenu() {
    document.querySelector('.user-menu').classList.toggle('open');
    document.querySelector('.notifications-mobile').classList.remove('open');
}
//End user menu


//start dropdown comment option
function showDropdownCommentOption() {
    document.querySelector('.dropdown-comment-option').classList.toggle('open');
}
//end dropdown comment option

// function showButtonMore() {
//     document.querySelector('.hover-button-more').style.display = "flex";
// }

// function hideButtonMore() {
//     document.querySelector('.hover-button-more').style.display = "none";
//     document.querySelector('.dropdown-comment-option').classList.remove('open');
// }