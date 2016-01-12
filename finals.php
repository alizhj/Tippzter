<?php include 'includes/db_connect.php'; ?>

<?php 

$query = "SELECT * FROM teams ORDER BY group_nr ASC, team_points DESC, goal_diff DESC";

$result = mysqli_query($db_connect, $query);

$groupA = array();
$groupB = array();
$groupC = array();
$groupD = array();
$groupE = array();
$groupF = array();

while($row = mysqli_fetch_assoc($result)){

	$team_id = $row["team_id"];
	$team_name = $row["team_name"];
	$team_flag = $row["team_flag"];
	$group_nr = $row["group_nr"];

	// if ($group_nr == "A") {
	// 	$groupA = $row;

		//var_dump($groupA);

		// foreach ($groupA as $A) {
		 	//var_dump($A);
				
			

		// }

		//echo $groupA['team_name'];
	// }
	// if ($group_nr == "B") {
	// 	$groupB = $row;
	// }
	// if ($group_nr == "C") {
	// 	$groupC = $row;
	// }
	// if ($group_nr == "D") {
	// 	$groupD = $row;
	// }
	// if ($group_nr == "E") {
	// 	$groupE = $row;
	// }
	// if ($group_nr == "F") {
	// 	$groupF = $row;
	// }
}
var_dump($groupA);


//funktionen updaterar hemmalagen i slutspelet
function insertHomeTeam($home_team_id, $slutspel_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE slutspel SET home_team_id = $home_team_id WHERE slutspel_id = $slutspel_id " );
}
//funktionen updaterar bortalagen i slutspelet
function insertAwayTeam($away_team_id, $slutspel_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE slutspel SET awat_team_id = $away_team_id WHERE slutspel_id = $slutspel_id " );
}

?>