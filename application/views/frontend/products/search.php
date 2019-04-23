                            <section>
								<h3>Kết quả tìm kiếm với từ khóa "<?php echo $key; ?>"</h3>
                                <p>Có <?php echo $total_rows; ?> kết quả</p>
								<div class = "row">
                                    <?php foreach ($list as $row) :
                                        $cat_model->db->where('id',$row->cat_id);
                                        $cat = $cat_model->db->get('tb_category')->row();
                                    ?>
								    <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4 item_hide">
										<div class = "product">
											<a href = "<?php echo base_url('product/view/'.$row->id); ?>"><img class = "img-responsive margin0auto" src = "<?php echo base_url('uploads/product/'.$row->avatar); ?>" alt = "" /></a>
											<h5><a href = "<?php echo base_url('product/view/'.$row->id); ?>"><?php echo $row->name; ?></a></h5>
											<h4><?php echo number_format($row->price, 0, '', '.'); ?></h4>
											<h6><?php echo $cat->name; ?></h6>
											<p><?php echo word_limiter($row->content, 20); ?></p>
											<div class = "row">
											    <div class = "col-xs-12 col-sm-6 col-md-6 col-lg-6 add_cart">
													<a href = "<?php echo base_url('product/view/'.$row->id); ?>">Mua</a>
											    </div>
											    <div class = "col-xs-12 col-sm-6 col-md-6 col-lg-6 add_cart">
													<a href = "#">Yêu thích</a>
											    </div>
											</div>
										</div>
								    </div>
                                    <?php endforeach; ?>
								</div>
                                <div class = "clr"></div>
							</section>