
<?php
include 'includes/db_connect.php';
//Saves the values from the registration form into the database.
$sql = "INSERT INTO users (user_name, user_password, user_email, admin)
VALUES ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['email']."', 'false')";

if(mysqli_query($db_connect, $sql)){
	//success
	echo 'Bean Bag';
	header("Location: index.php");

}else{
	// echo a error message if the query dident work.
	echo "Error: ". $sql . "<br>" . mysqli_error($db_connect);
}
?>

