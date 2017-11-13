<?php
include('universities-config.inc.php');
include('universities-functions.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Universities</title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
<link rel='stylesheet prefetch' href='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.css'>
    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
      <script src='https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js'></script>
<script src='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.js'></script>
    
    
</head>
<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php
include 'includes/header.inc.php';
?>
   <?php
include 'includes/left-nav.inc.php';
?>
   
    
<main class="mdl-layout__content mdl-color--grey-50">
    <section class="page-content">
      <div class="mdl-grid">
         <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
        <div class="mdl-card__title mdl-color--orange">
         <h2 class="mdl-card__title-text">Universities</h2>
         </div>
      <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">

      <form method="GET" action="browse-universities.php">  
      <h5>Filter by State</h5>
      <div class="mdl-selectfield mdl-js-selectfield" style="width:150px;"> 
        <select class="mdl-selectfield__select" id="state" name="states">
          <option value=""></option>
          <option value="remove">Remove </option>

            <?php
printFilter();
?> 
        </select>
        <label class="mdl-selectfield__label" for="state">State</label>
      </div>
      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" type="submit">
          <i class="material-icons">search</i>
        </button> 
</div> 
    </form>
    
         <div class="mdl-card__supporting-text">
          <ul class="demo-list-item mdl-list">
            <?php
printUniversityListChecker();
?>
            </ul>
           </div>
         </div>
   
         <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
             <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">University Details</h2>
               </div> 
                   <?php
printSpecificUniversityDetail();
?>
              </div>  
            </div>  
        </section>
    </main>    
</div>    
</body>
</html>