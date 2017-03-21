<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>Search for a Team</title>

<!-- Pull Boostrap and JQuery dependencies -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Changes the Navbar to solid on scroll -->
<script src="/scripts/navbarAlter.js"></script>

<!-- Our main css file, holds the core styles -->
<link rel='stylesheet' href='/style/main.css'>
<link rel='stylesheet' href='/style/animate.css'>
</head>
<body class="scouting-background3">
	<ul class="nav navbar-nav" id="respnav">
				<span class="logo"><a href="/" style="color:black;"><img src="/images/logo.png" alt="Delta Drive" style="height:70px"/></a></span>
				<li class="navbutton"><a href="/scouting/index.php"><h4>Scouting</h4></a></li>
				<li class="navbutton"><a href="/scouting/teams.php"><h4>Teams</h4></a></li>
				<?php 
					if(isset($_SESSION['user_name'])) {
						echo '<li><a href="/login/login.php?logout"><h4>Sign Out, '. $_SESSION['first_name'] .'</h4></a></li>';
					}
					else {
						echo '<li><a href="/login/"><h4>Sign In</h4></a></li>';
					}
				?>
				<li class="navicon">
					<a href="javascript:void(0);" onclick="respnav()">&#9776;</a>
				</li>
			</ul>
	<div class="header_push">	
	</div>	
	<h2 style="padding-left:15px; font-weight:bold;">
		Search
	</h2>
	<hr>
	<div class="container-fluid">	
	<!-- TODO: Change method from POST to GET -->
	<form action="results.php" name="team_edit" method="get" class="teamedit">
		<fieldset>
			<table>
				<tr>
					<td class="teamsearch-padding">
						Team Number
						<br>
						<input type="text" length="128" name="team_number" pattern="^[0-9]{1,5}$" class="teamsearch-input"/>
					</td>
					<td class="teamsearch-padding">
						Team City
						<br>
						<input type="text" length="128" name="team_city" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+[\'-]?){1,5}$" class="teamsearch-input"/>
					</td>
				</tr>
				<tr>
					<td class="teamsearch-padding">
						Team Name
						<br>
						<input type="text" length="128" name="team_name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+[\'-]?){1,15}$" class="teamsearch-input"/>
					</td>
					<td class="teamsearch-padding">
						Team State
						<br>
						<?php
							$states = array(''=>' ', 'Alabama'=>'AL', 'Alaska'=>'AK', 'Arizona'=>'AZ', 'Arkansas'=>'AR', 'California'=>'CA', 'Colorado'=>'CO', 'Connecticut'=>'CT', 'Delaware'=>'DE', 'Florida'=>'FL', 'Georgia'=>'GA', 'Hawaii'=>'HI', 'Idaho'=>'ID', 'Illinois'=>'IL', 'Indiana'=>'IN', 'Iowa'=>'IA', 'Kansas'=>'KS', 'Kentucky'=>'KY', 'Louisiana'=>'LA', 'Maine'=>'ME', 'Maryland'=>'MD', 'Massachusetts'=>'MA', 'Michigan'=>'MI', 'Minnesota'=>'MN', 'Mississippi'=>'MS', 'Missouri'=>'MO', 'Montana'=>'MT', 'Nebraska'=>'NE', 'Nevada'=>'NV', 'New Hampshire'=>'NH', 'New Jersey'=>'NJ', 'New Mexico'=>'NM', 'New York'=>'NY', 'North Carolina'=>'NC', 'North Dakota'=>'ND', 'Ohio'=>'OH', 'Oklahoma'=>'OK', 'Oregon'=>'OR', 'Pennsylvania'=>'PA', 'Rhode Island'=>'RI', 'South Carolina'=>'SC', 'South Dakota'=>'SD', 'Tennessee'=>'TN', 'Texas'=>'TX', 'Utah'=>'UT', 'Vermont'=>'VT', 'Virginia'=>'VA', 'Washington'=>'WA', 'West Virginia'=>'WV', 'Wisconsin'=>'WI', 'Wyoming'=>'WY');
							function generateSelect($name = '', $options = array(), $default = '') {
								$state_menu = '<select name="'.$name.'" class="teamsearch-input">';
								foreach ($options as $option => $value) {
									if ($value == $default) {
										$state_menu .= '<option value='.$value.' selected="selected">'.$option.'</option>';
									} 
									else {
										$state_menu .= '<option value='.$value.'>'.$option.'</option>';
									}
								}

							$state_menu .= '</select>';
							return $state_menu;
							}

							/* And then call it like */
							$state_menu = generateSelect("team_state", $states, '');
							echo $state_menu;
						?>
					</td>
				</tr>	
				<tr>
					<td class="teamsearch-padding">
						Team School
						<br>
						<input type="text" length="128" name="team_school" class="teamsearch-input"/>
					</td>
					<td class="teamsearch-padding">
						Team Captain
						<br>
						<input type="text" length="128" name="team_captain" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+[\'-]?){1,3}$" class="teamsearch-input"/>
					</td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<hr>
			<div class="row">
				<div class="col-lg-3">
				<!--TODO: Change this into a table/flexbox (Cry tears of sadness at what this is)-->
				<h3 class="teamheading">TeleOp Capabilities</h3>
				<span class="teamedit-text" style="padding-right: 196px;">Cap Ball</span>
				<input type="checkbox" class="teamsearch-checkbox" name="cap_ability_teleop" value="true"/>
				<br>
				<span class="teamedit-text" style="padding-right: 37px;">Low Goal Projectile Scoring</span>
				<input type="checkbox" class="teamsearch-checkbox" name="low_projectile_ability_teleop" value="true"/>
				<br>
				<span class="teamedit-text" style="padding-right: 32.5px;">High Goal Projectile Scoring</span>
				<input type="checkbox" class="teamsearch-checkbox" name="high_projectile_ability_teleop" value="true"/>
				<br>
				<span class="teamedit-text" style="padding-right: 135px;">Beacon Scoring</span>
				<input type="checkbox" class="teamsearch-checkbox" name="beacon_ability_teleop" value="true"/>
				</div>
				<div class="col-lg-3">
					<h3 class="teamheading">Autonomous Capabilities</h3>
					<span class="teamedit-text" style="padding-right: 140px;">Knock Cap Ball</span>
					<input type="checkbox" class="teamsearch-checkbox" name="cap_ability_auto" value="true"/>
					<br>
					<span class="teamedit-text" style="padding-right: 36px;">Low Goal Projectile Scoring</span>
					<input type="checkbox" class="teamsearch-checkbox" name="low_projectile_ability_auto" value="true"/>
					<br>
					<span class="teamedit-text" style="padding-right: 31.5px;">High Goal Projectile Scoring</span>
					<input type="checkbox" class="teamsearch-checkbox" name="high_projectile_ability_auto" value="true"/>
					<br>
					<span class="teamedit-text" style="padding-right: 134px;">Beacon Scoring</span>
					<input type="checkbox" class="teamsearch-checkbox" name="beacon_ability_auto" value="true"/>
				</div>
			</div>
		<hr>
		</fieldset>
		<br>
		<input type="submit" class="btn btn-default teamsearch-btn" value="Search"/>
	</form>
	</div>
	<footer class="footer footer-muted">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
	<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>
</html>