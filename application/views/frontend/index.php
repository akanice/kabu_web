<!DOCTYPE html>
<html lang="vi">
    <?php 
        define('FRONTEND', 'frontend/');
    ?>
	<head>
		<?php $this->load->view(FRONTEND.'head'); ?>
	</head>
	<body>
		<div class="body-wrapper theme-clearfix">
			<?php
				$this->load->view(FRONTEND.'header', $this->data); 
				$this->load->view($temp); 
				$this->load->view(FRONTEND.'footer');
			?>
		</div>
		
         <?php if($this->session->flashdata('message')) :?>
             <div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class = "panel-body">
                            <h4 class = "text-center"><?php   echo $this->session->flashdata('message'); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <script>
               $(document).ready(function(){
                    $("#modal-message").modal('show');
               });
            </script>	
        <?php endif;   ?>
	</body>
</html>