<?php include('login-checker.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/searchbar.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
<?php include 'includes/header.inc.php'; ?>
<?php include 'includes/left-nav.inc.php'; ?>

<main class="mdl-layout__content mdl-color--grey-50">
  <div class="mdl-grid">
    
    <!--- Universities Card --->
    <div class="card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col">
        <div class="school-card-square mdl-card__title mdl-card--expand mdl-color--grey-800" >
          <h2 class="mdl-card__title-text">Browse Universities</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
          Browse various Universities to see their selection of books.
        </div>
        
        <div class="mdl-card__actions mdl-card--border">
          <a href="browse-universities.php" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Explore<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></a>
        </div>
      </div>
      
    <!--- Books Card --->  
    <div class="card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col">
      <div class="books-card-square mdl-card__title mdl-card--expand mdl-color--blue-500">
        <h2 class="mdl-card__title-text">Browse Books</h2>
      </div>
      <div class="mdl-card__supporting-text mdl-color-text--grey-600">
        Browse our complete selection of books.
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <a href="browse-books.php" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Explore<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></a>
      </div>
    </div>
    
    <!--- Employees Card --->
    <div class="card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col">
      <div class="employees-card-square mdl-card__title mdl-card--expand mdl-color--orange-300">
        <h2 class="mdl-card__title-text">Browse Employees</h2>
      </div>
      <div class="mdl-card__supporting-text mdl-color-text--grey-600">
        See through a list of our great staff.
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <a href="browse-employees.php" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Explore<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></a>
      </div>
    </div>
    
    <!--- About Us Card --->
    <div class="card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col">
      <div class="about-card-square mdl-card__title mdl-card--expand mdl-color--red-200">
        <h2 class="mdl-card__title-text">More About Us</h2>
      </div>
      <div class="mdl-card__supporting-text mdl-color-text--grey-600">
        Interested to see why we do what we do.
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <a href="aboutus.php" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Explore<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></a>
      </div>
    </div>
    
    <!--- Profile Card --->
    <div class="card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col">
      <div class="profile-card-square mdl-card__title mdl-card--expand mdl-color--blue-grey-300">
        <h2 class="mdl-card__title-text">
          <?php echo $_SESSION['firstname'] . "'s Profile"; ?>
        </h2>
      </div>
      <div class="mdl-card__supporting-text mdl-color-text--grey-600">
        Check out your profile
      </div>
      
      <div class="mdl-card__actions mdl-card--border">
        <a href="user-profile.php" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Explore<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></a>
      </div>
    </div>
    
  </div>
</main>    
</div>    
<script type="text/javascript" src="js/javascript.js"></script>          
</body>
</html>