<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?=$this->config->item('company_name').' - '.$this->config->item('website_name'). ' '. $this->config->item('version')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=base_url()?>resource/css/style_not_found.css" rel="stylesheet" type="text/css" media="all"/>
<link href='http://fonts.googleapis.com/css?family=Fenix' rel='stylesheet' type='text/css'>
</head>
<body style="background: url(<?=base_url()?>resource/images/bg_not_found.png);">
  <div class="wrap">
	 <div class="main">
		<h3><?=$this->config->item('company_name')?></h3>
		<h1>Oops, Could not found</h1>
		<p>There's a lot of reasons why this page is<span class="error"> 404</span>.<br /></p>
		<p><a href="<?=base_url()?>" style="color: #1cd3cb;font-size: 14px;text-decoration: underline;">Back to Home</a></p>
        <br />
   </div>
	<div class="footer">
		<p>&copy; All rights reserved | Developed by <a href="<?=$this->config->item('company_domain')?>" target="_blank" style="color: #1cd3cb;"><?=$this->config->item('company_name')?></a></p>
    </div>
  </div>
</body>
</html>

