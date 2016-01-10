<?php include 'includes/header.php' ?>

	


<div class="container-fluid">
	<div class="row1">

		<div class="wrapper col-sm-12">
			<?php include 'includes/menu.php'; ?>
			<h1>Välkommen <?php echo $_SESSION['user_name']; ?></h1>
			<?php include 'bet.php' ?>
		</div>	
	</div>
</div>

<div class="container-fluid">
	<div class="row">

		<ul class="tabs">
		    <li class="tab1 active">
		        <input type="radio" name="tabs" id="tab1" checked/>
		        <label for="tab1">Scoreboard</label>
		        <div id="tab-content1" class="tab-content">
		        </div>
		    </li>
		  
		    <li class="tab2">
		        <input type="radio" name="tabs" id="tab2" />
		        <label for="tab2">Betta</label>
		        <div id="tab-content2" class="tab-content">

		        </div>
		    </li>
		</ul>

		<br style="clear: both;" />
	</div><!-- #row -->
</div><!-- #container-fluid -->


<!-- 		<div class="wrap col-sm-10">
  
  <ul class="tabs group">
    <li><a class="active" href="#/one">Light &</a></li>
    <li><a href="#/two">Sexy</a></li>
    <li><a href="#/three">Tabs</a></li>
  </ul>
  
  <div id="content">
    <p id="one">Some text about Light sit amet, consectetur adipisicing elit. Pariatur modi quod quo iure recusandae eligendi q.t, consectetur adipisicing elit. Pariatur </p>
    <p id="two">Sexy sexy  consectetur adipisicing elit. Pariatur modi quod quo iure recusandae eligendi q.t, consectetur adipisicing elit. Pariatur modi quod quo iureq</p>
    <p id="three">Tabs , consectetur adipisicing elit. Pariatur modi quod quo iure recusandae eligendi q.t, consectetur adipisicing elit. Pariatur modi quod quo iureq</p>
  </div>
  
</div> -->
		
			




<?php include 'includes/footer.php' ?>
<script src="js/user_dash_script.js"></script>