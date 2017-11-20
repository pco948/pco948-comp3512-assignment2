<?php 
require_once ('includes/db-config.inc.php');
include('login-checker.php');
include('lib/UserGateway.php');

$uGateway = new UserGateway($connection);

function writeUserInformation() {
 try {
  global $uGateway;
  $row = $uGateway -> findByID($_SESSION['userid']);
  
  $fullAddress = $row['Address'] . ", " . $row['City'] . ", " . $row['Region'] . ", " 
            . $row['Postal'] . ", " . $row['Country'];
  $retStr = "Address: " . $fullAddress .
            "<br>Phone: " . $row['Phone'] .
            "<br>Email: " . $row['Email'];
  
  return $retStr;
  } 
  catch (PDOException $e) {
   echo "Could not find user information";
  }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.css'>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.js'></script>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
<main class="mdl-layout__content mdl-color--grey-50">
 <section class="page-content">

  <div class="mdl-grid">
   <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp mdl-cell--stretch">
    <div class="mdl-card__title mdl-color--deep-purple">
    <h2 class="mdl-card__title-text mdl-color-text--white">User Profile</h2>
    </div>
    
    <div class="user-card mdl-card__supporting-text">
      <div class="mdl-grid nested-grid">
       
       <!-- First Section: User name, picture, address, contact information --->
       <div class="user-first-section-card mdl-cell mdl-cell--middle mdl-cell--12-col mdl-card mdl-shadow--2dp mdl-color--grey-100">
        <div class="mdl-grid nested-grid">
         <div class="user_img_parent_card mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp ">
          <div class="user_img_card mdl-card">
           <div class="mdl-card__title mdl-card--expand"></div>
            <div class="mdl-card__actions">
            <span class=".user_img_card__filename">Change Avatar</span>
            </div>
           </div>
         </div>
         <div class="user_profile_card mdl-cell mdl-cell--10-col mdl-card mdl-color--grey-100">
          <h2>
           <?php 
            echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
           ?>
          </h2>
          <h4>
           <?php echo writeUserInformation(); ?>
          </h4>
         </div>
        </div>
       </div>
       
       <!-- Second Section: User information, summary, overview--->
       <div class="user-second-section mdl-cell mdl-cell--12-col">
        <h4>
         User Summary:
         <div class="user_line"></div>
          <p>
             <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tortor neque, suscipit eget quam sit amet, dapibus ornare magna. 
             Pellentesque euismod urna eu placerat euismod. Duis vitae sem risus. Mauris sodales magna enim, sit amet venenatis mauris elementum non. 
             Duis ultricies lorem sed aliquam luctus. Praesent semper placerat metus a luctus. Quisque semper nisl eget consectetur blandit.
             Donec non nisl sapien. Nam fringilla aliquet ipsum, ut tempor mi commodo eu. Fusce convallis nunc felis, eget commodo sem luctus euismod.
             Nunc auctor imperdiet imperdiet. Ut urna justo, tincidunt vitae risus eu, efficitur laoreet libero. Pellentesque sodales ante non tincidunt feugiat. 
             Nam et finibus neque, a vehicula tortor. Pellentesque suscipit imperdiet sapien, dignissim bibendum sapien finibus eget. 
             Quisque vitae cursus erat, sed semper nulla. Integer dapibus a enim in aliquam.
             <br>
             <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tortor neque, suscipit eget quam sit amet, dapibus ornare magna. 
             Pellentesque euismod urna eu placerat euismod. Duis vitae sem risus. Mauris sodales magna enim, sit amet venenatis mauris elementum non. 
             Duis ultricies lorem sed aliquam luctus. Praesent semper placerat metus a luctus. Quisque semper nisl eget consectetur blandit.
             Donec non nisl sapien. Nam fringilla aliquet ipsum, ut tempor mi commodo eu. Fusce convallis nunc felis, eget commodo sem luctus euismod.
             Nunc auctor imperdiet imperdiet. Ut urna justo, tincidunt vitae risus eu, efficitur laoreet libero. Pellentesque sodales ante non tincidunt feugiat. 
             Nam et finibus neque, a vehicula tortor. Pellentesque suscipit imperdiet sapien, dignissim bibendum sapien finibus eget. 
             Quisque vitae cursus erat, sed semper nulla. Integer dapibus a enim in aliquam.
          </p>
        </h4>
       </div>
       
      </div>
    </div>
   </div> 
  </div> 
 </section>
</main>    
</div>   
</body>
<script type="text/javascript" src="js/javascript.js"></script>
</html>