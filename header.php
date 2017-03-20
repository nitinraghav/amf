<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="Content-type" value="text/html; charset=utf8" />

  	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  
  	<link rel="stylesheet" type="text/css" href="style.css" >
</head>

<body>
	<div class="container">
		<!-- navbar starts -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			
			<div class="container-fluid">

			  	<div class="navbar-header">
			    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
			      	<span class="sr-only">Toggle navigation</span>
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span> 
			   		</button>

			   		<span  ><img src="amflogo_sm.gif" id="logo" /></span>
			    	<a class="navbar-brand" href="#"><?php echo $pageHeader; ?></a>
			 	</div>


			  	<div class="collapse navbar-collapse" id="myNavbar">
			    	<ul class="nav navbar-nav navbar-right">
			      		<li><a href="./index.php">Home</a></li>
			      		<li><a href="#about">About</a></li>
			      		<li><a href="./sing_out.php">Contact-us</a></li>
			   		</ul>
			  	</div>
			</div>
		</nav>
		<!-- navbar ends -->