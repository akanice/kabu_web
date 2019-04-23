	<div class="revo_breadcrumbs">
		<div class="container">
			<div class="breadcrumbs custom-font theme-clearfix">
				<ul class="breadcrumb">
					<li><a href="<?=base_url()?>">Trang chủ</a><span class="go-page fa"></span></li>
					<li class="active"><span><?=@$product_data->title?></span></li>
				</ul>
			</div>
		</div>
	</div>  
	
	<div class="main-page product">
		<section id="product_detail" class="block-section sw-category-slider wrap"><!-- section feature categories -->
			<div class="container">
				<div class="row product-summary" itemscope="" itemtype="http://schema.org/Product">
					<div class="product-image col-sm-5">
						<div class="image-box js-image-box">
							<div class="magiczoom book ">
								<a href="#" class="book-review-btn"><img src="https://salt.tikicdn.com/assets/img/icon-doc-thu.png" width="121" alt=""></a>
								<a class="js-book-review-show" href="#">
									<img id="product-magiczoom" class="product-magiczoom" itemprop="image" src="https://salt.tikicdn.com/cache/550x550/media/catalog/product/n/_/n.h.k_3.jpg">
								</a>
								<div class="txt-desc-for-img">
								</div>
							</div>
							<div class="image-thumbnail-block" id="image-thumbnail-block">
								<div data-reactroot="">
									<div class="product-feature-images vertical"><span class="thumb-item active"><span class="flx"><img alt="Product" src="https://salt.tikicdn.com/cache/75x75/media/catalog/product/n/_/n.h.k_3.jpg"></span></span></div>
									<div class="product-reivew-images"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="product-cart col-sm-7">
						<div class="item-box">
							<h1 class="item-name" itemprop="name" id="product-name">
								<span>Dạy con làm giàu</span>
							</h1>

							<div class="product-brand-block">
								<div class="item-row1 brand-block">
									<div class="item-price">
										<div class="brand-block-row">
											<div class="item-brand item-sku" id="product-sku">
												<h6>SKU: </h6>
												<p>3102383055879 </p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row flex">
								<div class="col-xs-8 col-sm-8 no-padding-right product-info-block col-12">
									<div class="item-row1">
										<div class="item-price">
											<div class="price-block show-border">
												<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
													<meta itemprop="priceCurrency" content="VND">
													<meta itemprop="price" content="56000">
													<link itemprop="availability" href="http://schema.org/InStock">
												</div>
												<p class="special-price-item" data-value="56000" id="p-specialprice">
													<span id="flash-sale-price-label" style="display: none;" class="">
														<img class="icon-flash-sale" src="https://salt.tikicdn.com/desktop/img/flash-sale-price-label.png?v=2" width="80">
														<img class="icon-hot-deal" src="https://salt.tikicdn.com/desktop/img/deal-hot@2x.png" width="91">Giá: </span>
													<span id="span-price">56.000 đ</span>
												</p>

												<p style="" class="saleoff-price-item" id="p-saving-price">
													<span class="price-label">Tiết kiệm:</span>
													<span id="span-discount-percent" class="discount-percent">30%</span>
													<span id="span-saving-price">
														(24.000 đ)
													</span>
												</p>

												<p style="" class="old-price-item" data-value="80000" id="p-listpirce">
													<span class="price-label">Giá thị trường:</span>
													<span id="span-list-price">80.000&nbsp;₫</span>
												</p>
											</div>
										</div>
									</div>

									<form role="form" id="add-to-cart" action="<?php echo base_url('cart/add/'.$product_data->id); ?>" method="post">
										<input type="hidden" name="product_type" value="configurable">
										<div class="item-product-options">
										</div>

										<div class="item-product-options">
											<div id="add-cart-action">
												<div class="add-cart-action" style="display: block">
													<div class="quantity-box">
														<div class="cta-box">
															<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
																<input class="vertical-quantity form-control input-number" type = "text" size="1" name= "quantity" value = "1"  min="0" max="1000"/>
																<span class="input-group-btn-vertical">
																	<button class="btn btn-outline bootstrap-touchspin-up icon-up-dir btn-number" type="button" data-type="plus" data-field="quantity"><i class="fa fa-angle-up"></i></button>
																	<button class="btn btn-outline bootstrap-touchspin-down icon-down-dir btn-number" type="button" data-type="minus" data-field="quantity"><i class="fa fa-angle-down"></i></button>
																</span>
															</div><br>
															<button id="#mainAddToCart" class="add-to-cart  js-add-to-cart is-css" type="submit">
																<span class="text"><i class="fa fa-shopping-bag"></i> CHỌN MUA</span>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>

									<!--bbbb-->
								</div>
								<div class="col-xs-4 col-sm-4 product-seller-block d-none d-sm-block">
									<div class="seller-container">
										<div id="seller-list" style="display: ">
											<div data-reactroot="">
												<div class="seller-block-wrap">
													<div class="current-seller" data-id="1">
														<div class="name"><i class="tikicon icon-store"></i>
															<div class="text"><span>Kabu Trading</span>
																<div class="text-small">Cam kết chính hiệu 100%</div>
															</div>
														</div>
														<div class="warranty-info"><i class="tikicon icon-hoan-tien-2"></i>
															<div class="text">
																Tiki hoàn tiền 111%
																<div class="text-small">Nếu phát hiện hàng giả</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="additional">
											<div class="contact">
												<div class="item">
													<i style="margin-top: 5px" class="tikicon icon-phone"></i>
													<!-- <p>
														<b>Liên hệ</b><br>
														HOTLINE: <a href="tel:1900 6035">1900 6035</a><br>
														<small>(1.000đ/phút, 8-21h cả T7, CN)</small>
													</p> -->
													<p>
														<b>Liên hệ</b><br>
														Hotline đặt hàng <a href="tel:1800 6963">1800 6963</a><br>
														<small>(Miễn phí, 8-21h cả T7, CN)</small>
													</p>
												</div>
												<div class="item">
													<i style="margin-top: -2px" class="tikicon icon-email"></i>
													<p>
														Email: <a href="mailto:hotro@tiki.vn">hotro@kabu.vn</a>
													</p>
												</div>
											</div>
											<div class="register-to-sell">
												Bạn muốn bán hàng cùng Kabu? <a target="_blank" href="/ban-hang-cung-tiki?ref=pdp-seller-info">Đăng ký</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="footer-block">
								<div class="item-promotion" id="promotion">
									<div class="promotion-content">
										<div class="item-promotion-content">
											<div class="title">DỊCH VỤ &amp; KHUYẾN MÃI LIÊN QUAN</div>
										   <p>Khuyến mãi khác</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="also_buy block-section"><!-- Related Products -->
			<div class="container">
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="wrap-section">
							<div class="block-title">
								<h3 class="font-custome"><span>Sản phẩm thường được mua cùng</span></h3>
							</div>
							<div class="category-slider product-slider">
								<div class="responsive row">
									<div class="product-item item slick-slide slick-current slick-active"><!-- product item -->
										<div class="image item-image">
											<img src="/assets/img/sample_product2.png" class="img-holder">
										</div>
										<div class="description">
											<h5>Ba lô da nữ dễ thương</h5>
											<p class="price-sale">
												<span class="final-price">66.500 đ
											</p>
										</div>
									</div>
									<div class="product-item item slick-slide slick-current slick-active"><!-- product item -->
										<div class="image item-image">
											<img src="/assets/img/sample_product2.png" class="img-holder">
										</div>
										<div class="description">
											<h5>Ba lô da nữ dễ thương</h5>
											<p class="price-sale">
												<span class="final-price">66.500 đ
											</p>
										</div>
									</div>
									<div class="product-item item slick-slide slick-current slick-active"><!-- product item -->
										<div class="image item-image">
											<img src="/assets/img/sample_product2.png" class="img-holder">
										</div>
										<div class="description">
											<h5>Ba lô da nữ dễ thương</h5>
											<p class="price-sale">
												<span class="final-price">66.500 đ
											</p>
										</div>
									</div>
									<div class="product-item item slick-slide slick-current slick-active"><!-- product item -->
										<div class="image item-image">
											<img src="/assets/img/sample_product2.png" class="img-holder">
										</div>
										<div class="description">
											<h5>Ba lô da nữ dễ thương</h5>
											<p class="price-sale">
												<span class="final-price">66.500 đ
											</p>
										</div>
									</div>
									<div class="product-item item slick-slide slick-current slick-active"><!-- product item -->
										<div class="image item-image">
											<img src="/assets/img/sample_product2.png" class="img-holder">
										</div>
										<div class="description">
											<h5>Ba lô da nữ dễ thương</h5>
											<p class="price-sale">
												<span class="final-price">66.500 đ
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="item-product-options">
								<div id="add-cart-action">
									<div class="add-cart-action" style="display: block">
										<div class="quantity-box">
											<div class="cta-box">
												<a id="#mainAddToCart" class="btn-add-to-cart add-to-cart  js-add-to-cart is-css" type="button" href="<?php echo base_url('cart/add/'.$product_data->id); ?>">
													<span class="text"><i class="fa fa-shopping-bag"></i> Thêm tất cả vào giỏ hàng</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="also_buy block-section"><!-- Why should buy this product -->
			<div class="container">
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="wrap-section">
							<div class="block-title">
								<h3 class="font-custome"><span>Vì sao nên mua</span></h3>
							</div>
							<div class="should_buy">
								<p>Ralph Đập Phá là anh chàng đóng vai phản diện trong trò chơi “Felix sửa được tuốt” ở trung tâm giải trí gia đình. Quá chán cảnh phải đóng vai kẻ xấu và bị mọi người ghẻ lạnh, Ralph quyết định tìm đến trò chơi khác để kiếm cho riêng mình một tấm huy chương. Hành động đó đã vô tình khiến Ralph rơi vào rắc rối và đẩy trò chơi của chính anh tới nguy cơ bị rút nguồn.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="product-info block-section style-2"><!-- Product info -->
			<div class="container">
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="wrap-section">
							<div class="block-title">
								<h3 class="font-custome"><span>Thông tin sản phẩm</span></h3>
							</div>
							<div class="inner">
								<p>"Bạn hối tiếc vì không nắm bắt lấy một cơ hội nào đó, chẳng có ai phải mất ngủ..."</p>
								<p>Suy cho cùng, quyết định là ở bạn. Muốn có điều gì hay không là tùy bạn.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>