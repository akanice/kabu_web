$(document).ready(function() {
	$(".bt_menusb").on("click", function(e){					
		var xtarget = $(this).data("target");
		$(xtarget).addClass( "open" );
		$("body").addClass( "resmenu-open" );
		$("body").css( "overflow", "hidden" );
		 event.stopPropagation();
	});
	
	$(".menu-close").on("click", function(){
		$(this).parents( ".menu-responsive-wrapper" ).removeClass( "open" );
		$("body").removeClass( "resmenu-open" ).removeAttr( "style" );
	});	
	
	$( ".show-dropdown" ).each(function(){
		$(this).on("click", function(){
			$(this).toggleClass("show");
			var $element = $(this).parent().find( "> ul" );
			$element.toggle( 300 );
		});
	});		
	
	$("body").on("click", function(e) {			
		var container = $( ".resmenu-container" );
		if ( typeof container != "undefined" && !container.is(e.target) && container.has(e.target).length == 0 ){
			$(".menu-responsive-wrapper").removeClass( "open" );
			$("body").removeClass( "resmenu-open" ).removeAttr( "style" );
		}
	});
		
	$(".respmenu-settings").on("click", function(e){
		e.preventDefault();
		var xtarget = $(this).data("target");
		$(xtarget).toggle();
	});
	
	$('.header-style1 .header-mid .sticky-search .fa-search').on('click', function(){
		$('.header-style1 .header-mid .sticky-search').toggleClass("open");
	});
}); 

function copyClipboard() {
	var copyText = document.getElementById("share_link_input");
	copyText.select();
	document.execCommand("copy");

	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Copy to clipboard";
}

// mega menu
(function($){
	$.fn.megamenu = function(options) {
		options = jQuery.extend({
			  wrap:'.nav-mega',
			  speed: 0,
			  justify: "",
			  rtl: false,
			  mm_timeout: 0
		  }, options);
		var menuwrap = $(this);
		buildmenu(menuwrap);
		/* Build menu */
		function buildmenu(mwrap){
			mwrap.find('.revo-mega > li').each(function(){
				var menucontent 		= $(this).find(".dropdown-menu");
				var menuitemlink 		= $(this).find(".item-link:first");
				var menucontentinner 	= $(this).find(".nav-level1");
				var mshow_timer = 0;
				var mhide_timer = 0;
				var li = $(this);
				var islevel1 = (li.hasClass('level1')) ?true:false;
				var havechild = (li.hasClass('dropdown')) ?true:false;
				var menu_event = $( 'body' ).hasClass( 'menu-click' );
				if( menu_event ){
					li.on( 'click', function(){
						 positionSubMenu(li, islevel1);	
						$(this).find( '>ul').toggleClass( 'visible' );
					});
					$(document).mouseup(function (e){
							var container = li.find( '>ul');
							if (!container.is(e.target) && container.has(e.target).length === 0) {
									container.removeClass( 'visible' );
							}
					});
					li.find( '> a[data-toogle="dropdown"]' ).on( 'click', function(e){
						e.preventDefault();			
					});
					
				}else{
					li.mouseenter(function(el){
						li.find( '>ul').addClass( 'visible' );
						if(havechild){
							positionSubMenu(li, islevel1);						
						}
					}).mouseleave(function(el){ 
						li.find( '>ul').removeClass( 'visible' );				
					});
				}
			});
		}		
		
		function positionSubMenu(el, islevel1){
			menucontent 		= $(el).find(".dropdown-menu");
			menuitemlink 		= $(el).find(".item-link");
	    	menucontentinner 	= $(el).find(".nav-level1");
	    	wrap_O				= ( options.rtl == false ) ? menuwrap.offset().left : ( $(window).width() - (menuwrap.offset().left + menuwrap.outerWidth()) );
	    	wrap_W				= menuwrap.outerWidth();
	    	menuitemli_O		= ( options.rtl == false ) ? menuitemlink.parent('li').offset().left : ( $(window).width() - (menuitemlink.parent('li').offset().left + menuitemlink.parent('li').outerWidth()) );
	    	menuitemli_W		= menuitemlink.parent('li').outerWidth();
	    	menuitemlink_H		= menuitemlink.outerHeight();
	    	menuitemlink_W		= menuitemlink.outerWidth();
	    	menuitemlink_O		= ( options.rtl == false ) ? menuitemlink.offset().left : ( $(window).width() - (menuitemlink.offset().left + menuitemlink.outerWidth()) );
	    	menucontent_W		= menucontent.outerWidth();
			
			if (islevel1) { 				
				
				if(options.justify == "left"){
					var wrap_RE = wrap_O + wrap_W;

					var menucontent_RE = menuitemlink_O + menucontent_W;
					
					if( menucontent_RE >= wrap_RE ) { 
						if( options.rtl == false ){
							menucontent.css({
								'left':wrap_RE - menucontent_RE + menuitemlink_O - menuitemli_O + 'px'
							}); 
						}else{
							menucontent.css({
								'left': 'auto',
								'right':wrap_RE - menucontent_RE + menuitemlink_O - menuitemli_O + 'px'
							});
						}
					}
				} 
			}else{
				_leftsub = 0;
				menucontent.css({
					'top': menuitemlink_H*0 +"px",
					'left': menuitemlink_W + _leftsub + 'px'
				})
				
				if(options.justify == "left"){
					var wrap_RE = wrap_O + wrap_W;
					var menucontent_RE = menuitemli_O + menuitemli_W + _leftsub + menucontent_W;
											
					if( menucontent_RE >= wrap_RE ) { 
						menucontent.css({
							'left': _leftsub - menucontent_W + 'px'
						}); 
					}
				} else if( options.justify == "right" ) {
					var wrap_LE = wrap_O;
					
					var menucontent_LE = menuitemli_O - menucontent_W + _leftsub;
											
					if( menucontent_LE <= wrap_LE ) { 
						menucontent.css({
							'left': menuitemli_W - _leftsub + 'px'
						}); 
					} else {
						menucontent.css({
							'left':  - _leftsub - menucontent_W + 'px'
						}); 
					}
				}
			}
		}
	};
	
	jQuery(function($){
		var rtl = $('body').hasClass('rtl');
		$('.header-mid > .container').megamenu({ 
			wrap:'.nav-mega',
			justify: 'left',
			rtl: rtl
		});
		$('.header-bottom > .container').megamenu({ 
			wrap:'.nav-mega',
			justify: 'left',
			rtl: rtl
		});
	});
})(jQuery);

// sticky menu
(function($) {var sticky_navigation_offset = $("#header .header-bottom").offset();if( typeof sticky_navigation_offset != "undefined" ) {var sticky_navigation_offset_top = sticky_navigation_offset.top;var sticky_navigation = function(){var scroll_top = $(window).scrollTop();if (scroll_top > sticky_navigation_offset_top) {$("#header .header-mid").addClass("sticky-menu");$("#header .header-mid").css({ "top":0, "left":0, "right" : 0 });} else {$("#header .header-mid").removeClass("sticky-menu");}};sticky_navigation();$(window).scroll(function() {sticky_navigation();}); }}(jQuery));