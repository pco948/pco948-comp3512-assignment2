<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>

    <link href="css/styles.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <div class="container">

      <form class="form-signin" name="form1" method="post" action="checklogin.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="username" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="password" id="mypassword" type="password" class="form-control" placeholder="Password">
        
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->
  </body>
</html>