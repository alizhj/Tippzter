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

	if ($group_nr == "A") {
	 	array_push($groupA, $row);
	}
	if ($group_nr == "B") {
		array_push($groupB, $row);
	}
	if ($group_nr == "C") {
		array_push($groupC, $row);
	}
	if ($group_nr == "D") {
		array_push($groupD, $row);
	}
	if ($group_nr == "E") {
		array_push($groupE, $row);
	}
	if ($group_nr == "F") {
		array_push($groupF, $row);
	}
}
//var_dump($groupA);
//KVARTSFINAL 1
echo "kvartsfinal 1 2A-2C" ;
echo "</br>";
echo $groupA[1]['team_name'];
echo "-";
echo $groupC[1]['team_name'];
echo "</br>";

//KVARTSFINAL 2
echo "</br>";
echo "kvartsfinal 2 1B-3ACD" ;
echo "</br>";
echo $groupB[0]['team_name'];
echo "-";
echo teamThree($groupA, $groupC, $groupD);
echo "</br>";

//KVARTSFINAL 3
echo "</br>";
echo "kvartsfinal 3 1D-3BEF" ;
echo "</br>";
echo $groupD[0]['team_name'];
echo "-";
echo teamThree($groupB, $groupE, $groupF);
echo "</br>";

//KVARTSFINAL 4
echo "</br>";
echo "kvartsfinal 4 1A-3CDE" ;
echo "</br>";
echo $groupA[0]['team_name'];
echo "-";
echo teamThree($groupC, $groupD, $groupE);
echo "</br>";

//KVARTSFINAL 5
echo "</br>";
echo "kvartsfinal 5 1C-3ABF" ;
echo "</br>";
echo $groupC[0]['team_name'];
echo "-";
echo teamThree($groupA, $groupB, $groupF);
echo "</br>";

//KVARTSFINAL 6
echo "</br>";
echo "kvartsfinal 6 1F-2E" ;
echo "</br>";
echo $groupF[0]['team_name'];
echo "-";
echo $groupE[1]['team_name'];
echo "</br>";

//KVARTSFINAL 7
echo "</br>";
echo "kvartsfinal 7 1E-2D";
echo "</br>";
echo $groupE[0]['team_name'];
echo "-";
echo $groupD[1]['team_name'];
echo "</br>";

//KVARTSFINAL 8
echo "</br>";
echo "kvartsfinal 8 2B-2F";
echo "</br>";
echo $groupB[1]['team_name'];
echo "-";
echo $groupF[1]['team_name'];
echo "</br>";



function teamThree($team1, $team2, $team3) {
	if(($team1[2]['team_points'] >= $team2[2]['team_points'] && $team3[2]['team_points']) || ($team1[2]['goal_diff'] >= $team2[2]['goal_diff'] && $team3[2]['goal_diff'])){
		echo $team1[2]['team_name'];
	}
	else if (($team2[2]['team_points'] >= $team1[2]['team_points'] && $team3[2]['team_points']) || ($team2[2]['goal_diff'] >= $team1[2]['goal_diff'] && $team3[2]['goal_diff'])){
		echo $team2[2]['team_name'];
	}
	else if(($team3[2]['team_points'] >= $team2[2]['team_points'] && $team1[2]['team_points']) ||($team3[2]['goal_diff'] >= $team2[2]['goal_diff'] && $team1[2]['goal_diff'])){
		echo $team3[2]['team_name'];
	}
}


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