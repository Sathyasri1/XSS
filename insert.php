<?php
$link = mysqli_connect("localhost", "root", "", "my_db");
 
 // Check connection
 if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$pattern = "/\<\w[^<>]*?\>([^<>]+?\<\/\w+?\>)?|\<\/\w+?\>/i";
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$name = $first_name . $last_name;


// Attempt insert query execution
if(!preg_match($pattern, $name)) 
{
	$sql = "INSERT INTO demo(first_name, last_name) VALUES('$first_name', '$last_name')";

	if(mysqli_query($link, $sql))
	{
		echo "Result: " . htmlspecialchars($first_name);
		echo "Result: " . htmlspecialchars($last_name);
		echo "Records added successfully.";
	} 
	else 
	{
    		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}	
}
else
{
	echo "Remove Special Characters only allowed characters";
}


// Close connection
mysqli_close($link);

?>