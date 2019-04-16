<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/products')?>">Quản lý sản phẩm</a>
							</li>
							<li class="active">
								Sửa sản phẩm
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Sửa thông tin sản phẩm</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tên sản phấm*:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" required="" value="<?=$products->title?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mã sản phẩm:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="sku" required="" value="<?=$products->sku?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Giá gốc:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="price" required="" value="<?=$products->price?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Giá bán:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="sell_price" required="" value="<?=$products->sale_price?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả ngắn:</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="short_description" rows="10"><?=$products->short_description?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="description" rows="10"><?=$products->description?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sản phẩm nổi bật</label>
							<div class="col-sm-10">
								<select class="form-control" name="featured">
									<option value="0" <?php if($products->featured==0){echo 'selected="selected" ';}?>>Không</option>
									<option value="1" <?php if($products->featured==1){echo 'selected="selected" ';}?>>Có</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Linh kiện</label>
							<div class="col-sm-10">
								<select data-placeholder="Chọn linh kiện..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="accessories[]">
									<?php foreach($accessories as $a){?>
										<option value="<?=$a->id?>" <?php if (($products_tag != '') and ($products_tag != false)) { if(in_array($a->id,$products_tag)) { echo 'selected'; }}?>><?=$a->name?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="card">
					<div class="content">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">* </span>:</label>
							<div class="col-sm-8">
								<div class="" style="overflow-y: scroll;height: 250px;border: 1px solid #eee;padding: 0 10px;">
									<?php foreach($list_cat_id as $cat_item) {?>
									<?php
										$indent = "";
										for ($i = 1; $i < $cat_item['level']; $i++) {
											$indent .= "--- ";
										}
									?>
									<label class="checkbox">
										<input type="checkbox" name="categoryid[]" data-toggle="checkbox" value="<?=@$cat_item['id']?>" <?php if (in_array($cat_item['id'],$products->categoryid)) {echo 'checked';}?>> <?=@$indent.$cat_item['title'] ?>
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" />
								<img src="<?=@site_url($products->image)?>" height="100px"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thư viện ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" />
								<img src="<?=@site_url($products->image)?>"height="100px">&nbsp;
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Custom field</label>
							<div class="col-sm-10">
							
							</div>
						</div>
					</div>
				</div>
			</div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$(".chosen-select").chosen();
	});
</script>