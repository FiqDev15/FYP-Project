<?php
{
    $ic = $_POST['patientName'];
	$pname = $_POST['patienIC'];
    $pid = $_POST['appID'];
    $tidold = $_POST['treatmentold'];	
	$tid = $_POST['treatment'];	
	
	// database connection 
	include("dbconn.php");
	$sql = "UPDATE appointment SET treatmentID = $tid appID = $pid WHERE appID = $pid";
    
    
    
/*    UPDATE appointment SET appointmentID = $pid ,
    treatmentID = $tid, 
    statusapp = 'completed'
    WHERE appointmentID = $pid";*/

	$query = mysqli_query($dbconn,$sql);

    $sqlpayselect= "SELECT * FROM patient pat INNER JOIN appointment AS a ON a.patientIC = pat.patientIC INNER JOIN treatment t ON t.treatmentID = a.treatmentID INNER JOIN employee e on e.empID = a.empID  INNER JOIN payment p ON p.appID = a.appID where p.paymentID = $pid";
    $query = mysqli_query($dbconn, $sqlpayselect) or 
	die ("Error: " . mysqli_error($dbconn));
$row = mysqli_num_rows($query);


    if($row != 0)
	{
		$r = mysqli_fetch_assoc($query); }

    $sqlpay = "UPDATE payment SET total_issued  =" $r['treatmentCost'] "where appID = $pid";

		mysqli_query($dbconn, $sqlpay) or die ("Error: " . mysqli_error($dbconn));
	header("Location: viewapp_doctor.php");
    
}
?>