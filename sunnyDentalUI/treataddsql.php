<?php
/* include db connection file */
include("dbconn.php");

if(isset($_POST['insertdata'])){
	/* capture values from HTML form */
	//$ID = $_POST['treatmentID'];
	$cost = $_POST['treatmentCost'];
	$name = $_POST['treatmentName'];
    

	$sql0 = "SELECT treatmentID
	FROM treatment ";

	$query0 = mysqli_query($dbconn, $sql0) ;
	$row0 = mysqli_num_rows($query0);
	
	if($row0 != 0){
		/* execute SQL INSERT command */
		$sql2 = "INSERT INTO treatment (treatmentCost, treatmentName)
		VALUES ('" . $cost . "', '" . $name . "')";
		
		mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
		
		
		header("Location: treatment.php");
	}
	else{
		echo "record exist";
	}
}// close if isset()

/* close db connection */
mysqli_close($dbconn);
?>