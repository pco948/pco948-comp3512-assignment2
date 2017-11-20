<?php 
include './includes/booksFunctions.inc.php';
include('login-checker.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Books</title></title>
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
    <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
    <div class="mdl-card__title mdl-color--orange">
     <h2 class="mdl-card__title-text">Books</h2>
       </div>
      <div class="mdl-card__supporting-text">
     <div class="mdl-grid">
      <div class="mdl-card__title ">
      <form method="GET" action="browse-books.php">  
       <h5>Filter by Subcategory</h5>
        <div class="mdl-selectfield mdl-js-selectfield"> 
         <select class="mdl-selectfield__select" id="subcategory" name="subcategory">
         <option value=""></option>
          <option value="all">All Subcategories </option>
           <?php   printSubcategoryDropdown($subcategoriesData); ?> 
           </select>
           <label class="mdl-selectfield__label" for="subcategory">Subcategories</label>
              </div>
           <button class="mdl-button mdl-js-button mdl-button--accent" type="submit"> Search </button> 
            </div> 
         </form>

 <div class="mdl-card__title">
  <form method="GET" action="browse-books.php">  
    <h5>Filter by Imprint</h5>
   <div class="mdl-selectfield mdl-js-selectfield"> 
    <select class="mdl-selectfield__select" id="imprint" name="imprint">
   <option value=""></option>
    <option value="all">All Imprints </option>
      <?php printImprintDropdown($imprintsData); ?> 
      </select>
       <label class="mdl-selectfield__label" for="imprint">Imprints</label>
        </div>
        <button class="mdl-button mdl-js-button mdl-button--accent" type="submit"> Search </button> 
    </div>
   </form>
    
</div>
    
 <table class="mdl-data-table  mdl-shadow--2dp">
  <thead>
  <tr>
  <th class="mdl-data-table__cell--non-numeric">Cover</th>
  <th class="mdl-data-table__cell--non-numeric">Title</th>
  <th class="mdl-data-table__cell--non-numeric">Year</th>
  <th class="mdl-data-table__cell--non-numeric">Subcategory</th>
  <th class="mdl-data-table__cell--non-numeric">Imprint</th>
  </tr>
  </thead>
  <tbody>
      <?php  printBookChecker($data); ?>
    </tbody>
    </table>
  </div>
  </div> 
</div> 
</section>
</main>    
</div>   
</body>
<script type="text/javascript" src="js/javascript.js"></script>
</html>