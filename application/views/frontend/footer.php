		<footer>
			<div class="container">
				<div class="col-sm-12">
					<div class="copyright center">
						<h5>© Copyright by Kabu 2019</h5>
					</div>
				</div>
			</div>
		</footer>
		
<div class="resmenu-container resmenu-container-sidebar">
    <div id="ResMenuSB" class="menu-responsive-wrapper">
        <div class="menu-close"></div>
        <div class="menu-responsive-inner">
            <div class="resmenu-top">
                <div class="widget-2 widget sw_ajax_woocommerce_search-6 sw_ajax_woocommerce_search">
                    <br/>
                </div>
                <div class="resmenu-top-mobile">
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#ResPrimary" data-toggle="tab" class="tab-primary">Menu</a>
                </li>

                <li class="">
                    <a href="#ResVertical" data-toggle="tab" class="tab-vertical">Tài khoản</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="ResPrimary" class="tab-pane active">
                    <div class="resmenu-container"><button class="navbar-toggle bt_menusb" type="button" data-target="#ResMenuSB">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button></div>
                    <ul id="menu-primary-menu-3" class="menu revo-menures">
                        <li class="active res-dropdown menu-home"><a class="item-link" href="#">Trang chủ</a></li>
                        <li class="res-dropdown has-img menu-shop"><a class="item-link" href="#"><span class="menu-title">Sản phẩm</span></a><span class="show-dropdown fa"></span></li>
							<ul class="dropdown-resmenu">
                                <li class="menu-accessories"><a href="#">Quần áo</a></li>
                            </ul>
                        <li class="res-dropdown has-img menu-promotions"><a class="item-link" href="#"><span class="menu-title">Khuyến mãi</span></a></li>
                        <li class="res-dropdown has-img menu-promotions"><a class="item-link" href="#"><span class="menu-title">Về chúng tôi</span></a><span class="show-dropdown fa"></span></li>
                    </ul>
                </div>

                <div id="ResVertical" class="tab-pane ">
                    <div class="resmenu-container"><button class="navbar-toggle bt_menusb" type="button" data-target="#ResMenuSB">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button></div>
                    <ul id="menu-verticle-menu-3" class="menu revo-menures">
                        <li class="icon-phone has-img menu-smartphone"><a class="item-link" href="#"><span class="menu-title">Giỏ hàng</span></a></li>
                        <li class="icon-phone has-img menu-smartphone"><a class="item-link" href="#"><span class="menu-title">Thanh toán</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
	</div>

	<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
	<script src="<?=base_url('assets/plugins/owl-carousel/js/owl.carousel.min.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/script.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".owl-carousel").owlCarousel({
				loop:true,
					margin:5,
					autoplay: true,
					responsiveClass:true,
					responsive:{
						0:{
							items:2,
						},
						600:{
							items:3,
							nav:false
						},
						1000:{
							items:5,
							nav:false,
							loop: true
						}
					}
			});
			$(".owl-carousel").owlCarousel({
				loop:true,
					margin:5,
					autoplay: true,
					responsiveClass:true,
					responsive:{
						0:{
							items:2,
						},
						600:{
							items:3,
							nav:false
						},
						1000:{
							items:5,
							nav:false,
							loop: true
						}
					}
			});
			$(".combo-list").owlCarousel({
				loop:true,
					margin:5,
					autoplay: true,
					responsiveClass:true,
					responsive:{
						0:{
							items:2,
						},
						600:{
							items:3,
							nav:false
						},
						1000:{
							items:5,
							nav:false,
							loop: true
						}
					}
			});
			// swipper initialize
			var mySwiper = new Swiper ('.swiper-container', {
				// Optional parameters
				direction: 'horizontal',
				loop: true,

				// If we need pagination
				pagination: {
				  el: '.swiper-pagination',
				},

				// Navigation arrows
				navigation: {
				  nextEl: '.swiper-button-next',
				  prevEl: '.swiper-button-prev',
				},

				// And if we need scrollbar
				scrollbar: {
				  el: '.swiper-scrollbar',
				},
				simulateTouch: true,
				allowTouchMove: true,
			  })
			setTimeout(function() {
				(function(d, s, id){
					return;
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/vi_VN/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			}, 3000);
		});
	</script>
</body>