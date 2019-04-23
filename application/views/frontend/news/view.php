                            <?php 
                                $cat_model->db->where('id',$news->cat_id);
                                $cat = $cat_model->db->get('tb_category')->row();
                            ?>
                            <article class = "content_view">
								<h4><?php echo $news->name; ?></h4>
								<time><?php echo $cat->name; ?> - <?php echo date('d/m/Y',$news->create_at); ?> - Có <?php echo $news->view; ?> lượt xem</time>
								<p><strong><?php echo $news->summary; ?></strong></p>
                                <p><?php echo $news->content; ?></p>
								<img class = "img-responsive margin0auto" src = "<?php echo common_helper::front_end(); ?>images/facebook_comment.png" alt = "" />	
								<div class = "cactinkhac">
									<ul>
                                        <?php foreach ($news_newsest as $row) : ?>
										<li><a href = "<?php echo base_url('news/view/'.$row->id); ?>"><?php echo $row->name; ?><span class="badge"><?php echo date('d/m/Y',$row->create_at); ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
								</div>
							</article>