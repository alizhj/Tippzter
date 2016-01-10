<?php
include 'db_connect.php';
session_start();
//Finlir med isset knapp osv behöver kirras.
$user_id = $_SESSION["user_id"];
$tournament_id = $_POST['tournament_id'];
$bets = json_decode($_POST['bets']);

foreach ($bets as $bet) {
	
	$query = "SELECT bet_id FROM bets WHERE game_id = '". $bet->game_id ."' AND
  	user_id = $user_id AND
    tournament_id = $tournament_id";
	$result = $db_connect->query($query);
	$bet_exist = mysqli_fetch_assoc($result);
	//var_dump($bet_exist);

	if(is_null($bet_exist)){

		$query = "INSERT INTO bets (game_id, user_id, tournament_id, goal_home, goal_away) VALUES (". $bet->game_id .", $user_id, $tournament_id, ". $bet->goal_home .", ". $bet->goal_away .")";

	}else{

		$query = "UPDATE bets SET goal_home =  ". $bet->goal_home .", goal_away = ". $bet->goal_away ." WHERE bet_id = ". $bet_exist['bet_id'] ."";

	}
	if(mysqli_query($db_connect, $query)){
		//success

	}else{
		// echo a error message if the query dident work.
	}

}

$db_connect->close();
?>