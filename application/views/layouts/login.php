<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.png">

    	<title><?php  echo $template['title'];?></title>
		<meta name="description" content="<?=$this->config->item('site_desc')?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<?php if (isset($form)) { ?>
		<link rel="stylesheet" href="<?=base_url()?>resource/js/select2/select2.css" type="text/css" cache="false" />
		<!--<link rel="stylesheet" href="<?=base_url()?>resource/js/select2/theme.css" type="text/css" cache="false" />-->
		<?php } ?>
		

		<link rel="stylesheet" href="<?=base_url()?>resource/css/app.v2.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>resource/css/font.css" type="text/css" cache="false" />
		<link rel="stylesheet" href="<?=base_url()?>resource/css/components.min.css" type="text/css" cache="false" />
		<link rel="stylesheet" href="<?=base_url()?>resource/css/login.min.css" type="text/css" cache="false" />
	</head>

	<body class="login"> 
		<!--main content start-->
    	<?php  echo $template['body'];?>
    	<!--main content end-->

		<!-- footer --> 
		<footer id="footer">
			<div class="text-center padder copyright">
				<p> 
					All rights reserved.<br>
					<?=date('Y')?> &copy;  
					<a href="<?=$this->config->item('company_domain')?>" target="_blank"><?=$this->config->item('company_name')?></a>
				</p>
			</div> 
		</footer>
		<!-- / footer -->
		<script src="<?=base_url()?>resource/js/app.v2.js">
		
		</script>
		<script src="<?=base_url()?>resource/js/select2/select2.min.js" cache="false"></script>
		<!-- Bootstrap -->
		<!-- App -->
	</body>
</html>