<?php require "db_connect.php";

session_start();
$user_id = $_SESSION["user_id"];
$tournament_id = $_GET['tour_id'];

/* REGISTRERING AV SLUTVINNARE OCH SKYTTEKUNG */
$query1 = "SELECT team_name, team_id FROM teams";
$result1 = $db_connect->query($query1);
?>
<input id="tour_id" type="hidden" value="<?php echo $tournament_id ?>">
<div class="container">
	<div class="row">
		<div class="extra_bet_box">

			<form action="includes/save_extra_bet.php" class="form-inline" method="post" role="form">
				<div class="form-group">
					<label for="player">Målkung:</label>
					<input class="form-control" type="text" name="player" />
				</div>
				<div class="form-group">
					<label for="winning_team">EM-vinnare 2016:</label>
					<select class="form-control" name="selected_team"> 
						<?php
						while($row = mysqli_fetch_assoc($result1)) { 
							?>
							<option value="<?php echo $row['team_id']; ?>"><?php echo $row['team_name']; ?></option>
						<?php 
						} 
						?>
					</select>
				</div>
				<input class="btn btn-default" type="submit" value="Spara"/>
				<input type="hidden" name="tournament" value="<?php echo $tournament_id; ?>" />
			</form>	
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="team_bet">
			
		<?php
		//lägg till _id efter home_team och away_team ^_^!
		/* REGISTRERING AV RESULTAT */

		$query = "SELECT allGames.*, bets.goal_home, bets.goal_away FROM 
			(SELECT T1.team_name AS team_home, T2.team_name AS team_away, T1.team_flag 
			AS home_flag, T2.team_flag AS away_flag, game_match.* 
			FROM game_match, teams T1, teams T2 
			WHERE T1.team_id=game_match.home_team_id AND T2.team_id=game_match.away_team_id) AS allGames 

			LEFT OUTER JOIN 
			(SELECT * FROM bets 
			WHERE user_id = $user_id AND tournament_id = $tournament_id ) AS bets 
			ON allGames.game_id = bets.game_id
			ORDER BY allGames.game_id";

		  // die($query);

		$result = $db_connect->query($query);

		while($row = mysqli_fetch_assoc($result)) {

			$game_id = $row["game_id"];
			$home_name = $row["team_home"];
			$away_name = $row["team_away"];
			$home_flag = $row["home_flag"];
			$away_flag = $row["away_flag"];
			$goal_home = $row["goal_home"];
			$goal_away = $row["goal_away"];
			$game_start = $row["game_start"];

			//date check variabels
			$date = date('Y-m-d H:i:s');
			$currentDate = strtotime($date);
			$futureDate = $currentDate+(60*10);
			$formatDate = date(" Y-m-d H:i:s", $futureDate);

			$start_time = strtotime($game_start);
			$lock_time = strtotime($formatDate);

			?>
			
			<!-- <div class="bet_boxes"> -->
			<table class="table1 col-sm-12">
				<tbody>

				<?php 
				if($start_time >= $lock_time){ 
					?>
					<!-- YOU CAN BET -->
					<tr id="betGames" class="betGames">
						<td style="text-align:right; width:100px;"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td class="mobile_hide" style="text-align:right;"><?php echo $home_name;?>
						<td  style="text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td  style="text-align:center;"> VS 
						<td ><img class="flag" src="img/<?php echo $away_flag; ?>" />
						<td  class="mobile_hide" style="text-align:left;";><?php echo $away_name;?></td>
						<td ><input class="goal_home" original="<?php echo $goal_home; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_home; ?>" /></td>
						<td>-</td>
						<td ><input class="goal_away" original="<?php echo $goal_away; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_away; ?>"/></td><br/>
						<td><input class="game_id" type="hidden" name="game_id[]" value="<?php echo $game_id; ?>" /></td>
						<td class="error">Du måste fylla i båda fälten</td>
					</tr>
					<?php 
				}
				else{ ?>
					<tr>
						<td style="padding-left: 38px;" class="locked"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td style="text-align:right;" class="locked mobile_hide"><?php echo $home_name;?>
						<td  style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td  style="text-align:center;" class="locked"> VS 
						<td  style="text-align:left;"class="locked"><img class="flag" src="img/<?php echo $away_flag; ?>" />
						<td style="text-align:left;" class="locked mobile_hide"><?php echo $away_name;?></td>
						<td class="locked"><?php echo $goal_home; ?> - <?php echo $goal_away; ?></td><br/>
						<td class="locked">Matchen är låst</td>
						<td></td>
						
						
					</tr>
				<?php } ?>
			</tbody>
		</table><?php 
		} // end while 

		/* REGISTRERING AV SLUTSPELRESULTAT */

		$query1 = "SELECT allGames.*, slutspel_bets.goal_home, slutspel_bets.goal_away FROM 
			(SELECT T1.team_name AS team_home, T2.team_name AS team_away, T1.team_flag 
			AS home_flag, T2.team_flag AS away_flag, slutspel.* 
			FROM slutspel, teams T1, teams T2 
			WHERE T1.team_id=slutspel.home_team_id AND T2.team_id=slutspel.away_team_id) AS allGames 

			LEFT OUTER JOIN 
			(SELECT * FROM slutspel_bets 
			WHERE user_id = $user_id AND tournament_id = $tournament_id ) AS slutspel_bets 
			ON allGames.slutspel_id = slutspel_bets.slutspel_id
			ORDER BY allGames.slutspel_id";


		  // die($query1);

		$result1 = $db_connect->query($query1);

		while($row = mysqli_fetch_assoc($result1)) {

			$slutspel_id = $row["slutspel_id"];
			$home_name = $row["team_home"];
			$away_name = $row["team_away"];
			$home_flag = $row["home_flag"];
			$away_flag = $row["away_flag"];
			$goal_home = $row["goal_home"];
			$goal_away = $row["goal_away"];
			$game_start = $row["game_date"];

			//date check variabels
			$date = date('Y-m-d H:i:s');
			$currentDate = strtotime($date);
			$futureDate = $currentDate+(60*10);
			$formatDate = date(" Y-m-d H:i:s", $futureDate);

			$start_time = strtotime($game_start);
			$lock_time = strtotime($formatDate);

			?>
			
			<!-- <div class="bet_boxes"> -->
			<h4>Slutspelsmatcher</h4>
			<table class="table1 col-sm-12">
				<tbody>

				<?php 
				if($start_time >= $lock_time){ 
					?>
					<!-- YOU CAN BET -->
					<tr id="slutBetGames" class="slutBetGames">
						<td style="text-align:right; width:100px;"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td class="mobile_hide" style="text-align:right;"><?php echo $home_name;?>
						<td  style="text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td  style="text-align:center;"> VS 
						<td ><img class="flag" src="img/<?php echo $away_flag; ?>" />
						<td  class="mobile_hide" style="text-align:left;";><?php echo $away_name;?></td>
						<td ><input class="goal_home" original="<?php echo $goal_home; ?>" type="number" gameID="<?php echo $slutspel_id; ?>" value="<?php echo $goal_home; ?>" /></td>
						<td>-</td>
						<td ><input class="goal_away" original="<?php echo $goal_away; ?>" type="number" gameID="<?php echo $slutspel_id; ?>" value="<?php echo $goal_away; ?>"/></td><br/>
						<td><input class="slutspel_id" type="hidden" name="game_id[]" value="<?php echo $slutspel_id; ?>" /></td>
						<td class="error">Du måste fylla i båda fälten</td>
					</tr>
					<?php 
				}
				else{ ?>
					<tr>
						<td style="padding-left: 38px;" class="locked"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td style="text-align:right;" class="locked mobile_hide"><?php echo $home_name;?>
						<td  style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td  style="text-align:center;" class="locked"> VS 
						<td  style="text-align:left;"class="locked"><img class="flag" src="img/<?php echo $away_flag; ?>" />
						<td style="text-align:left;" class="locked mobile_hide"><?php echo $away_name;?></td>
						<td class="locked"><?php echo $goal_home; ?> - <?php echo $goal_away; ?></td><br/>
						<td class="locked">Matchen är låst</td>
						<td></td>
						
						
					</tr>
				<?php } ?>
			</tbody>
		</table><?php 
		} // end while ?>
		<button id="check" class="col-sm-12 btn btn-default" name="save_bets" value="Spara Bets">spara bets</button>
		</div><!-- team_bet -->
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bet_checker.js"></script>



