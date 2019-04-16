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
								Thêm mới sản phẩm
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
						<h4 class="title">Tạo mới sản phẩm</h4>
					</div>
					<div class="content">
                            <div class="form-group">
								<label class="col-sm-2 control-label">Tên sản phấm*:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" required=""/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Mã sản phẩm:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="sku" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Giá gốc:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="price" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Giá bán:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="sale_price" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Mô tả ngắn:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="short_description" rows="10"></textarea>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="description" rows="10"></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Sản phẩm nổi bật</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="featured">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tags</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Thêm tags..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="tags[]">
                                        <?php foreach($accessories as $a){?>
                                            <option value="<?=$a->id?>"><?=$a->name?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Thường được bán cùng</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Chọn combo sản phẩm..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="related[]">
                                        <?php foreach($allproducts as $a){?>
                                            <option value="<?=$a->id?>"><?=$a->title?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Meta title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_title" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Meta description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_description" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Meta keywords</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_keywords" />
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
								</div>
							</div>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="card">
					<div class="content">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">* </span>:</label>
							<div class="col-sm-8">
								<div class="" style="overflow-y: scroll;height: 250px">
									<?php foreach($list_cat_id as $cat_item) {?>
									<?php
										$indent = "";
										for ($i = 1; $i < $cat_item['level']; $i++) {
											$indent .= "--- ";
										}
									?>
									<label class="checkbox">
										<input type="checkbox" name="categoryid[]" data-toggle="checkbox" value="<?=@$cat_item['id']?>"> <?=@$indent.$cat_item['title'] ?>
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" id="image" />
								<img height="100" id="img_avatar" src="" alt ="" />
							</div>
						</div>
						<script type = "text/javascript">
							function imagesload(file, image, val) {
								var fileCollection = new Array();
								$('#' + file).on('change', function (e) {
									var files = e.target.files;
									$.each(files, function (i, file) {
										fileCollection.push(file);
										var reader = new FileReader();
										reader.readAsDataURL(file);
										reader.onload = function (e) {
											var template = e.target.result;
											$('#' + image).attr({
												'src': template
											});
											$("#" + val).val("");
										};
									});
								});
							}
						  imagesload('image', 'img_avatar', '');
						</script>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thư viện ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="gallery[]" id="images_list" multiple />
								<div id="images-to-upload"></div>
									<script type = "text/javascript">
										var fileCollection = new Array();
										$('#images_list').on('change',function(e){
											var files = e.target.files;
											$.each(files, function(i, file){
												fileCollection.push(file);
												var reader = new FileReader();
												reader.readAsDataURL(file);
												reader.onload = function(e){
													var template = '<img width = "100" src="'+e.target.result+'">';
													$('#images-to-upload').append(template);
												};
											});
										});
									</script>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Custom field</label>
							<div class="col-sm-10">
							
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
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen();
        });
    </script>