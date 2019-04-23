	<div class="revo_breadcrumbs">
		<div class="container">
			<div class="breadcrumbs custom-font theme-clearfix">
				<ul class="breadcrumb">
					<li><a href="<?=base_url()?>">Trang chủ</a><span class="go-page fa"></span></li>
					<li><a href="<?=base_url('cart')?>">Giỏ hàng</a><span class="go-page fa"></span></li>
					<li class="active"><span>Thanh toán</span></li>
				</ul>
			</div>
		</div>
	</div>     
	
	<div id="contents" class="main-page category_content">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="order-summary cart-summary">
						<h3>Tổng đơn hàng</h3>
						<h4>
							<a data-toggle="collapse" href="#order-cart-section" class="" role="button" aria-expanded="true" aria-controls="order-cart-section"><?=@$total_items; ?> sản phẩm trong giỏ</a>
						</h4>

						<div class="collapse show" id="order-cart-section" style="">
							<table class="table table-mini-cart">
								<tbody>
									<?php
										$total_amount = 0;
										foreach($carts as $row) {
										$total_amount = $total_amount + $row['subtotal'];
									?>
									<tr>
										<td class="product-col">
											<figure class="product-image-container">
												<a href="product.html" class="product-image">
													<img src="<?=@base_url($row['thumb']); ?>" alt="product">
												</a>
											</figure>
											<div>
												<h2 class="product-title">
													<a href="product.html"><?=@$row['name'];?></a>
												</h2>

												<span class="product-qty">Số lượng: <?php echo $row['qty']; ?></span>
											</div>
										</td>
										<td class="price-col"><?=number_format($row['subtotal'], 0, '', '.');?> đ</td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td>Tổng cộng</td>
										<td><?=number_format($total_amount, 0, '', '.');?> đ</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div><!-- End .col-lg-4 -->

				<div class="col-lg-8 order-lg-first">
					<div class="checkout-payment">
						<h2 class="step-title">Thông tin đơn hàng</h2>
						<div id="new-checkout-address" class="show inner-bg">
							<form action="#" class="checkout-form" method="post">
								<div class="form-group required-field">
									<label>Họ tên</label>
									<input type="text" class="form-control" value="<?php echo isset($user->name) ? $user->name : ''; ?>" name="guest_name" required="" />
								</div>
								<div class="form-group">
									<label>Email </label>
									<input type="email" class="form-control" value="<?php echo isset($user->email) ? $user->email : ''; ?>" name="guest_email" required="">
								</div><!-- End .form-group -->

								<div class="form-group required-field">
									<label>Điện thoại </label>
									<input type="text" class="form-control" value="<?php echo isset($user->phone) ? $user->phone : '';  ?>" name="guest_phone" required="">
								</div><!-- End .form-group -->

								<div class="form-group required-field">
									<label>Địa chỉ giao hàng </label>
									<input type="text" class="form-control" value="<?php echo isset($user->address) ? $user->address : ''; ?>" name="guest_address" required="">
								</div><!-- End .form-group -->
								
								<div class="form-group required-field">
									<label>Hình thức thanh toán</label>
									<select name="payment" class="form-control">
										<option value="cod">Thanh toán khi giao hàng</option>
										<option value="bank-tranfer">Chuyển khoản ngân hàng</option>
									</select>
								</div><!-- End .form-group -->
								
								<input type="hidden" class="form-control" value="<?php echo isset($affiliate) ? $affiliate : ''; ?>" name="affiliate" required="">
								<div class="form-group">
									<label>Ghi chú</label>
									<textarea name="message" class="form-control" value="" rows="5"></textarea>
									<?php echo form_error('message'); ?>
								</div>
								<div class="clearfix">
									<a href="#" class="btn btn-primary float-left" type="submit" name="submit">Tiến hành đặt hàng</a>
								</div>
								<br>
							</form>
						</div>
					</div>
				</div><!-- End .col-lg-8 -->
			</div>
		</div>
	</div>