<?php
/*Checks to see if a page being sent through a query string. If so, it will set 
  a session variable for it so the proper redirect can happen.
*/
if(isset($_GET['page'])){ $_SESSION['pagename'] = $_GET['page'];};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css" rel="stylesheet">
	<link href='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.css' rel='stylesheet prefetch'>
	<link href="css/styles.css" rel="stylesheet">
	  <link rel="stylesheet" href="css/searchbar.css">
	<script src="https://code.jquery.com/jquery-1.7.2.min.js">
	</script>
	<script src="https://code.getmdl.io/1.1.3/material.min.js">
	</script>
	<script src='https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js'>
	</script>
	<script src='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.js'>
	</script>
</head>

<body>
	<div class="container">
		<div class="mdl-layout mdl-layout-login mdl-js-layout mdl-grid center-items" id="loginscreen">
			<main class="mdl-layout__content_login">
				<div class="mdl-card mdl-shadow--6dp">
					<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
						<h2 class="mdl-card__title-text">Please Login</h2>
					</div>
					<div class="mdl-card__supporting-text">
						<form action="checklogin.php" method="POST">
							<div class="mdl-textfield mdl-js-textfield">
								<input class="mdl-textfield__input required" name="username" id="username" type="text"> <label class="mdl-textfield__label" for="username">Username</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield">
								<input class="mdl-textfield__input required" name="password" id="password" type="password"> <label class="mdl-textfield__label" for="userpass">Password</label>
							</div>
							
							<!--Checks to see if an error is sent through a query string. If so, it will display a corresponding message.-->
							<?php if(isset($_GET['error'])){ echo "<p id='error'>The Username or Password is incorrect.</p>"; }; ?>
							
							<div class="mdl-card__actions mdl-card--border">
              <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="submit" name="Submit" type="submit">Sign in</button>
							</div>
						</form>
					</div>
				</div>
			</main>
		</div>
	</div><!-- /container -->
</body>
<script type="text/javascript" src="js/login.js"></script>
</html>