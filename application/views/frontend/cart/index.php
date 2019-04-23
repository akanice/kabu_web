	<div class="revo_breadcrumbs">
		<div class="container">
			<div class="breadcrumbs custom-font theme-clearfix">
				<ul class="breadcrumb">
					<li><a href="<?=base_url()?>">Trang chủ</a><span class="go-page fa"></span></li>
					<li class="active"><span>Giỏ hàng</span></li>
				</ul>
			</div>
		</div>
	</div>          
	
	<div id="contents" class="main-page category_content">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table-container inner-bg">
						<?php if($total_items > 0) { ?>
						<form action = "<?php echo base_url('cart/update'); ?>" method = "POST">
						<table class="table table-cart">
							<thead>
								<tr>
									<th class="product-col">Sản phẩm</th>
									<th class="price-col">Giá</th>
									<th class="qty-col">Số lượng</th>
									<th>Thành tiền</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$total_amount = 0;
									foreach($carts as $row) {
									$total_amount = $total_amount + $row['subtotal'];
								?>
								<tr class="product-row">
									<td class="product-col">
										<figure class="product-image-container"><a href="product.html" class="product-image"><img src="<?=@base_url($row['thumb']); ?>" alt="product"></a></figure>
										<h2 class="product-title"><a href="product.html"><?=@$row['name'];?></a></h2>
									</td>
									<td><?=number_format($row['price'], 0, '', '.');?> đ</td>
									<td>
										<div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected">
											<input class="vertical-quantity form-control input-number" type = "text" size = "1" name = "qty_<?php echo $row['id']; ?>" value = "<?php echo $row['qty']; ?>"  min="0" max="1000"/>
											<span class="input-group-btn-vertical">
												<button class="btn btn-outline bootstrap-touchspin-up icon-up-dir btn-number" type="button" data-type="plus" data-field="qty_<?php echo $row['id']; ?>"><i class="fa fa-angle-up"></i></button>
												<button class="btn btn-outline bootstrap-touchspin-down icon-down-dir btn-number" type="button" data-type="minus" data-field="qty_<?php echo $row['id']; ?>"><i class="fa fa-angle-down"></i></button>
											</span>
										</div>
									</td>
									<td><?=number_format($row['subtotal'], 0, '', '.');?> đ</td>
								</tr>
								<tr class="product-action-row">
									<td colspan="4" class="clearfix">
										<div class="float-right">
											<a href="<?=base_url('cart/del/'.$row['id']); ?>" title="Remove product" class="btn-remove"><span class="sr-only">Xóa</span><i class="fa fa-trash"></i> Xóa</a>
										</div><!-- End .float-right -->
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" class="clearfix">
										<div class="float-left"><a href="category.html" class="btn btn-outline-secondary">Tiếp tục mua sắm</a></div>
											<div class="float-right"><a href="<?=base_url('cart/del'); ?>" class="btn btn-outline-secondary btn-clear-cart">Xóa toàn bộ</a><button type = "submit" class="btn btn-outline-secondary btn-update-cart">Cập nhật giỏ hàng</button></div>
									</td>
								</tr>
							</tfoot>
						</table>
						</form>
						<?php } else { ?>
						<br />
						<h4 class = "text-success">Không có sản phẩm nào trong giỏ hàng</h4>
						<?php } ?>
					</div>
					<!--<div class="cart-discount">
						<h4>Apply Discount Code</h4>
						<form action="#">
							<div class="input-group"><input type="text" class="form-control form-control-sm" placeholder="Enter discount code" required="">
								<div class="input-group-append"><button class="btn btn-sm btn-primary" type="submit">Apply Discount</button></div>
							</div>
						</form>
					</div>-->
				</div>
				<div class="col-lg-4">
					<div class="cart-summary">
						<h3>Tổng đơn hàng</h3>
						<table class="table table-totals">
							<tbody>
								<tr>
									<td>Tổng cộng</td>
									<td><?=number_format($total_amount, 0, '', '.');?> đ</td>
								</tr>
								<tr>
									<td>Thuế</td>
									<td>0</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>Tổng cộng</td>
									<td><?=number_format($total_amount, 0, '', '.');?> đ</td>
								</tr>
							</tfoot>
						</table>
						<div class="checkout-methods"><a href="<?php echo base_url('order/checkout'); ?>" class="btn btn-block btn-primary">Thanh toán</a>
					</div>
				</div>
			</div>
		</div>
	</div>