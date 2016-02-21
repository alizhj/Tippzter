<?php
include 'db_connect.php';
$slutspel_id = $_POST['slutspel_id'];
$home_goal = $_POST['home_goal'];
$away_goal = $_POST['away_goal'];
$home_team_id = $_POST['home_team_id'];
$away_team_id = $_POST['away_team_id'];

/* **************************************** */
/* Sparar in eller uppdaterar slutresultaten på matcherna */
/* **************************************** */

$result = mysqli_query($db_connect, "SELECT * FROM slutspel_result WHERE slutspel_id = $slutspel_id ");

if($result->num_rows > 0) {
    mysqli_query($db_connect, "UPDATE slutspel_result SET result_goal_home = '$home_goal', result_goal_away = '$away_goal' 
    							WHERE slutspel_id = '$slutpspel_id' ");
   
}
else {
    mysqli_query($db_connect, "INSERT INTO slutspel_result (slutspel_id, result_goal_home, result_goal_away) 
	VALUES ('$slutspel_id', '$home_goal', $away_goal)");

}

/* **************************************** */
/* ***** Sparar spelarens poäng i db ****** */
/* **************************************** */

$query2 = "SELECT * FROM user_tournaments";
$result2 = mysqli_query($db_connect, $query2);

//loopar igenom varje rad i user_tournaments
while ( $row = mysqli_fetch_assoc($result2)) {
	$user_id = $row["user_id"];
	$user_name = $row["user_name"];
	$tournament_id = $row["tournament_id"];
	
	//sparar returvärdet från funktionen userPoints
	$points = userPoints($user_id, $tournament_id);
	//sparar returvärdet från winnerExtraPoints
	$extra_points = winnerExtraPoints($user_id, $tournament_id);

	//hämtar funktionen som updaterar personens aktuella poäng
	updateUserPoints($points, $extra_points, $user_id, $tournament_id);
}

//skickar tillbaka till admin_dash
header("Location: ../admin_dash.php");


/* **************************************** */
/* ************* FUNKTIONER *************** */
/* **************************************** */


//funktionen räknar ut poängen för varje användare
function userPoints($user_id, $tournament_id) {
	global $db_connect;
	$points = 0;

	//hämtar all info från game_match och results.
	//Vill ha alla matchers resultat för att kunna räkna ut hur många poäng varje lag har.
	$query = "SELECT results.*, bets.* FROM results 
		RIGHT JOIN bets
		ON bets.game_id = results.game_id
		WHERE tournament_id = $tournament_id AND user_id = $user_id";

  	$result = $db_connect->query($query);
  	//print_r($result);
    $points = 0;

  	while ($row = mysqli_fetch_assoc($result)) {
  		
	  		if($row["goal_home"] == $row["goal_away"] && $row["result_goal_home"] == $row["result_goal_away"]) {
	  			$points = $points + 15;
		  	}	
	  		if($row["goal_home"] == $row["result_goal_home"]) {
	  			$points = $points + 5;		
	  		}
	  		if($row["goal_away"] == $row["result_goal_away"]) {
	  			$points = $points + 5;
	  		}
		  	
	  		if($row["goal_away"] < $row["goal_home"] && $row["result_goal_away"] < $row["result_goal_home"]) {
				$points = $points + 10;  			
	  		}
	  		else if($row["goal_away"] < $row["goal_home"] && $row["result_goal_away"] < $row["result_goal_home"]) {
	  			$points = $points + 10;	
	  		}
  		
  		
    }
  	return $points;
  	//updateUserPoints($points, $user_id, $tournament_id);

}

function winnerExtraPoints($user_id, $tournament_id) {
  global $db_connect;
  $extra_points = 0;
 
  //hämtar all info från game_match och results.
  //Vill ha alla matchers resultat för att kunna räkna ut hur många poäng varje lag har.
  $query = "SELECT extra_bets.*, results_extra.* FROM extra_bets, results_extra 
  			WHERE tournament_id = $tournament_id AND user_id = $user_id";

    $result = $db_connect->query($query);
 

    while ($row = mysqli_fetch_assoc($result)) {
      if($row['user_id'] == $user_id) {
         if($row["winning_player"] == $row["winner_player"]) {
              $extra_points = $extra_points +30;
            
          }

          if($row["winning_team"] == $row["winner_team"]) {
              $extra_points = $extra_points +30;        
          }
      }
      
    }
    return $extra_points;
    //updateUserPoints($points, $user_id, $tournament_id);
}

//funktionen uppdaterar varje persons poäng i varje grupp
function updateUserPoints($points, $extra_points, $user_id, $tournament_id){
	global $db_connect;

	//lägger ihop poängen från winnerExtraPoints och userPoints
	$total_points = $extra_points + $points;
	//Uppdaterar user_points med den nya $total_points
	mysqli_query($db_connect, "UPDATE user_tournaments SET user_points = $total_points 
								WHERE user_id = $user_id AND tournament_id = $tournament_id");

	return $total_points;
}
?>