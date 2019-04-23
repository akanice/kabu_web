	<title><?php if ($title == '' or $title == null) {echo 'Kabu';} else {echo $title;}?></title>
	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="fb:admins" content="100000039015050"/>
	<meta property="fb:app_id" content="473175002856410" />
	<meta name="title" content="<?=@$meta_title?>" />
	<meta name="copyright" content="Copyright © 2015 by poh.vn" />
	<meta name="keywords" content="<?=@$meta_keywords?>" />
	<meta name="description" content="<?=@$meta_description?>" />
	<meta name="og:title" content="<?php if ($title == '' or $title == null) {echo 'Kabu';} else {echo $title;}?>" />
	<meta name="og:keywords" content="<?=@$meta_keywords?>" />
	<meta name="og:description" content="<?=@$meta_description?>" />
	<meta name="og:image" content="<?=@$meta_image?>" />
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="icon" href="<?=base_url('wp-content/uploads/2018/06/favicon.png')?>" sizes="32x32" />
	<link rel="apple-touch-icon-precomposed" href="<?=base_url('wp-content/uploads/2018/06/favicon.png')?>" />
	
	<script src="<?=base_url('assets/js/defer_plus.min.js')?>"></script>
	<script type="text/javascript">
	deferscript('https:///platform-api.sharethis.com/js/sharethis.js#property=5c829ea19fbe5a0017077a7f&product=sticky-share-buttons', 'social-buttons', 3000);
	deferimg('img', 100);
	deferstyle('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=vietnamese', 'google-font-css', 1000);
	</script>
	
	<link href="<?=base_url('assets/plugins/owl-carousel/css/owl.carousel.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/plugins/owl-carousel/css/owl.theme.default.min.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
	<link href="<?=base_url('assets/plugins/owl-carousel/css/owl.theme.default.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/extra/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/front/responsive.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=vietnamese" rel="stylesheet">
	
	<?=@$global_header_code;?>

	
		<!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		