                            <section>
								<h3>Tin tức</h3>
                                 <p>Có <?php echo $total_rows; ?> bài viết</p>
                                <?php foreach ($list as $row) : ?>
								<div class = "row items_news">
								    <div class = "col-xs-12 col-sm-3 col-md-3 col-lg-3 space_two_side">
										<a href = "<?php echo base_url('news/view/'.$row->id); ?>"><img class = "img-responsive margin0auto outline" src = "<?php echo base_url('uploads/news/'.$row->avatar); ?>" alt = "" /></a>
								    </div>
								    <div class = "col-xs-12 col-sm-9 col-md-9 col-lg-9">
										<h4><a href = "<?php echo base_url('news/view/'.$row->id); ?>"><?php echo $row->name; ?></a></h4>
										<time><?php echo date('d/m/Y',$row->create_at); ?></time>
										<p><?php echo word_limiter($row->summary, 30); ?></p>
										<div class = "button_a">
											<a href = "<?php echo base_url('news/view/'.$row->id); ?>">Xem thêm</a>
										</div>
								    </div>
								</div>
                                <?php endforeach; ?>
								<nav aria-label="Page navigation">
                                    <ul class="pagination pull-right">
                                        <li><?php echo $this->pagination->create_links(); ?></li>
                                    </ul>
                                </nav>
                                <div class = "clr"></div>
							</section>