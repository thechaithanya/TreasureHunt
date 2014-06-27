$(document).ready(function() {
$('.blockuserinfo a').on('click touchend', function(e) {
    var el = $(this);
    var link = el.attr('href');
    window.location = link;
});

});

//    breadcrumb replace
$(document).ready(function() {
	breadcrumb = $('.breadcrumb');
	$('#center_column .breadcrumb').remove();
	$('#columns').prepend(breadcrumb);
	$('.breadcrumb a').on('click touchend', function(e) {
    	var el = $(this);
    	var link = el.attr('href');
    	window.location = link;
	});
	$('#compare_shipping select, #compare_shipping input[type="text"]').addClass('form-control').parent('p').addClass('form-group');
	$('#compare_shipping_form #compare_shipping h3').wrapInner('<span></span>');
});
$(window).load(function () {
      $(function(){
      	 $(".compare .comparator, #layered_form .store_list_filter input.checkbox").uniform();
	  });  
});
$(function(){
	$('body').tooltip({
		selector: "[rel=tooltip]",
		placement: "bottom" 
	});
});
//   COOKIE AND TAB GRID-LIST
(function($) {
		$(function() {
			function createCookie(name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
			else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}
			function readCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}
	function eraseCookie(name) {
		createCookie(name,"",-1);
	}

//TAB GRID-LIST
$('ul.product_view').each(function(i) {
	var cookie = readCookie('tabCookie'+i);
	if (cookie) $(this).find('li').eq(cookie).addClass('current').siblings().removeClass('current')
		.parents('#center_column').find('#product_list').addClass('list').removeClass('grid').eq(cookie).addClass('grid').removeClass('list');
	})
	$('ul.product_view').delegate('li:not(.current)', 'click', function(i) {
	$(this).addClass('current').siblings().removeClass('current')
	.parents('#center_column').find('#product_list').removeClass('grid').addClass('list').eq($(this).index()).addClass('grid').removeClass('list')
	var cookie = readCookie('tabCookie'+i);
	if (cookie) $(this).find('#product_list').eq(cookie).removeClass('grid').addClass('list').siblings().removeClass('list')
	var ulIndex = $('ul.product_view').index($(this).parents('ul.product_view'));
	eraseCookie('tabCookie'+ulIndex);
	createCookie('tabCookie'+ulIndex, $(this).index(), 365);
	})
	})
})(jQuery)
//   PRODUCT CLOUD ZOOM DISABLE IMG

$(document).ready(function() {  
	$(function(){     
		$('#zoom1').parent().on('click',function(){
		 var perehod = $(this).attr("perehod");
		  if (perehod=="false") {
		   		return true;
		   } else {
			return false;
		   }
		});     
	});
});
//   OTHER SCRIPT

$(document).ready(function() {
	   $ ('#product_comments_block_tab > div').last().addClass('last');
	   $ ('#viewed-products_block_left ul li').last().addClass('last');
	   $ ('#categories_block_left ul li a').append('<span />');
	   
});
//   TOGGLE FOOTER
// footer-icons-define
		var footer_icon_plus = 'icon-plus-sign';
		var footer_icon_minus = 'icon-minus-sign';
// footer-change-script
var responsiveflagFooter = false;
function accordionFooter(status){
		if(status == 'enable'){
			$('.modules .block h4').on('click', function(){
				$(this).toggleClass('active').parent().find('.toggle_content').stop().slideToggle('medium', function(){
					if($(this).prev().hasClass('active')) {
						$(this).prev().children('i').removeClass(footer_icon_plus).addClass(footer_icon_minus);
					}
					else {
						$(this).prev().children('i').removeClass(footer_icon_minus).addClass(footer_icon_plus);	
					}
				});
			})
			$('.modules').addClass('accordion').find('.toggle_content').slideUp('fast');
		}else{
			$('.modules h4').removeClass('active').off().parent().find('.toggle_content').removeAttr('style').slideDown('fast');
			$('.modules h4 i').removeClass(footer_icon_minus).addClass(footer_icon_plus);
			$('.modules').removeClass('accordion');
		}
	}		
function toDoFooter(){
	   if ($(document).width() <= 767 && responsiveflagFooter == false){
		    accordionFooter('enable');
			responsiveflagFooter = true;		
		}
		else if ($(document).width() >= 768){
			accordionFooter('disable');
	        responsiveflagFooter = false;
		}
}
$(document).ready(toDoFooter);
$(window).resize(toDoFooter);

//   TOGGLE PAGE PRODUCT (TAB)
// products-icons-define
		var product_icon_plus = 'icon-plus-sign-alt';
		var product_icon_minus = 'icon-minus-sign-alt';
var responsiveflagPage = false;
function accordionPage(status){	
		if(status == 'enable'){
			$('.page_product_box h3').on('click', function(){
				$(this).toggleClass('activeTab').parent().find('.toggle_content').stop().slideToggle('medium', function(){
				  if($(this).prev().hasClass('activeTab')) {
					  $(this).prev().children('i').removeClass(product_icon_minus).addClass(product_icon_plus);
				  }
				  else {
					  $(this).prev().children('i').removeClass(product_icon_plus).addClass(product_icon_minus);	
				  }
			  });
			})
			$('#center_column .page_product_box').addClass('accordion').find('.toggle_content').slideDown('fast');
		}else{
			$('#center_column .page_product_box h3').removeClass('activeTab').off().parent().find('.toggle_content').removeAttr('style').slideDown('fast');
			$('.page_product_box h3 i').removeClass(product_icon_plus).addClass(product_icon_minus);
			$('#center_column .page_product_box').removeClass('accordion');
		}
	}		
function toDoPage(){
	   if ($(document).width() <= 767 && responsiveflagPage == false){
		    accordionPage('enable');
			responsiveflagPage = true;
				
		}
		else if ($(document).width() >= 768){
			accordionPage('disable');
	        responsiveflagPage = false;
		}
}
$(document).ready(toDoPage);
$(window).resize(toDoPage);

//   TOGGLE COLUMNS
// columns-icons-define
		var columns_icon_plus = 'icon-plus-sign';
		var columns_icon_minus = 'icon-minus-sign';
// columns-change-script
var responsiveflag = false;
function accordion(status){
		leftColumnBlocks = $('#left_column');
		if(status == 'enable'){
			$('#left_column').remove();
			$(leftColumnBlocks).insertAfter('#center_column').find('#categories_block_left ul.toggle_content').slideToggle('fast');
			$('#right_column h4, #left_column h4').on('click', function(){
			$(this).toggleClass('active').parent().find('.toggle_content').stop().slideToggle('medium', function(){
					  if($(this).prev().hasClass('active')) {
						  $(this).prev().children('i').removeClass(columns_icon_plus).addClass(columns_icon_minus);
					  }
					  else {
						  $(this).prev().children('i').removeClass(columns_icon_minus).addClass(columns_icon_plus);	
					  }
				  });
			})
			$('#right_column, #left_column').addClass('accordion').find('.toggle_content').slideUp('fast');
		}else{
			$('#left_column').remove();
			$(leftColumnBlocks).insertBefore('#center_column');
			$('#right_column h4, #left_column h4').removeClass('active').off().parent().find('.toggle_content').removeAttr('style').slideDown('fast');
			$('#right_column h4 i, #left_column h4 i').removeClass(columns_icon_minus).addClass(columns_icon_plus);
			$('#left_column, #right_column').removeClass('accordion');
		}
	}		
function toDo(){
	   if ($(document).width() <= 767 && responsiveflag == false){
		    accordion('enable');
			responsiveflag = true;
			if (typeof(categoryReload) != "undefined") { 
				categoryReload()
			}
		}
		else if ($(document).width() >= 768){
			accordion('disable');
	        responsiveflag = false;
			if (typeof(categoryReload) != "undefined") { 
				categoryReload()
			}
		}
}
$(document).ready(toDo);
$(window).resize(toDo);
/*********************************************************** top menu dropdown **********************************/
$(document).ready(function(){ 
	$('.header-button').on('click touchstart', function(){
		
		var subUl = $(this).find('ul');
		var anyAther = $('#header').find('#cart_block');
		var anyAnother1 = $('#menu-wrap.mobile #menu-custom'); // close other menus if opened
		if (anyAther.is(':visible')) {
			anyAther.slideUp(),
			$('#header_user').removeClass('close-cart')
		}
		if (anyAnother1.is(':visible')) {
			anyAnother1.slideUp(),
			$('.mobile #menu-trigger').find('i').removeClass('icon-minus-sign-alt').addClass('icon-plus-sign-alt');
		} // close ather menus if opened
		if(subUl.is(':hidden')) {
			subUl.slideDown(),
			$(this).find('.icon_wrapp').addClass('active')	
		}
		else {
			subUl.slideUp(),
			$(this).find('.icon_wrapp').removeClass('active')
		}
		$('.header-button').not(this).find('ul').slideUp(),
		$('.header-button').not(this).find('.icon_wrapp').removeClass('active');
		return false
	});
	/*********************************************************** header-cart menu dropdown **********************************/
	if( (typeof ajaxcart_allowed !== "undefined") && ajaxcart_allowed==1) {
	$('#header_user').on('click touchstart', function(){
		var cartContent = $('#header').find('#cart_block');
		var anyAnother = $('.header-button').find('ul'); // close other menus if opened
		var anyAnother1 = $('#menu-wrap.mobile #menu-custom'); // close other menus if opened
		if (anyAnother.is(':visible')) {
			anyAnother.slideUp();
			$('.header-button').find('.icon_wrapp').removeClass('active')
		}
		if (anyAnother1.is(':visible')) {
			anyAnother1.slideUp(),
			$('.mobile #menu-trigger').find('i').removeClass('icon-minus-sign-alt').addClass('icon-plus-sign-alt');
		}
		if (cartContent.is(':hidden')){
			cartContent.slideDown(),
			$(this).addClass('close-cart')
		}
		else {
			cartContent.slideUp(),
			$(this).removeClass('close-cart')
		}
		return false
	});
	}
	$('#header #cart_block, .header-button ul, div.alert_cart a').on('click touchstart', function(e){
		e.stopPropagation();
	});
	$(document).on('click touchstart', function(){
		$('#header').find('#cart_block').slideUp(),
		$('.header-button').find('ul').slideUp(),
		$('#header_user').removeClass('close-cart'),
		$('.header-button').find('.icon_wrapp').removeClass('active')
   });
});
$(document).ready(function() {
	$('#order .addresses .address,#order-opc .addresses .address').removeAttr('style'),
	 $('#categories_block_left ul li a').prepend('<i class="icon-caret-right"></i>');
})