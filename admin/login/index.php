<?php
session_start();
//require_once("validate_login.php"); //Removed because it created a redirect loop, silly me
require_once("session.php");
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>Login</title>

<!-- Pull Boostrap and JQuery dependencies -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Pull Necessary Fonts from Google -->
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

<!-- Our main css file which holds the core styles, as well as the special css file for login page -->
<link rel='stylesheet' href='../../style/login.css'>
<link rel='stylesheet' href='../../style/main.css'>

<!-- Script for responsive login page -->
<script src='../../scripts/login.js'></script>
</head>

<body>
	<div class="container-fluid col-xs-12">
		<div class="row">
			<div class="center" style="filter: invert(100%); padding-top: 15px;">
				<a href="/" style="color:black;"><img src="/images/logo.png" alt="Delta Drive" style="height:100px" align="middle"/></a>
				
			</div>
		</div>
	</div>
	<div style="padding:20px 0px;"></div>
	<div class="header_push">
	</div>
	<div class="login-spacing"></div>
	<div class="footer-correction">
		<?php
		if(isset($_SESSION['errors']))
		{
			//Print out any errors
			foreach($_SESSION['errors'] as $er)
			{
				print $er . "<br>";
			}
			//Make sure the error only displays once (no persistance)
			unset($_SESSION['errors']);
		}
		if(isset($_SESSION['messages']))
		{
			foreach($_SESSION['messages'] as $m)
			{
				print $m . "<br>";
			}
			unset($_SESSION['messages']);
		}
		?>
		<div class="form">
			<div class="tab-content">
				<div id="login">   
						<h1>Welcome Back!</h1>
						<form action="login.php" method="post">
							<div class="field-wrap">
								<label>
									Username<span class="req">*</span>
								</label>
								<input type="text" name="user_name" required autocomplete="on"/>
							</div>
							<div class="field-wrap">
								<label>
									Password<span class="req">*</span>
								</label>
								<input type="password" name="user_password" required autocomplete="off"/>
							</div>
							<p class="forgot" style="visibility:hidden"><a href="#">Forgot Password?</a></p>
							<button class="button button-block"/>Log In</button>
						</form>
				</div>
			
				<div id="signup">   
					<h1>Sign Up for Free</h1>
					<form action="register.php" method="post">
						<div class="top-row">
							<div class="field-wrap">
								<label>
									First Name<span class="req">*</span>
								</label>
								<input type="text" name="first_name" required autocomplete="off" />
							</div>
							<div class="field-wrap">
								<label>
									Last Name<span class="req">*</span>
								</label>
								<input type="text" name="last_name" required autocomplete="off"/>
							</div>
						</div>
						<div class="field-wrap">
							<label>
								Username<span class="req">*</span>
							</label>
							<input type="text" name="user_name" required autocomplete="off"/>
						</div>
						<div class="field-wrap">
							<label>
								Email Address<span class="req">*</span>
							</label>
							<input type="email" name="user_email" required autocomplete="on"/>
						</div>
						<div class="field-wrap">
							<label>
								Set A Password<span class="req">*</span>
							</label>
							<input type="password" name="user_password_new" required autocomplete="off"/>
						</div>
						<div class="field-wrap">
							<label>
								Repeat your Password<span class="req">*</span>
							</label>
							<input type="password" name="user_password_repeat" required autocomplete="off"/>
						</div>
						<div class="field-wrap">
							<label>
								Team Number<span class="req">*</span>
							</label>
							<input type="text" name="team" pattern="[0-9]{1,5}" required autocomplete="off"/>
						</div>
						<button type="submit" class="button button-block"/>Get Started</button>
					</form>
				</div>
			</div><!-- tab-content -->
		</div> <!-- /form -->
	</div>
	<script src="../../scripts/login.js"></script>
	
	<footer class="footer">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
</body>
</html>
