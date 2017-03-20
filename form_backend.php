<?php
//header included for french characters
header('Content-type: text/html; charset=utf8');

session_start();

//check if input filed was filled and language is set
if(!isset($_POST['company_type']) && !isset($_SESSION['lang'])){
	header("location: index.php");

} else {
	$company_type= $_POST['company_type'];
	$lang= $_SESSION['lang'];

	//make DB connection
	$servername = "localhost";
	$dbname = "amf_form_selector";
	$username = "root";
	$password = "";

	$conn = mysqli_connect($servername,$username,$password,$dbname);

	//check if connection to DB is successful
	if (!$conn) {
	 die("Error: ".mysqli_connect_error());
	 exit;
	}

	//set utf8 coding for french characters
	mysqli_query($conn,'SET NAMES utf8');
	$str= mysqli_real_escape_string($conn, $company_type);

	//make DB query
	$query = "SELECT * FROM form WHERE company_type='".$str."' AND language= '".$lang."' ";
	$result = mysqli_query($conn, $query);

	//check if company type exists
	if(mysqli_num_rows($result) ==0){
		echo "Company Type does NOT exist";
		exit;

	} else {
		$row = $result -> fetch_assoc();

		$liability = $row['liability'];
		$property = $row['property'];
		$e_o = $row['e&o'];
		$excess = $row['excess'];
		$umbrella = $row['umbrella'];

		//creating function to find keywords in results fetched from DB
		function strpos_all($haystack, $needle) {
		    $offset = 0;
		    $allpos = array();
		    while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
		        $offset  = $pos + 1;
		        $allpos[]= $pos;
		    }
		    return $allpos;
		}

		//-----------liability---------------
		if (!$liability){
			echo "<h3>Liability:</h3> This Line of Business is not available for this Company Type<br/>";

		} else {

			// checking for 'or' in ENGLISH liability forms 
			if ($liability == "E_AMF_Commercial Business Application.pdf or E_AMF_Liquor License Application.pdf") {
				echo "<h3>Liability:</h3>
					 <a href='/apps/E_AMF_Commercial Business Application.pdf'>E_AMF_Commercial Business Application.pdf</a><br/>
					 <h4 style='text-align: center'> OR </h4>
					 <a href='/apps/E_AMF_Liquor License Application.pdf'>E_AMF_Liquor License Application.pdf</a><br/>";


			} else if($liability == "E_AMF_Rented Owner Occuipied or Vacant Dwelling Application.pdf and E_AMF_Woodstove Questionnaire.pdf") {
				echo "<h3>Liability:</h3>
					<a href='/apps/E_AMF_Rented Owner Occuipied.pdf'>E_AMF_Rented Owner Occuipied.pdf</a> <h4> OR </h4> <a href='/apps/E_AMF_Vacant Dwelling Application.pdf'>E_AMF_Vacant Dwelling Application.pdf</a><br/>
					<h4 style='text-align: center'> AND </h4>
					<a href='/apps/E_AMF_Woodstove Questionnaire.pdf'>E_AMF_Woodstove Questionnaire.pdf</a><br/>";


			// checking for 'or' in FRENCH liability forms 
			} else if($liability == "F_AMF_Commercial Business Application.pdf or F_AMF_Liquor License Application.pdf"){
				echo "<h3>Liability:</h3>
					 <a href='/apps/F_AMF_Commercial Business Application.pdf'>F_AMF_Commercial Business Application.pdf</a><br/>
					 <h4 style='text-align: center'> OR </h4>
					 <a href='/apps/F_AMF_Liquor License Application.pdf'>F_AMF_Liquor License Application.pdf</a><br/>";



			} else if($liability == "F_AMF_Rented Owner Occuipied or Vacant Dwelling Application.pdf and F_AMF_Woodstove Questionnaire.pdf") {
				echo "<h3>Liability:</h3>
					<a href='/apps/F_AMF_Rented Owner Occuipied.pdf'>F_AMF_Rented Owner Occuipied.pdf</a> <h4> OR </h4> <a href='/apps/F_AMF_Vacant Dwelling Application.pdf'>F_AMF_Vacant Dwelling Application.pdf</a><br/>
					<h4 style='text-align: center'> AND </h4>
					<a href='/apps/F_AMF_Woodstove Questionnaire.pdf'>F_AMF_Woodstove Questionnaire.pdf</a><br/>";

			} else {
				//getting 'pdf' position/s(if exists) 
				$liability_pos= strpos_all($liability, 'pdf');
				
				//check if one 'pdf', two 'pdf' or three 'pdf' 
				if (count($liability_pos)===1){
					echo "<h3>Liability:</h3>";
					echo "<a href='/apps/".$liability."'>".$liability."</a> <br />";

				} else if (count($liability_pos) === 2) {
					$first_form= substr($liability, 0, $liability_pos[0]+3);
					$second_form= substr($liability, $liability_pos[0]+8);

					echo "<h3>Liability:</h3>";
					echo "<a href='/apps/".$first_form."'>".$first_form."</a><br/>";
					echo "<h4 style='text-align: center'> AND </h4>";
					echo "<a href='/apps/".$second_form."'>".$second_form."</a> <br />";
					
				} else if (count($liability_pos) === 3) {
					$first_form= substr($liability, 0, $liability_pos[0]+3);
					$second_form= substr($liability, $liability_pos[0]+8, ($liability_pos[1]+3));
					$third_form= substr($liability, $liability_pos[1]+8);

					echo "<h3>Liability:</h3>";
					echo "<a href='/apps/".$first_form."'>".$first_form."</a> <br />";
					echo "<h4 style='text-align: center'> AND </h4> ";
					echo "<a href='/apps/".$second_form."'>".$second_form."</a> <br />";
					echo "<h4 style='text-align: center'> AND </h4>";
					echo "<a href='/apps/".$third_form."'>".$third_form."</a> <br />";

				}
			}

		}

			
		//---------------property--------------
		if (!$property){
			echo "<h3>Property:</h3> This Line of Business is not available for this Company Type<br/>";

		} else {
			// checking for 'or' in ENGLISH property forms
			if ($property == "E_AMF_Commercial Business Application.pdf PDF or E_AMF_Liquor License Application.pdf") {
				echo "<h3>Property:</h3>
					<a href='/apps/E_AMF_Commercial Business Application.pdf'>E_AMF_Commercial Business Application.pdf</a><br/>
					<h4 style='text-align: center'> OR </h4> 
					<a href='/apps/E_AMF_Liquor License Application.pdf'>E_AMF_Liquor License Application.pdf</a><br/>";

			} else if($property == "E_AMF_Rented Owner Occuipied or Vacant Dwelling Application.pdf and E_AMF_Woodstove Questionnaire.pdf") {
				echo "<h3>Property:</h3>
					<a href='/apps/E_AMF_Rented Owner Occuipied.pdf'>E_AMF_Rented Owner Occuipied.pdf</a> <h4> OR </h4> <a href='/apps/E_AMF_Vacant Dwelling Application.pdf'>E_AMF_Vacant Dwelling Application.pdf</a><br/>
					<h4 style='text-align: center'> AND </h4>
					<a href='/apps/E_AMF_Woodstove Questionnaire.pdf'>E_AMF_Woodstove Questionnaire.pdf</a><br/>";

			// checking for 'or' in FRENCH property forms
			} else if($property == "F_AMF_Commercial Business Application.pdf or F_AMF_Liquor License Application.pdf") {
				echo "<h3>Property:</h3>
					<a href='/apps/F_AMF_Commercial Business Application.pdf'>F_AMF_Commercial Business Application.pdf</a><br/>
					<h4 style='text-align: center'> OR </h4> 
					<a href='/apps/F_AMF_Liquor License Application.pdf'>F_AMF_Liquor License Application.pdf</a><br/>";

			} else if($property == "F_AMF_Rented Owner Occuipied or Vacant Dwelling Application.pdf and F_AMF_Woodstove Questionnaire.pdf") {
				echo "<h3>Property:</h3>
					<a href='/apps/F_AMF_Rented Owner Occuipied.pdf'>F_AMF_Rented Owner Occuipied.pdf</a> <h4> OR </h4> <a href='/apps/F_AMF_Vacant Dwelling Application.pdf'>F_AMF_Vacant Dwelling Application.pdf</a><br/>
					<h4 style='text-align: center'> AND </h4>
					<a href='/apps/F_AMF_Woodstove Questionnaire.pdf'>F_AMF_Woodstove Questionnaire.pdf</a><br/>";

			} else {
				//getting 'pdf' position/s(if exists) 
				$property_pos= strpos_all($property, 'pdf');
				
				//check if one 'pdf' or two 'pdf'  
				if (count($property_pos)===1){
					echo "<h3>Property:</h3>";
					echo "<a href='/apps/".$property."'>".$property."</a> <br />";

				} else if (count($property_pos) === 2) {
					$first_form= substr($property, 0, $property_pos[0]+3);
					$second_form= substr($property, $property_pos[0]+8);

					echo "<h3>Property:</h3>";
					echo "<a href='/apps/".$first_form."'>".$first_form."</a><br/>";
					echo "<h4 style='text-align: center'> AND </h4>";
					echo "<a href='/apps/".$second_form."'>".$second_form."</a> <br />";
					
				} 
			}
		}

		//------------------E&O-----------------------
		echo "<h3>E&O:</h3>";
		if (!$e_o){
			echo "This Line of Business is not available for this Company Type";
		} else {
			echo "<a href='/apps/".$e_o."'>".$e_o."</a> <br />";
		}

		//------------------excess-----------------
		echo "<h3>Excess:</h3>";
		if (!$excess){
			echo "This Line of Business is not available for this Company Type";
		} else {
			echo "<a href='/apps/".$excess."'>".$excess."</a> <br />";
		}

		//--------------------umbrella-----------------
		echo "<h3>Umbrella:</h3>";
		if (!$umbrella){
			echo "This Line of Business is not available for this Company Type";
		} else {
			echo "<a href='/apps/".$umbrella."'>".$umbrella."</a> <br /> <br /><br/>";
		}
		
	}//end num_rows			
}//end isset company_type and lang 