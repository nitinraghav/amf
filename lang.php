<?php

$lang= $_GET['lang'];

//setting session to be used in form_backend.php 
session_start();
$_SESSION['lang']= $lang;


//display search field depending on language selection
if ($lang=='E'){
	echo '<div>
			<form action="form_backend.php" method="POST" id="form">
				<input type="text" name="company_type" class="form-control" id="input" placeholder="Search Company Type" required="required"/>
				<button type="submit" class="btn btn-block btn-primary" id="search_btn">Search </button>
				<div id="suggestion-box"></div>
			</form>
		  <div>';
	

} else if($lang=='F'){
	echo '<div>
			<form action="form_backend.php" method="POST" id="form">
				<input type="text" name="company_type" 	class="form-control" id="input" placeholder="Type d\'entreprise" required="required" />
				<button type="submit" class="btn btn-block btn-primary" id="search_btn">Chercher </button>
				<div id="suggestion-box"></div>
			</form>
		  <div>';
}

?>
<head>

<!-- autocomplete suggestion-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$("#input").keyup(function(){
			$.ajax({
				type: "POST",
				url: "autocomplete.php",
				data:'keyword='+$(this).val(),
				beforeSend: function(){
					$("#input").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data){
					$("#suggestion-box").show();
					$("#suggestion-box").html(data);
					$("#input").css("background","#FFF");
				}
			});
		});
	});

	function selectCompany(val) {
		$("#input").val(val);
		$("#suggestion-box").hide();
	}
</script>

</head>
