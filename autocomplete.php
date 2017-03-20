<?php

//make DB connection
$servername = "localhost";
$dbname = "amf_form_selector";
$username = "root";
$password = "";

$conn = mysqli_connect($servername,$username,$password,$dbname);

//check if connection to DB is successful
if (!$conn) {
 die("Error: ".mysqli_connect_error());

} else {

	if($_POST["keyword"]) {

		$keyword = $_POST["keyword"];

		//set utf8 coding for french accents
		mysqli_query($conn,'SET NAMES utf8');
		$str= mysqli_real_escape_string($conn, $keyword);

		$query ="SELECT company_type FROM form WHERE company_type like '" . $keyword . "%' ORDER BY company_type LIMIT 0,6";

		$result = mysqli_query($conn, $query);

		if($result) {
			?>
			<ul id="company-list">
				<?php
				foreach($result as $company) {
					?>
					<li onClick="selectCompany('<?php echo $company["company_type"]; ?>');"><?php echo $company["company_type"]; ?></li>
				<?php } ?>
			</ul>
<?php } } } ?>