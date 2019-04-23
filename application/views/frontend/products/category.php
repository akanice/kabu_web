	<div class="revo_breadcrumbs">
		<div class="container">
			<div class="breadcrumbs custom-font theme-clearfix">
				<ul class="breadcrumb">
					<li><a href="https://demo.wpthemego.com/themes/sw_revo">Trang chủ</a><span class="go-page fa"></span></li>
					<li class="active"><span>Danh mục</span></li>
				</ul>
			</div>
		</div>
	</div>                            

	<div id="contents" class="main-page category_content">
		<div class="container">
			<div class="row clearfix">
				<aside id="left" class="sidebar col-lg-3 col-md-3 col-sm-12">
					<div class="widget-1 widget-first widget woocommerce_product_categories-3 woocommerce widget_product_categories">
						<div class="widget-inner">
							<div class="block-title-widget">
								<h2><span>Danh mục sản phẩm</span></h2>
							</div>
							<ul class="product-categories" data-number="10" data-moretext="See More" data-lesstext="See Less">
								<?php if ($categories) {foreach ($categories as $cat) {?>
								<li class="cat-item"><a href="<?=@base_url('danh-muc/'.$cat->alias)?>"><?=@$cat->title?></a></li>
								<?php } } else {echo 'Chưa có danh mục sản phẩm nào';}?>
							</ul>
						</div>
					</div>
					<div class="widget-5 widget-last widget text-9 widget_text">
						<div class="widget-inner">
							<div class="textwidget">
								<div class="sw-best-seller-product widget-inner">
									<div class="block-title-widget">
										<h2>Được quan tâm nhất</h2>
									</div>
									<div class="wrap-content">
										<div class="item">
											<div class="item-inner">
												<div class="item-img">
													<a href="#" title="Tai nghe trùm tai"><br>
														<img width="100" height="100" src="/assets/img/sample_product2.png" class="attachment-shop_thumbnail size-shop_thumbnail" alt=""> </a>
												</div>
												<div class="item-content">
													<h4><a href="#" title="Tai nghe trùm tai">Tai nghe trùm tai</a></h4>
													<div class="item-price"><span class="amount">$70.00</span></div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="item-inner">
												<div class="item-img">
													<a href="#" title="Tai nghe trùm tai"><br>
														<img width="100" height="100" src="/assets/img/sample_product2.png" class="attachment-shop_thumbnail size-shop_thumbnail" alt=""> </a>
												</div>
												<div class="item-content">
													<h4><a href="#" title="Tai nghe trùm tai">Tai nghe trùm tai</a></h4>
													<div class="item-price"><span class="amount">$70.00</span></div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="item-inner">
												<div class="item-img">
													<a href="#" title="Tai nghe trùm tai"><br>
														<img width="100" height="100" src="/assets/img/sample_product2.png" class="attachment-shop_thumbnail size-shop_thumbnail" alt=""> </a>
												</div>
												<div class="item-content">
													<h4><a href="#" title="Tai nghe trùm tai">Tai nghe trùm tai</a></h4>
													<div class="item-price"><span class="amount">$70.00</span></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</aside>
				
				<div id="contents-box" class="content col-lg-9 col-md-9 col-sm-12 bg_white" role="main">
					<div id="primary" class="content-area">
						<main id="main" class="site-main wrap-section" role="main">
							<!--  Shop Title -->
							<h1 class="page-title">Shop</h1>

							<!-- Description -->
							<div class="products-wrapper">
								<ul class="products-loop row clearfix grid" style="display: block;"></ul>
								<div class="products-nav clearfix">
									<div class="notices-wrapper"></div>
									
									<nav class="kabu-navigation">
										<ul class="pagination">
											<?php echo $page_links;?>
											<li class="page-item active"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">→</a></li>
										</ul>
									</nav>
								</div>
								
								<div class="row">
									<?php if($products) {foreach ($products as $item) {?>
									<div class="col-sm-3 col-6">
										<div class="product-item"><!-- product item -->
											<div class="image" style="background:url(<?=@base_url($item->thumb)?>);background-size:cover; height: 160px;">
												<a href="<?=@base_url('san-pham/'.$item->alias)?>"></a>
											</div>
											<div class="description">
												<a href="<?=@base_url('san-pham/'.$item->alias)?>"><h5><?=@$item->title?></h5>
												<p class="price-sale">
													<span class="final-price">
														<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
																echo $item->sale_price;
															} else {
																echo $item->price;
															}?> đ
													</span>
													<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="price-regular"><?=@$item->price?> đ</span><span class="sale-tag sale-tag-square"><?=round(($item->price-$item->sale_price)*100/$item->price,0)?> %</span><?php } ?>
												</p></a>
											</div>
										</div>
									</div>
									<?php }} else {echo 'Chưa có sản phẩm nào trong mục này';}?>
								</div>
								
								<div class="clear"></div>
								<div class="products-nav clearfix">
									<nav class="kabu-navigation">
										<ul class="pagination">
											<?php echo $page_links;?>
											<li class="page-item active"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
										</ul>
									</nav>
								</div>
							</div>
						</main>
					</div>
				</div>
			</div>
			
		</div>
	</div>