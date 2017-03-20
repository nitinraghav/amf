<?php 
	//header included for french characters
	header('Content-type: text/html; charset=utf8');

	$pageTitle = "AMF | Form Selector";
	$pageHeader = "Form-Selector";

	include("header.php");
?>	

	<div class="wrapper">
		<div id="lang_selector">
			<h1>Select your language</h1>
			<a href="lang.php?lang=E"  id="english">English </a> <span id="separator">|</span><a href="lang.php?lang=F" id="french"> French</a>
			<h1>Choisissez votre langue</h1>
		</div>
	</div>

	<div id="response_area"></div>


</div> <!--end container -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

<script>
	$(document).ready(function() {
		
		//english button
		$("#english").on("click", function(e){
			e.preventDefault();

			$.get($(this).attr("href"), function(response){
				$(".wrapper").html(response);
			});
		
			//form search
			$(".wrapper").on("submit", "#form", function(e) {
	          	e.preventDefault();

	        	var url = $(this).attr("action");
				var formData = $(this).serialize();
				//console.log(formData);

	          	$.post(url, formData, function (result) {
		            $("#response_area").html(result);
		            $("#input").val("");
		            
				}); 
			});//end submit
		});//end english button

		//french button
		$("#french").on("click", function(e){
			e.preventDefault();

			$.get($(this).attr("href"), function(response){
				$(".wrapper").html(response);
			});

			//form search
			$(".wrapper").on("submit", "#form", function(e) {
	          	e.preventDefault();

	        	var url = $(this).attr("action");
				var formData = $(this).serialize();
				//console.log(formData);

	          	$.post(url, formData, function (result) {
		            $("#response_area").html(result);
		            $("#input").val("");
				}); 
			});//end submit
		});//end french click
	});//end ready
</script>


</body>
</html>