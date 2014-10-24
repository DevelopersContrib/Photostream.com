<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
	<link href="/css/bootstrap.css" rel="stylesheet" />
	<link href="/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	
	<link href="/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
    <link href="/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet">
    <link href="/css/base-admin-2.css" rel="stylesheet">
    <link href="/css/base-admin-2-responsive.css" rel="stylesheet">
	
	
	<script src="/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/js/libs/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="/js/libs/bootstrap.min.js"></script>
   <!-- <script src="/js/Application.js"></script>-->
	<script src="jquery-latest.pack.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/css/baraja.css" />
	<script type="text/javascript" src="/js/modernizr.custom.79639.js"></script>
     <script type="text/JavaScript">
      function valid(f) {
      !(/^[A-z&#209;&#241;0-9]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z&#209;&#241;0-9]/ig,''):null;
      } 
      </script>
    
	<input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>"/>
</head>
<body>